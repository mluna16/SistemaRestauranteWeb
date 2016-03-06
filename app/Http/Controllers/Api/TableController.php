<?php namespace SistemaRestauranteWeb\Http\Controllers\Api;

use Exception;
use Illuminate\Support\Facades\Response;
use SistemaRestauranteWeb\Http\Controllers\UtilidadesContronller;
use SistemaRestauranteWeb\Http\Requests;
use SistemaRestauranteWeb\Http\Controllers\Controller;

use Illuminate\Http\Request;
use SistemaRestauranteWeb\Local;
use SistemaRestauranteWeb\Order;
use SistemaRestauranteWeb\Product;
use SistemaRestauranteWeb\Table;
use SistemaRestauranteWeb\User;

class TableController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $local = new Local();
        $table = new Table();
        $mesas = $table->getAllTablesForLocal($local->getLocalIdAttribute());

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
    $table = new Table();
        if($table->getInfoTableForNumberTable($id) != false)
        {
            return Response::json(['success' =>true, 'data' => $table->getInfoTableForNumberTable($id)], 200);

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

    public function getInvoice($id){
        $table      = New Table();
        $util       = New UtilidadesContronller();
        $user       = New User();
        $local      = New Local();

        try{
            $statusCode = 200;

            $code                   = $user->getUserCodes($local->getLocalIdAttribute());

            $msg = [
                'message' 	        => 'La mesa '.$id.' ha solicitado factura',
                'title'		        => 'Facturando mesa',
                'subtitle'	        => '',
                'tickerText'	    => 'mesonero',
                'numero_mesa'       => $id,
                'vibrate'	=> 1,
            ];
            $table->changeInvoiceTableStatus($id);
              foreach($code as $data){
                    $msg['idusuario'] = $data['id'];
                    $util->sendPush($data['codigo'],$msg);
                }
                $response =['success' => true];

        }catch (Exception $e){
            $response = [
                "error" => $e->getMessage(),
            ];
            $statusCode = 400;
        }finally{
            return Response::json($response,$statusCode);
        }



    }

    public function showAll(){
        $local = new Local();
        $table = new Table();
        $mesas = $table->getAllTablesForLocal($local->getLocalIdAttribute());

        foreach($mesas['Mesas'] as $i => $mesa){
    
            if($mesa['State'] != 'disponible'){
                $mesas['Mesas'][$i]['dataMesa'] = $table->getInfoTableForNumberTable($mesa['NumberTable']);
            }
        }
        return Response::json(['success' =>true, 'data' => $mesas], 200);
    }

}
