<?php namespace SistemaRestauranteWeb\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use SistemaRestauranteWeb\Http\Requests;
use SistemaRestauranteWeb\Http\Controllers\Controller;

use Illuminate\Http\Request;
use SistemaRestauranteWeb\Local;
use SistemaRestauranteWeb\Order;
use SistemaRestauranteWeb\Product;
use SistemaRestauranteWeb\User;

class estadisticaController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public  function getProductosVendidos($time){

        $Product    = new Product();
        $Order      = new Order();
        $totalProductos = $Product->getAllProductInformationByLocalFor();
        $sumaTotal = 0;

        foreach($totalProductos as $Producto){
            $data[] = [
                        'name'  => $Producto['name'],
                        'y'     => $Order->getOrdenProductoPorfecha($Producto['id_product'],$time),
            ];

        }
        /*foreach($data as $val){
            $sumaTotal = $sumaTotal + $val['y'];
        }

        foreach($data as $i => $val){
            $data[$i]['y'] = ($val['y']/$sumaTotal)*100;
        }
        $retorno = [
            'total' => $sumaTotal,
            'data'  => $data,
        ];*/
        return Response::json($data,200);
    }
    public  function getMesoneroVenta($time){

        $User    = new User();
        $Order      = new Order();
        $totalUsuarios = $User->getUserByCretedBy(Auth::user()->id);

        foreach($totalUsuarios as $usuario){
            if($usuario['type'] == "mesonero"){
                $retorno[] = [
                    'Nombre' => $usuario->full_name,
                    'venta' => $Order->getOrdenMesoneroPorfecha($usuario['id'], $time)
                ];
            }
        }
        return Response::json($retorno,200);
    }
}
