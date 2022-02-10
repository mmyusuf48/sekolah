<?php
namespace App\Helpers;

class Converter{
  public static function ResponseApi($status, $message, $response) {
    // return $status.'-'.$message.'-'.$response;
    return response()->json([
      'status'=>$status,
      'massage'=>$message,
      'response'=>$response
    ]);
  }
}