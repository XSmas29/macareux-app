<?php

namespace App\Http\Controllers;

use App\Entities\Population;
use App\Entities\Prefecture;
use Doctrine\ORM\EntityManager;
use Illuminate\Http\Request;

class PopulationController extends Controller
{
  private $entityManager;

  public function __construct(EntityManager $entityManager)
  {
    $this->entityManager = $entityManager;
  }

  public function getPopulationData(Request $request)
  {
    try {
      // get query params
      $prefectureId = $request->query('prefecture_id');
      $yearId = $request->query('year_id');

      // get population data
      $populationData = $this->entityManager->getRepository(Population::class)->findOneBy([
        'prefecture' => $prefectureId,
        'year' => $yearId
      ]);

      $ret = $populationData->toArray();
      return response()->json(['message' => 'Population data retrieved successfully', 'data' => $ret], 200);
    } catch (\Exception $e) {
      return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
    }
  }
}
