<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Cooperative;
use App\Models\Gic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
	/*
	 *  Login action
	 */


	//Please add this method
	public function login() {
		// get email and password from request
		$credentials = request(['phone', 'password']);

		// try to auth and get the token using api authentication
		if (!$token = auth('api')->attempt($credentials)) {
			// if the credentials are wrong we send an unauthorized error in json format
			return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = auth('api')->user();
        $gics = Gic::all()->where('zone_id',auth('api')->user()->zone_id);
        $coops = Cooperative::all()->where('region_id',auth('api')->user()->region_id);

		return response()->json([
			'token' => $token,
			'type' => 'bearer', // you can ommit this
			'expires' => auth('api')->factory()->getTTL() * 60, // time to expiration
            'user'=>auth('api')->user(),
            'gics'=>$gics,
            'cooperatives'=>$coops,

		]);
	}

	public function test(Request $request){
		$headers = $request->headers;
		dd($headers);
	}


	/**
	 * Register api.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function register(Request $request)
	{
 		 $validator = Validator::make($request->all(), [
			'name' => 'required',
			'phone' => 'required|unique:users',
			'password' => 'required',
		]);
		if ($validator->fails()) {
			return response()->json([
				'success' => false,
				'message' => $validator->errors(),
			], 401);
		}
		$input = $request->all();
		$input['password'] = bcrypt($input['password']);
        $input['token'] = sha1(date('Yhimds'));
        $credentials = request(['phone', 'password']);
		$user = Client::create($input);
		//$success['token'] = $user->createToken('appToken')->accessToken;
        $token = auth('api')->attempt($credentials);
        return response()->json([
			'success' => true,
			'token' => $token,
			'user' => $user
		]);
	}

}
