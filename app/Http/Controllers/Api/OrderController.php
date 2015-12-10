<?php namespace SistemaRestauranteWeb\Http\Controllers\Api;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use SistemaRestauranteWeb\Devuelto;
use SistemaRestauranteWeb\Http\Controllers\productsController;
use SistemaRestauranteWeb\Http\Requests;
use SistemaRestauranteWeb\Http\Controllers\Controller;

use Illuminate\Http\Request;
use SistemaRestauranteWeb\Local;
use SistemaRestauranteWeb\Order;
use SistemaRestauranteWeb\Product;
use SistemaRestauranteWeb\Table;
use SistemaRestauranteWeb\User;


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



        try {
            $idLocal = $local->getLocalIdAttribute();

            Product::findOrFail($request['idProduct']);
            $orderAttr = ['id_product' => $request->idProduct, 'created_by' => Auth::user()->id,'state' => 'espera','id_local' => $idLocal];
            $order = Order::create($orderAttr);

            if($order->save()){
                $tableAttr = ['number_table' => $request->idTable, 'id_order' => $order->id,'state' => 'ocupado','id_local' => $idLocal,'facturar' => false];

                $table = Table::create($tableAttr);
                if($table->save()){
                    $product->updateInventory($request->idProduct,true);
                    $statusCode = 200;
                    $response = ['success' => true];

                }
                else {
                    $statusCode = 500;
                    $response = ['success' => false];
                }
            }

           } catch (Exception $e) {
            $response = [
                "error" => $e->getMessage(),
            ];
            $statusCode = 400;
        } finally {
            return Response::json($response, $statusCode);
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
	public function update(Request $request, $id)
	{
        $product= new Product();

        try{
            $statusCode = 200;
            $product->findOrFail($request->idProduct);
            $product->findOrFail($request->idProductEdit);
            $order = Order::findOrFail($id);
            $this->validate($request, [
                'idProduct'     => 'required',
                'idProductEdit' => 'required'
            ]);

            $order->editar($id,$request);

            if($order->save()){
                $product->updateInventory($request->idProductEdit,true);
                $product->updateInventory($request->idProduct,false);
                $response =['success' => true];
            }
            else {
                $statusCode = 401;
                $response = ['success' => false];
            }
        }catch (Exception $e){
            $response = [
                "error" => $e->getMessage(),
            ];
            $statusCode = 400;
        }finally{
            return Response::json($response,$statusCode);
        }

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

    public function getOrders($status)
    {
        $order          = new Order;
        $producto       = new Product();
        $user           = new User();
        $local          = new Local();
        $table          = new Table();

        try{
            $idLocal = $local->getLocalIdAttribute();
            $orders = $order->getOrdernerPorEstadoYLocal($status,$idLocal);

            $response    = [];
            $statusCode = 200;

            foreach($orders as $data){
                $mesa = $table->getNumeroDeMesaPorOrder($data['id']);
                foreach($mesa as $data2){
                    $mesa = $data2['number_table'];
                }

                $response[] = [
                                'idOrder'           =>      $data['id'],
                                'nombrePlato'       =>      $producto->getProductNameAttribute($data['id_product']),
                                'mesa'              =>      $mesa,
                                'mesonero'          =>      $user->getFullNameUserById($data['created_by']),
                                'comentario'        =>      $data['comentario'],
                                'visto'             =>      $data['comentario_visto']
                            ];
            }

        } catch (Exception $e) {
            $response = [
                "error" => $e->getMessage(),
            ];
            $statusCode = 400;
        } finally {
            return Response::json($response, $statusCode);
        }

    }

    public function returnedOrder(Request $request)
    {
        $retunred   = New Devuelto();
        $local      = New Local();
        $order      = New Order();
        try{
            $this->validate($request, [
                'id_order' => 'required', 'id_product' => 'required','type' => 'required',
            ]);
            $request['id_local']= $local->getLocalIdAttribute();

            $retunred->crearNuevo($request->all());
            $order->setStatusReturned($request->id_order);
            $response = ['success'=>true];
            $statusCode = 200;

        }catch (Exception $e){
            $response = [
                "error" => $e->getMessage(),
            ];
            $statusCode = 400;
        }finally{
            return Response::json($response, $statusCode);

        }
    }

    public function addComentario(Request $request)
    {
        $order = New Order();
        try{
            Order::findOrFail($request['idOrder']);
            $order->addOrEditComentario($request['idOrder'],$request);

            $response = ['success'=>true];
            $statusCode = 200;

        }catch (Exception $e){
            $response = [
                "error" => $e->getMessage(),
            ];
            $statusCode = 400;
        }finally{
            return Response::json($response, $statusCode);

        }
    }
    public function deleteComentario(Request $request)
    {
        $order = New Order();
        try{
            Order::findOrFail($request['idOrder']);
            $request['comentario'] = "";
            $order->addOrEditComentario($request['idOrder'],$request);

            $response = ['success'=>true];
            $statusCode = 200;

        }catch (Exception $e){
            $response = [
                "error" => $e->getMessage(),
            ];
            $statusCode = 400;
        }finally{
            return Response::json($response, $statusCode);

        }
    }

}
