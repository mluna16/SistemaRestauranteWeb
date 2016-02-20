<?php namespace SistemaRestauranteWeb\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Response;
use SistemaRestauranteWeb\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;

use Illuminate\Http\Request;
use SistemaRestauranteWeb\Local;
use SistemaRestauranteWeb\User;

class LoginController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;

    }
    protected $auth;


    /**
     * @param Request $request
     * @param Local $local
     * @param User $user
     * @return mixed
     */
    public function postLogin(Request $request, Local $local,User $user){
        $user = New User();
        //Test curl -X POST -d "email=marcos@luna.com&password=12345" http://restaurante.local/api/v1/login
        $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if ($this->auth->attempt($credentials,false ))
        {
            if(Auth::user()->type == 'mesonero' || Auth::user()->type == 'cocina') {
                $user->changeVerificationSession(Auth::user()->id,true);
                $response = [
                    'userData' => Auth::user(),
                    'userSession' => Auth::check(),
                    'userCookie' => $request->cookie('laravel_session'),
                    'localData' => $local->getLocalForUser(),
                ];
                return Response::json(array('success' => true, 'data' => $response), 200)->withCookie(cookie('laravel_session'));
            }else{
                $response = ['error' => 'No tiene  credenciales'];
                $this->auth->logout();
                $cookie = Cookie::forget('laravel_session');
                return Response::json(array('success' => false, 'data' => $response),401);

            }
        }else{
            $response = ['error' => 'No tiene credenciales'];
            return Response::json(array('success' => false, 'data' => $response),401);
        }
    }

    public function getLogout(Request $request)
    {
        $user = new User;
        $user->changeVerificationSession(Auth::user()->id,false);

        //Test curl -X GET   http://restaurante.local/api/v1/logout
        Cookie::queue('laravel_session',null, -1);
        $cookie = Cookie::forget('laravel_session');

        $this->auth->logout();
        return Response::json(['success' => true],200)->withCookie($cookie);
    }

}
