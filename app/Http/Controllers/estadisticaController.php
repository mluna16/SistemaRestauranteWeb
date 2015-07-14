<?php namespace SistemaRestauranteWeb\Http\Controllers;

use Carbon\Carbon;
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
                    'name' => $usuario->full_name,
                    'y' => $Order->getOrdenMesoneroPorfecha($usuario['id'], $time)
                ];
            }
        }
        return Response::json($retorno,200);
    }
    public  function getVentaDia(){

        $fecha = Carbon::now();
        $Order          = new Order();
        $Product        = new Product();
        $totalVenta   = 0;
        $totalVentas = $Order->getOrdenVentas($fecha->subDays(1));

        foreach($totalVentas as $venta){
          $totalVenta = $totalVenta+  $Product->getCostProduct($venta['id_product']);
        }
        $retorno[]= [
                'name'  => 'Hoy '.Carbon::now()->format('d m y'),
                'data'  => [$totalVenta]
        ];

        return Response::json($retorno,200);
    }
    public  function getVentaSemana(){
        $Order          = new Order();
        $Product        = new Product();
        $semana       = [1,2,3,4,5,6,7];
        $retorno          = [];
        foreach($semana as $i){
            $totalVentas    = $Order->getOrdenVentasdobles(Carbon::now()->subDays($i),Carbon::now()->subDays($i-1));
            $totalVenta     = 0;
            foreach($totalVentas as $venta){
                $totalVenta = $totalVenta +  $Product->getCostProduct($venta['id_product']);
            }
            $retorno[] = [
                'name' => Carbon::now()->subDays($i)->format('d m y'),
                'data' => [$totalVenta]
            ];
        }
        return Response::json($retorno,200);
    }
}
