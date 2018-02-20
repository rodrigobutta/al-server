<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use IlluminateHttpRequest;

use AppHttpRequests;
use AppHttpControllersController;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthenticateController extends Controller
{

    private $guard;

    public function __construct()
    {

        $this->guard = \Auth::guard('api');
    }


    public function store(Request $request)
    {

        // attempt to verify the credentials and create a token for the user
        if ( ! $token = $this->guard->attempt($request->only(['email', 'password']))) {
            // return $this->setStatusCode(Response::HTTP_UNAUTHORIZED)->respond(['message' => 'Invalid email or password.']);
            return response(['message' => 'Invalid email or password.'],403);
        }


        return response(['message' => 'Login Successful', 'token' => $token, 'user' => $this->guard->user()]);

    }



    // public function index()
    // {
    //     // TODO: show users
    // }

    // public function authenticate(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     try {
    //         // verify the credentials and create a token for the user
    //         if (! $token = JWTAuth::attempt($credentials)) {
    //             return response()->json(['error' => 'invalid_credentials'], 401);
    //         }
    //     } catch (JWTException $e) {
    //         // something went wrong
    //         return response()->json(['error' => 'could_not_create_token'], 500);
    //     }

    //     // if no errors are encountered we can return a JWT
    //     return response()->json(compact('token'));
    // }




}