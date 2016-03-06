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
    public function usuariosIndex(Request $request){
        $user = new User();
        $users = $user->getUserByCretedBy(Auth::user()->id);
        $users['primero'] = true;
        if(! $user->getIsAFirstTimeUser()){
            $view = View::make('usuarios.admin.usuarios')->with('users',$users);
            if($request->ajax()) {
                $sections = $view->renderSections();
                return Response::json($sections['infoPanel']);
            }else return $view;
        }
        else {
            return $user->ReturnToFirstTime();
        }
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

    public function createUserModal(Request $request){
        $view = View::make('partials.admin.ModalCreateUser');
        if($request->ajax()) {
            $sections = $view->renderSections();
            return Response::json($sections['modalUser']);
        }
    }

    public function createMenuModal(Request $request){
        $view = View::make('partials.admin.ModalCreateMenu');
        if($request->ajax()) {
            $sections = $view->renderSections();
            return Response::json($sections['modalMunu']);
        }
    }
}
