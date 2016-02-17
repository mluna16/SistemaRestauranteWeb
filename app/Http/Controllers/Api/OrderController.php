<?php namespace SistemaRestauranteWeb\Http\Controllers\Api;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use SistemaRestauranteWeb\Devuelto;
use SistemaRestauranteWeb\Http\Controllers\productsController;
use SistemaRestauranteWeb\Http\Controllers\UtilidadesContronller;
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
        $local      = new Local();
        $user       = new User();
        $product    = new Product();
        $util       = new UtilidadesContronller();
        $this->validate($request, [
            'idTable' => 'required', 'idProduct' => 'required','cantidad' => 'required'
        ]);
        $cantidad = intval($request['cantidad']);


        try {
            $idLocal            = $local->getLocalIdAttribute();
            $code             = $user->getCodeUserForLocal($idLocal,'cocina');
            $nombreProducto     = $product->getName($request['idProduct']);

            for($i = 0; $i < $cantidad ;$i++){
                Product::findOrFail($request['idProduct']);
                $orderAttr = ['id_product' => $request->idProduct, 'created_by' => Auth::user()->id,'state' => 'espera','id_local' => $idLocal];
                $order = Order::create($orderAttr);

                if($order->save()){
                    $tableAttr = ['number_table' => $request->idTable, 'id_order' => $order->id,'state' => 'ocupado','id_local' => $idLocal,'facturar' => false];

                    $table = Table::create($tableAttr);
                    if($table->save()){
                        $product->updateInventory($request->idProduct,true);
                        $statusCode = 200;
                        $msg = [
                            'message' 	=> 'Se creo una order para la mesa '.$request['idTable'],
                            'title'		=> 'Nueva Orden',
                            'subtitle'	=> 'Producto solicitado: '.$nombreProducto,
                            'tickerText'	=> 'cocina',
                            'vibrate'	=> 1,
                        ];
                        $util->sendPush($code,$msg);

                    }
                    else {
                        $statusCode = 400;
                        $response = ['success' => false];
                    }
                }
            }
            $statusCode = 200;
            $response = ['success' => true];



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
        $user       = New User();
        $product    = New Product();
        $table      = New Table();
        $util       = New UtilidadesContronller();
        try{
            $statusCode = 200;
            $product->findOrFail($request->idProduct);
            $product->findOrFail($request->idProductEdit);
            $order = Order::findOrFail($id);
            $this->validate($request, [
                'idProduct'     => 'required',
                'idProductEdit' => 'required'
            ]);
            $orden                  =  Order::findOrFail($id);
            $code                   = $user->getCodeUserForLocal($orden->id_local,'cocina');
            $nombreProductoEntra    = $product->getName($orden->idProduct);
            $nombreProductoSale     = $product->getName($orden->idProductEdit);
            $mesa                   = $table->getNumeroDeMesaPorOrder($id);
            $msg = [
                'message' 	=> 'Se edito una orden en la mesa '.$mesa[0]->number_table,
                'title'		=> 'Orden edita',
                'subtitle'	=> 'Se quito el prodcuto: '.$nombreProductoSale.' y se cambio por '.$nombreProductoEntra,
                'tickerText'	=> 'cocina',
                'vibrate'	=> 1,
            ];
            $order->editar($id,$request);

            if($order->save()){
                $product->updateInventory($request->idProductEdit,true);
                $product->updateInventory($request->idProduct,false);
                $util->sendPush($code,$msg);

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
        $order      = New Order();
        $user       = New User();
        $product    = New Product();
        $table      = New Table();
        $util       = New UtilidadesContronller();
        try{
            $orden =  Order::findOrFail($id);
            $code             = $user->getCodeUserForLocal($orden->id_local,'cocina');
            $nombreProducto     = $product->getName($orden->id_product);
            $mesa               = $table->getNumeroDeMesaPorOrder($id);
            $msg = [
                'message' 	=> 'Se elimino una orden en la mesa '.$mesa[0]->number_table,
                'title'		=> 'Orden Eliminada',
                'subtitle'	=> 'Producto eliminado: '.$nombreProducto,
                'tickerText'	=> 'cocina',
                'vibrate'	=> 1,
            ];

            if($order->delete()){
                $product->updateInventory($order->id_product,false);
                $util->sendPush($code,$msg);
                return Response::json(array('success' => true),200);
            }
            else return Response::json(array('success' => false),401);
        }catch (Exception $e){
            $response = [
                "error" => $e->getMessage(),
            ];
        $statusCode = 400;
        }finally{
            return Response::json($response,$statusCode);
        }
	}

    public function changeReady(Request $request){

        $order      = New Order();
        $user       = New User();
        $product    = New Product();
        $table      = New Table();
        $util       = New UtilidadesContronller();
        try{
            $this->validate($request, [
                'idOrder' => 'required'
            ]);

            $orden =  Order::findOrFail($request['idOrder']);
            $code             = $user->getCodeUser(Auth::user()->id);
            $nombreProducto     = $product->getName($orden->id_product);
            $mesa               = $table->getNumeroDeMesaPorOrder($request['idOrder']);
            $msg = [
                'message' 	=> 'El producto  '.$nombreProducto.' de la mesa '.$mesa[0]->number_table.' esta listo',
                'title'		=> 'Orden Lista',
                'subtitle'	=> 'Producto : '.$nombreProducto,
                'tickerText'	=> 'mesonero',
                'vibrate'	=> 1,
            ];

            if($order->setStatus($request->idOrder)){
                $response = ['success' => true];
                $util->sendPush($code,$msg);
                    $statusCode = 200;
            }
            else {
                $response = ['success' => false];
                $statusCode = 401;
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
        $user       = New User();
        $product    = New Product();
        $table      = New Table();
        $util       = New UtilidadesContronller();
        try{
            $this->validate($request, [
                'id_order' => 'required', 'id_product' => 'required','type' => 'required',
            ]);

            $orden =  Order::findOrFail($request['id_order']);
            $code             = $user->getCodeUserForLocal($orden->id_local,'cocina');
            $nombreProducto     = $product->getName($request['id_product']);
            $mesa               = $table->getNumeroDeMesaPorOrder($request['id_order']);

            $msg = [
                'message' 	=> 'Se genero una devolucion para la mesa '.$mesa[0]->number_table,
                'title'		=> 'Nueva Devolucion',
                'subtitle'	=> 'Producto devuelto: '.$nombreProducto,
                'tickerText'	=> 'cocina',
                'vibrate'	=> 1,
            ];
            $request['id_local']= $local->getLocalIdAttribute();

            $retunred->crearNuevo($request->all());
            $order->setStatusReturned($request->id_order);
            $util->sendPush($code,$msg);
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
           $orden =  Order::findOrFail($request['idOrder']);

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
