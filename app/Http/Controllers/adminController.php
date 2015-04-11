<?php namespace SistemaRestauranteWeb\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use SistemaRestauranteWeb\Http\Requests;
use SistemaRestauranteWeb\Http\Controllers\Controller;

use Illuminate\Http\Request;
use SistemaRestauranteWeb\Local;
use SistemaRestauranteWeb\Product;
use SistemaRestauranteWeb\User;
use Symfony\Component\Security\Core\Tests\Authentication\Provider\RememberMeAuthenticationProviderTest;

class adminController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $user = User::all();

        return view('usuarios.admin.estadisticas')->with('user',$user);

    }

    public function estadisticasIndex(){
        $user = User::all();

        return view('usuarios.admin.estadisticas')->with('user',$user);

    }
    public function usuariosIndex(){
        $users = User::all();
        return view('usuarios.admin.usuarios')->with('users',$users );

    }
    public function menuIndex(){
        $Product = new Product();
        $Local   = new Local();
        $products = $Product->getProductsForLocal($Local->getLocalIdAttribute());
        return view('usuarios.admin.menu')->with('products',$products);

    }
    public function restauranteIndex(){
        $local= Local::all();
        return view('usuarios.admin.restaurante')->with('local',$local);

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

}
