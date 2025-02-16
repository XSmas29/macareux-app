<?php

namespace App\Http\Controllers;

use App\Entities\Population;
use App\Entities\Prefecture;
use App\Entities\Year;
use Doctrine\ORM\EntityManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class uploadController extends Controller
{
  private $entityManager;

  public function __construct(EntityManager $entityManager)
  {
    $this->entityManager = $entityManager;
  }
  public function uploadCSV(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'file' => 'required|file|mimes:csv,txt',
    ]);
    if ($validator->fails()) {
      return response()->json(['error' => true, 'message' => $validator->errors()], 422);
    }

    $file = $request->file('file');
    // check file extension = csv
    if ($file->getClientOriginalExtension() != 'csv') {
      return response()->json(['error' => true, 'message' => 'File must be a CSV'], 422);
    }

    try {
      $handle = fopen($file->getPathname(), 'r');
      $is_content = false;
      $years = [];
      while (($row = fgetcsv($handle)) !== false) {
        // Convert from Shift JIS to UTF-8
        $row = array_map(fn($col) => mb_convert_encoding($col, 'UTF-8', 'SJIS-win'), $row);
        if ($is_content) {
          // insert content to database
          $currentPrefecture = null;
          for ($i = 0; $i < count($row); $i++) {
            if ($i === 0) {
              // check prefecture format
              if (!is_string($row[$i])) {
                throw new \Exception('Invalid data format');
              }
              // insert prefecture to database
              $prefecture_exist = $this->entityManager->getRepository(Prefecture::class)->findOneBy(['name' => $row[$i]]);
              if (!$prefecture_exist) {
                $prefecture = new Prefecture();
                $prefecture->setName($row[$i]);
                $this->entityManager->persist($prefecture);
                $this->entityManager->flush();
                $currentPrefecture = $prefecture;
                continue;
              }
              $currentPrefecture = $prefecture_exist;
              continue;
            }

            // check population format
            if (!is_numeric($row[$i])) {
              continue;
            }
            // insert population to database
            if ($years[$i] && $currentPrefecture && is_numeric($row[$i])) {
              $population_exist = $this->entityManager->getRepository(Population::class)->findOneBy(['year' => 1 * $years[$i], 'prefecture' => $row[0]]);

              if ($population_exist) {
                $population_exist->setValue(1 * $row[$i]);
                $this->entityManager->persist($population_exist);
                continue;
              }

              $population = new Population();
              $population->setYear($this->entityManager->getRepository(Year::class)->findOneBy(['name' => 1 * $years[$i]]));
              $population->setPrefecture($currentPrefecture);
              $population->setValue(1 * $row[$i]);
              $this->entityManager->persist($population);
            }
          }
          continue;
        }

        $header = array_slice($row, 1);
        if (!$is_content && count($header) === count(array_filter($header, 'is_numeric')) && count(array_filter($header, 'is_numeric')) > 0) {
          $is_content = true;
          $years = $row;
          for ($i = 1; $i < count($years); $i++) {
            //check if year format is correct (4 digit number)
            if (!is_numeric($years[$i]) || strlen($years[$i]) !== 4) {
              throw new \Exception('Invalid header format');
            }
            // insert year to database
            $year_exist = $this->entityManager->getRepository(Year::class)->findOneBy(['name' => 1 * $years[$i]]);
            if ($year_exist) {
              continue;
            }
            $year = new Year();
            $year->setName(1 * $years[$i]);
            $this->entityManager->persist($year);
          }
          continue;
        }
      }
      $this->entityManager->flush();
      fclose($handle);
      return response()->json(['message' => 'File Uploaded Successfully'], 200);
    } catch (\Exception $e) {
      return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
    }
  }
}
