<?php 
namespace App\Traits;

trait Response {


	public function errorResponse($exception) 
	{
		return response()->json([
			'status' => false,
			'message' => $exception->getMessage()
		]);
	}

	public function successResponse($message,$data) 
	{
		return response()->json([
			'status' => true,
			'message' => $message,
			'data' => $data
		]);
	}
}