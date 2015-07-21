<?php namespace SistemaRestauranteWeb\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use SistemaRestauranteWeb\Http\Controllers\productsController;
use SistemaRestauranteWeb\Http\Requests;
use SistemaRestauranteWeb\Http\Controllers\Controller;

use Illuminate\Http\Request;
use SistemaRestauranteWeb\Local;
use SistemaRestauranteWeb\Order;
use SistemaRestauranteWeb\Product;
use SistemaRestauranteWeb\Table;


class OrderController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{


	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        $local = new Local();
        $product = new Product();
        $this->validate($request, [
            'idTable' => 'required', 'idProduct' => 'required',
        ]);

        $orderAttr = ['id_product' => $request->idProduct, 'created_by' => Auth::user()->id,'state' => 'espera'];
        $order = Order::create($orderAttr);

        if($order->save()){
            $tableAttr = ['number_table' => $request->idTable, 'id_order' => $order->id,'state' => 'ocupado','id_local' => $local->getLocalIdAttribute(),'facturar' => false];
            $table = Table::create($tableAttr);
            if($table->save()){
                $product->updateInventory($request->idProduct,true);
                return Response::json(array('success' => true),200);
            }
            else return Response::json(array('success' => false),500);
        }
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
        $order = Order::find($id);
        $product= new Product();
        if($order->delete()){
            $product->updateInventory($order->id_product,false);
            return Response::json(array('success' => true),200);
        }
        else return Response::json(array('success' => false),401);
	}

    public function changeReady(Request $request){
        $order = new Order();
        $this->validate($request, [
            'idOrder' => 'required'
        ]);
        if($order->setStatus($request->idOrder)){
            return Response::json(array('success' => true),200);
        }
        else return Response::json(array('success' => false),401);

    }

}
