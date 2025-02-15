<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppController extends Controller
{
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

    $handle = fopen($file->getPathname(), 'r');
    $is_content = false;
    $years = [];
    while (($row = fgetcsv($handle)) !== false) {
      // Convert from Shift JIS to UTF-8
      $row = array_map(fn($col) => mb_convert_encoding($col, 'UTF-8', 'SJIS-win'), $row);
      if ($is_content) {
        // insert content to database
      }
      if (!$is_content && count(array_slice($row, 1)) === count(array_filter($row, 'is_numeric')) && count(array_filter($row, 'is_numeric')) > 0) {
        $is_content = true;
        $years = $row;
        continue;
      }
    }
    fclose($handle);

    return response()->json(['message' => 'Success', 'data' => $years]);
  }
}
