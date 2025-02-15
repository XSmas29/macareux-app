<?php

namespace App\Http\Controllers;

use App\Entities\Prefecture;
use Doctrine\ORM\EntityManager;

class PrefectureController extends Controller
{
  private $entityManager;

  public function __construct(EntityManager $entityManager)
  {
    $this->entityManager = $entityManager;
  }

  public function getPrefectureList()
  {
    try {
      $prefectureList = $this->entityManager->getRepository(Prefecture::class)->findAll();
      $ret = array_map(fn($prefectureList) => $prefectureList->toArray(), $prefectureList);
      return response(json_encode([
        'message' => 'Prefecture data retrieved successfully',
        'data' => $ret
      ], JSON_UNESCAPED_UNICODE), 200, ['Content-Type' => 'application/json']);
    } catch (\Exception $e) {
      return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
    }
  }
}
