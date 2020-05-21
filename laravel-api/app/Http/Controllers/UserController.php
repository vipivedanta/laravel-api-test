<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Traits\Response;
use App\User;
use Hash;

class UserController extends Controller
{	

	use Response;
    
    public function register(Request $request) 
    {
    	try {

    		$user = new User;
    		$user->name = $request->name;
    		$user->email = $request->email;
    		$user->password = Hash::make($request->password);
    		$user->save();

    		return $this->successResponse('You have been resgistered successfully',[
    			'id' => $user->id,
    			'name' => $user->name
    		]);

    	}catch(Exception $e) {
    		return $this->errorResponse($e);
    	}
    }
}
