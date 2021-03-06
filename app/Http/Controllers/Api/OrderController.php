<?php namespace SistemaRestauranteWeb\Http\Controllers\Api;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use SistemaRestauranteWeb\Devuelto;
use SistemaRestauranteWeb\ExtraOrden;
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

	public function store(Request $request)
	{
        $local      = new Local();
        $user       = new User();
        $product    = new Product();
        $util       = new UtilidadesContronller();
        $table      = New Table();
        $extra      = new ExtraOrden();
        $this->validate($request, [
            'idTable' => 'required', 'idProduct' => 'required','cantidad' => 'required'
        ]);
        $cantidad = intval($request['cantidad']);


        try {
            $idLocal            = $local->getLocalIdAttribute();
            $code               = $user->getUserCodes($idLocal);
            $cocinaId           = $user->getCocinaId($idLocal);
            $nombreProducto     = $product->getName($request['idProduct']);
            $checkTable         = $table->checkTableInit($request->idTable);

            for($i = 0; $i < $cantidad ;$i++){
                Product::findOrFail($request['idProduct']);
                $orderAttr = ['id_product' => $request->idProduct, 'created_by' => Auth::user()->id,'state' => 'espera','id_local' => $idLocal];
                $order = Order::create($orderAttr);

                if($order->save()){
                    if($request['extra'] !=null){
                        foreach($request['extra'] as $data2){
                            $dataExtra = [
                                            'id_order'      => $order->id,
                                            'id_product'    => $data2['id_product']
                                            ];
                            $extra->createNew($dataExtra);

                        }

                    }

                    $tableAttr = ['number_table' => $request->idTable, 'id_order' => $order->id,'state' => 'ocupado','id_local' => $idLocal,'facturar' => false];

                    $table = Table::create($tableAttr);
                    if($table->save()){
                        $product->updateInventory($request->idProduct,true);
                        $statusCode = 200;
                        $msg = [
                            'message' 	        => 'Se creo una order para la mesa '.$request['idTable'],
                            'title'		        => 'Nueva Orden',
                            'subtitle'	        => 'Producto solicitado: '.$nombreProducto,
                            'tickerText'	    => 'cocina',
                            'idusuario'         =>  $cocinaId,
                            'numero_mesa'       =>  $request['idTable'],
                            'idproduct'         => $order->id_product,
                            'costproduct'       => $product->getCostProduct($request->idProduct),
                            'idorder'           => $order->id,
                            'createdby'         => $order->created_by
                        ];

                        foreach($code as $data){
                            $msg['idusuario'] = $data['id'];
                            $util->sendPush($data['codigo'],$msg);
                        }

                        if($checkTable) $this->sendTableInit($code,$request['idTable'],$order->created_by);
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
     * @param Request $request
     * @param  int $id
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
            $orden                  =  Order::findOrFail($id);

            $this->validate($request, [
                'idProduct'     => 'required',
                'idProductEdit' => 'required'
            ]);

            $code                   = $user->getUserCodes($orden->id_local);
            $nombreProductoEntra    = $product->getName($request['idProduct']);
            $nombreProductoSale     = $product->getName($request->idProductEdit);
            $mesa                   = $table->getNumeroDeMesaPorOrder($id);
            $cocinaId               = $user->getCocinaId($orden->id_local);

            $msg = [
                'message' 	        => 'Se edito una orden en la mesa '.$mesa[0]->number_table,
                'title'		        => 'Orden editada',
                'subtitle'	=> 'Se quito el prodcuto: '.$nombreProductoSale.' y se cambio por '.$nombreProductoEntra,
                'tickerText'	    => 'cocina',
                'idusario'          => $cocinaId,
                'numero_mesa'       => $mesa[0]->number_table,
                'idporductin'       => $request['idProduct'],
                'idproductout'      => $request['idProductEdit'],
                'costproduct'       => $product->getCostProduct($request['idProduct']),
                'idorder'           => $id,
                'createdby'         => $orden->created_by,
                'vibrate'	=> 1,
            ];

            $orden->editar($id,$request);

            if($orden->save()){
                $product->updateInventory($request->idProductEdit,true);
                $product->updateInventory($request->idProduct,false);
                foreach($code as $data){
                    $msg['idusuario'] = $data['id'];
                    $util->sendPush($data['codigo'],$msg);
                }
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
            $code             = $user->getUserCodes($orden->id_local);
            $nombreProducto     = $product->getName($orden->id_product);
            $mesa               = $table->getNumeroDeMesaPorOrder($id);
            $cocinaId               = $user->getCocinaId($orden->id_local);
            $msg = [
                'message' 	=> 'Se elimino una orden en la mesa '.$mesa[0]->number_table,
                'title'		=> 'Orden Eliminada',
                'subtitle'	=> 'Producto eliminado: '.$nombreProducto,
                'tickerText'	=> 'cocina',
                'vibrate'	=> 1,
                'idusario'          => $cocinaId,
                'numero_mesa'       => $mesa[0]->number_table,
                'createdby'         => $orden->created_by,
                'idorder'           => $id,

            ];

            if($orden->delete()){
                $product->updateInventory($orden->id_product,false);
                foreach($code as $data){
                    $msg['idusuario'] = $data['id'];
                    $util->sendPush($data['codigo'],$msg);
                }
                $checkTable         = $table->checkTableInit($mesa[0]->number_table);

                if($checkTable){
                    $this->sendTableEnd($code,$mesa[0]->number_table,$orden->created_by);
                }

                $response = ['success' => true];
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
            $code             = $user->getUserCodes($orden->id_local);
            $nombreProducto     = $product->getName($orden->id_product);
            $mesa               = $table->getNumeroDeMesaPorOrder($request['idOrder']);
            $msg = [
                'message' 	=> 'El producto  '.$nombreProducto.' de la mesa '.$mesa[0]->number_table.' esta listo',
                'title'		=> 'Orden Lista',
                'subtitle'	=> 'Producto : '.$nombreProducto,
                'tickerText'	=> 'mesonero',
                'vibrate'	=> 1,
                'idusario'          => $orden->created_by,
                'numero_mesa'       => $mesa[0]->number_table,
                'idorder'           => $request['idOrder'],
                'createdby'         => $orden->created_by,


            ];

            if($order->setStatus($request->idOrder)){
                $response = ['success' => true];

                foreach($code as $data){
                    $msg['idusuario'] = $data['id'];
                    $util->sendPush($data['codigo'],$msg);
                }
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
        $extra          = new ExtraOrden();
        try{
            $idLocal = $local->getLocalIdAttribute();
            $orders = $order->getOrdernerPorEstadoYLocal($status,$idLocal);
            $response    = [];
            $statusCode = 200;
            foreach($orders as $i => $data){
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
                    'visto'             =>      $data['comentario_visto'],
                    'extra'             =>      null
                ];
                if($extra->countExtra($data['id']) >0){
                    $extraData  = $extra->getForIsOrder($data['id']);
                    $response[$i]['extra'] = $extraData['data'];
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
    public function returnedOrder(Request $request)
    {
        $retunred   = New Devuelto();
        $local      = New Local();
        $order      = New Order();
        $user       = New User();
        $product    = New Product();
        $table      = New Table();
        $util       = New UtilidadesContronller();
        $request['id_order'] = intval($request['id_order']);
        try{
            $this->validate($request, [
                'id_order' => 'required', 'id_product' => 'required','type' => 'required',
            ]);

            $orden =  Order::findOrFail($request['id_order']);
            $code             = $user->getUserCodes($orden->id_local);
            $nombreProducto     = $product->getName($request['id_product']);
            $mesa               = $table->getNumeroDeMesaPorOrder($request['id_order']);
            $cocinaId               = $user->getCocinaId($orden->id_local);
            $msg = [
                'message' 	=> 'Se genero una devolucion para la mesa '.$mesa[0]->number_table,
                'title'		=> 'Nueva Devolucion',
                'subtitle'	=> 'Producto devuelto: '.$nombreProducto,
                'tickerText'	=> 'cocina',
                'vibrate'	=> 1,
                'idusario'          => $cocinaId,
                'numero_mesa'       => $mesa[0]->number_table,
                'idorder'           => $request['id_order'],
                'createdby'         => $orden->created_by,



            ];
            $request['id_local']= $local->getLocalIdAttribute();

            $retunred->crearNuevo($request->all());
            $order->setStatusReturned($request->id_order);
            foreach($code as $data){
                $util->sendPush($data['codigo'],$msg);
            }

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

    private  function sendTableInit($code,$idmesa,$createdBy)
    {
        $util = new UtilidadesContronller();

        $msg = [
            'message' 	        => 'La mesa '.$idmesa.' ha sido ocupada',
            'title'		        => 'Mesa ocupada',
            'subtitle'	        => 'Mesa ',
            'tickerText'	    => 'cocina',
            'numero_mesa'       =>  $idmesa,
            'createdby'         => $createdBy,

        ];

        foreach($code as $data){
            $msg['idusuario'] = $data['id'];
            $util->sendPush($data['codigo'],$msg);
        }

    }

    private  function sendTableEnd($code,$idmesa,$createdBy)
    {
        $util = new UtilidadesContronller();

        $msg = [
            'message' 	        => 'La mesa '.$idmesa.' ha sido desocupada',
            'title'		        => 'Mesa desocupada',
            'subtitle'	        => 'Mesa ',
            'tickerText'	    => 'cocina',
            'numero_mesa'       =>  $idmesa,
            'createdby'         => $createdBy,

        ];

        foreach($code as $data){
            $msg['idusuario'] = $data['id'];
            $util->sendPush($data['codigo'],$msg);
        }

    }

}
