<?php namespace SistemaRestauranteWeb\Http\Controllers\Api;

use Illuminate\Support\Facades\Response;
use SistemaRestauranteWeb\Http\Requests;
use SistemaRestauranteWeb\Http\Controllers\Controller;

use Illuminate\Http\Request;
use SistemaRestauranteWeb\Local;
use SistemaRestauranteWeb\Order;
use SistemaRestauranteWeb\Product;
use SistemaRestauranteWeb\Table;

class TableController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $local = new Local();
        $product =new Product();
		$totalMesas = $local->NumberTable();
        $mesas = [
            'TotalMesas' => $totalMesas,
            'Mesas'  => [],
        ];
        for($i = 0 ;$i <= $totalMesas;$i++){
            if(Table::where('number_table',$i)->get()){
                $mesasData = Table::where(['number_table' => $i,'id_local' => $local->getLocalIdAttribute()])->get();
                    foreach ($mesasData as $mesaData){
                        $orderData = Order::find($mesaData->id_order);
                        $mesas['Mesas'][] = [

                                'NumberTable' => $i,
                                'State' => $mesaData->state,
                                'OrderId' => $orderData->id,
                                'OrderState' => $orderData->state,
                                'ProductId' => $orderData->id_product,
                                'ProductName' => $product->getProductNameAttribute($orderData->id_product),
                        ];
                    }
            }else{
                $mesas['Mesas'][] = [
                    'NumberTable' => $i,
                    'State' => 'disponible'
                ];
            }
        }

        return Response::json(['success' =>true, 'data' => $mesas], 200);

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
        $local = new Local();
        $product =new Product();
        $totalMesas = $local->NumberTable();
        $mesa = [
            'CostTable' => 0,
            'NumberTable' => $id,
            'Pedidos'  => []
        ];
        if($id <= $totalMesas) {
            $mesasData = Table::where(['number_table' => $id,'id_local' => $local->getLocalIdAttribute()])->get();
            foreach ($mesasData as $mesaData) {
                $orderData = Order::find($mesaData->id_order);
                $mesa['CostTable'] = $mesa['CostTable'] + $product->getProductAttributeForId($orderData->id_product,'cost');
                $mesa['Pedidos'][] = [
                    'State' => $mesaData->state,
                    'OrderId' => $orderData->id,
                    'OrderState' => $orderData->state,
                    'ProductId' => $orderData->id_product,
                    'ProductName' => $product->getProductNameAttribute($orderData->id_product),
                    'productCost' => $product->getProductAttributeForId($orderData->id_product,'cost'),
                ];
            }
            return Response::json(['success' =>true, 'data' => $mesa], 200);

        }else{
            return Response::json(['success' =>false], 401);
        }


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
