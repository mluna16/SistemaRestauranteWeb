<?php namespace SistemaRestauranteWeb\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use SistemaRestauranteWeb\Http\Requests;
use SistemaRestauranteWeb\Http\Controllers\Controller;

use Illuminate\Http\Request;
use SistemaRestauranteWeb\Local;
use SistemaRestauranteWeb\Product;
use SistemaRestauranteWeb\Table;
use SistemaRestauranteWeb\User;


class cajaController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
    {
        $user = new User();
        $local = new Local();
        $table = new Table();

        $data = $table->getAllTablesForLocal($local->getLocalIdAttribute());
        $view = View::make('usuarios.caja.infoPedido')->with('data',$data);
        if(! $user->getIsAFirstTimeUser()){
            if($request->ajax()){
                $sections = $view->renderSections();
                return Response::json($sections['tablesPanel']); // se envie el sections con un formato json
            }else return $view;
        }else{
            return $user->ReturnToFirstTime();
        }
    }


    public function getInfotable($id)    {
        $table = new Table;
        return Response::json(['success' => true, 'data' => $table->getInfoTableForNumberTable($id)]);
    }
}
