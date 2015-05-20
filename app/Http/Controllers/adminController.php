<?php namespace SistemaRestauranteWeb\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
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


    public function estadisticasIndex(){
        $user = new User();
        if(! $user->getIsAFirstTimeUser()) return view('usuarios.admin.estadisticas');
        else return $user->ReturnToFirstTime();
    }

    /**
     * @return $this
     */
    public function usuariosIndex(){
        $user = new User();
        $users = $user->getUserByCretedBy(Auth::user()->id);
        if(! $user->getIsAFirstTimeUser()) return view('usuarios.admin.usuarios')->with('users',$users );
    }
    public function menuIndex(Request $request){
        $Product = new Product();
        $user    = new User();
        $products = $Product->getAllProductInformationByLocalFor();
        if(! $user->getIsAFirstTimeUser()){
            $view = View::make('usuarios.admin.menu')->with('products',$products);
            if($request->ajax()) {
                $sections = $view->renderSections();
                return Response::json($sections['infoPanel']);

            }else return $view;
        }
        else {
            return $user->ReturnToFirstTime();
        }
    }
    public function restauranteIndex(Request $request){
        $user = new User();
        $local= new Local();
        if(! $user->getIsAFirstTimeUser()){
            $view = View::make('usuarios.admin.restaurante')->with('local',$local->getAllLocalInformationByUser(Auth::user()->id));
            if($request->ajax()){
                $sections = $view->renderSections();
                return Response::json($sections['infoPanel']);
            }else return$view;
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

}
