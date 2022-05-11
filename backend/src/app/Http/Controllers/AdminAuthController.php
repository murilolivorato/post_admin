<?php

namespace App\Http\Controllers;


use Validator;



use Illuminate\Contracts\Auth\Guard;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Http\Requests\LoginRequest;


use Auth;
use App\Models\UserAdmin;

use App\Classes\Auth\VerifyUserPassword;
use GuzzleHttp\Exception\ClientException;

class AdminAuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */



    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $auth;

    /**
     * Create a new controller instance.
     *confi
     * @return void
     */
   /* public function __construct(Guard $auth)
    {

        $this->middleware('guest', ['except' => ['getLogin','logout', 'getLogout']]);
        $this->auth = $auth;


    }*/

    /*---------------------------------------------------------------------------------
--------------------------------------------------------------------------- POST LOGIN */
    /**
     * @param LoginRequest $request
     * @return void
     */
    public function postLogin(LoginRequest $request){
        return VerifyUserPassword::process($request , 'user_admin');
    }

    /*--------------------------------------------------------------------------  USER INFO */
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function info(Request $request){
        try {
            $user = auth('user_admin')->user();

            $user_admin = UserAdmin::find($user->id);

            return response()->json([
                'email' => $user->email,
                'name' => isset($user_admin->AdminInfo->name) ? $user_admin->AdminInfo->name : null,
                'last_name' => isset($user_admin->AdminInfo->last_name) ? $user_admin->AdminInfo->last_name : null,
                'image_profile' => $user_admin->ImageProfile()->exists() ? $user_admin->ImageProfile->ImagePathUrl : null
            ]);
        } catch (ClientException $e) {
            return response()->json(['message'  =>   'não carregoru informações do usuário' ] , 400);
        }
    }

    /*--------------------------------------------------------------------------  REGISTER */
    /**
     * @param Request $request
     * @return void
     */
    public function register(Request $request){

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLogout(){
        if(auth('user_admin')->user()) {
            auth('user_admin')->user()->tokens->each(function ($token, $key) {
                $token->delete();
            });
        }
        return response()->json('Logged out successfully', 200);

    }










}
