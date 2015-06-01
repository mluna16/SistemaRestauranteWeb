<?php namespace SistemaRestauranteWeb\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use SistemaRestauranteWeb\Http\Requests;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use SistemaRestauranteWeb\Http\Controllers\Controller;

use Illuminate\Http\Request;
use SistemaRestauranteWeb\Local;
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
        if (!$user->getIsAFirstTimeUser()) {
            if ($request->ajax()) {
                $data = $table->getInfoTableForNumberTable(1);
                $view = View::make('usuarios.caja.infoPedido')->with('data', $data);
                $sections = $view->renderSections();
                return Response::json($sections['InfoPedido']);
            } else {
                return view('usuarios.caja.caja')->with('data', $data);
            }
        }else{
                return $user->ReturnToFirstTime();
            }
        }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    public function getInfotable($id)
    {
        $table = new Table;
        return Response::json(['success' => true, 'data' => $table->getInfoTableForNumberTable($id)]);





    }
}
