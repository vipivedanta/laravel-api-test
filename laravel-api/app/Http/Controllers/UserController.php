<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Traits\Response;
use App\User;
use Hash;
use Auth;
use Str;

use App\Http\Requests\Users\RegisterRequest;
use App\Http\Requests\Users\LoginRequest;

class UserController extends Controller
{	

	use Response;
    
    public function register(RegisterRequest $request) 
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

    public function login(LoginRequest $request) {

    	try{

    		$user = Auth::attempt([
    			'email' => $request->email,
    			'password' => $request->password
    		]);

    		if(!$user) throw new Exception("Invalid username or password", 1);

            $user = $this->refreshApiToken();

            return $this->successResponse('Successfully loggedin',$user);            

    	}catch(Exception $e) {
    		return $this->errorResponse($e);
    	}
    }

    public function logout(Request $request) {

        try{

            $this->refreshApiToken();
            return $this->successResponse('Successfully logged out',[]);

        }catch(Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function refreshApiToken() 
    {
        $user = Auth::user();
        $user->api_token = Str::uuid(4,'');
        $user->save();     

        return $user;   
    }
}
