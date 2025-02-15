<?php

namespace App\Http\Controllers;

use App\Entities\Year;
use Doctrine\ORM\EntityManager;

class YearController extends Controller
{
  private $entityManager;

  public function __construct(EntityManager $entityManager)
  {
    $this->entityManager = $entityManager;
  }

  public function getYearList()
  {
    try {
      $yearList = $this->entityManager->getRepository(Year::class)->findAll();
      $ret = array_map(fn($yearList) => $yearList->toArray(), $yearList);
      return response()->json(['message' => 'Year data retrieved successfully', 'data' => $ret], 200);
    } catch (\Exception $e) {
      return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
    }
  }
}
