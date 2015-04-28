<?php namespace SistemaRestauranteWeb\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use SistemaRestauranteWeb\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;

use Illuminate\Http\Request;

class ApiController extends Controller {

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


    public function postLogin(Request $request){
        //Test curl -X POST -d "email=marcos@luna.com&password=12345" http://restaurante.local/api/v1/login
        $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if ($this->auth->attempt($credentials,false ))
        {
            $response = ['UserData' => Auth::user(),'UserSession'=>Auth::check()];
            return Response::json($response,200);

        }else{

            $response = ['error' => 'No tiene credenciales'];
            return Response::json($response,401);
        }
    }

    public function getLogout()
    {
        //Test curl -X GET   http://restaurante.local/api/v1/logout

        $this->auth->logout();
        $response = ['message' => 'ok'];
        return Response::json($response,200);
    }

}
