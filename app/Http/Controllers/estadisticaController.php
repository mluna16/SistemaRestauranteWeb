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
        $local          = new Local();
        $idLocal        = $local->getLocalIdAttribute();
        $totalProductos = $Product->getAllProductInformationByLocalFor();
        $sumaTotal = 0;

        foreach($totalProductos as $Producto){
            $data[] = [
                        'name'  => $Producto['name'],
                        'y'     => $Order->getOrdenProductoPorfecha($Producto['id_product'],$time,$idLocal),
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
        $local          = new Local();
        $idLocal        = $local->getLocalIdAttribute();
        $totalUsuarios = $User->getUserByCretedBy(Auth::user()->id);

        foreach($totalUsuarios as $usuario){
            if($usuario['type'] == "mesonero"){
                $retorno[] = [
                    'name' => $usuario->full_name,
                    'y' => $Order->getOrdenMesoneroPorfecha($usuario['id'], $time,$idLocal)
                ];
            }
        }
        return Response::json($retorno,200);
    }
    public  function getVentaDia(){

        $fecha = Carbon::now('America/Caracas');
        $Order          = new Order();
        $Product        = new Product();
        $local          = new Local();
        $idLocal        = $local->getLocalIdAttribute();
        $totalVenta   = 0;
        $totalVentas = $Order->getOrdenVentas($fecha->subDays(1),$idLocal);

        foreach($totalVentas as $venta){
          $totalVenta = $totalVenta+  $Product->getCostProduct($venta['id_product']);
        }
        $retorno[]= [
                'name'  => 'Hoy '.Carbon::now('America/Caracas')->format('d-m-y'),
                'data'  => [$totalVenta]
        ];

        return Response::json($retorno,200);
    }
    public  function getVentaSemana(){
        $Order          = new Order();
        $Product        = new Product();
        $local          = new Local();
        $idLocal        = $local->getLocalIdAttribute();
        $semana       = [0,1,2,3,4,5,6,7];
        $retorno          = [];
        foreach($semana as $i){
            if($i==0){
                $totalVenta = $Order->getOrdenVentas(Carbon::now('America/Caracas')->subDays(1),$idLocal);
            }else{
                $totalVentas    = $Order->getOrdenVentasdobles(Carbon::now('America/Caracas')
                    ->subDays($i),Carbon::now('America/Caracas')->subDays($i-1),$idLocal);
            }

            $totalVenta     = 0;
            foreach($totalVentas as $venta){
                $totalVenta = $totalVenta +  $Product->getCostProduct($venta['id_product']);
            }
            $retorno[] = [
                'name' => Carbon::now('America/Caracas')->subDays($i)->format('d-m-y'),
                'data' => [$totalVenta]
            ];
        }

        return Response::json($retorno,200);
    }
    public  function getVentaAno(){
        $Order          = new Order();
        $Product        = new Product();
        $local          = new Local();
        $idLocal        = $local->getLocalIdAttribute();
        $semana       = [0,1,2,3,4,5,6,7,8,9,10,11,12];
        $retorno          = [];

        foreach($semana as $i){
            $totalVentas    = $Order->getOrdenVentasdobles(Carbon::now('America/Caracas')
                                    ->subMonths($i),Carbon::now('America/Caracas')->subMonths($i-1),$idLocal);
            $totalVenta     = 0;
            foreach($totalVentas as $venta){
                $totalVenta = $totalVenta +  $Product->getCostProduct($venta['id_product']);
            }
            setlocale(LC_TIME, 'Spanish');
            $dt = Carbon::now('America/Caracas')->subMonths($i)->formatLocalized('%B %Y');
            $retorno[] = [

                'name' => $dt,
                'data' => [$totalVenta]
            ];
        }
        return Response::json($retorno,200);
    }
}
