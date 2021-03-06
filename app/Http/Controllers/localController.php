<?php namespace SistemaRestauranteWeb\Http\Controllers;

use Illuminate\Support\Facades\Response;
use SistemaRestauranteWeb\Http\Requests;
use SistemaRestauranteWeb\Http\Controllers\Controller;

use Illuminate\Http\Request;
use SistemaRestauranteWeb\Http\Requests\CreateLocalRequest;
use SistemaRestauranteWeb\Http\Requests\EditLocalRequest;
use SistemaRestauranteWeb\Local;

class localController extends Controller {

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
		//
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateProductsRequest $request
     * @return Response
     */
    public function store(CreateLocalRequest $request)
    {
        $Local = Local::create($request->all());
        $Local->setOwnerAttribute($Local->owner);
        if($Local->save()){

            if($request->ajax()) return array('last_id' => $Local->id );

        };
        return $Local;

    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $local = Local::findOrFail($id);
        return Response::json($local);
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
	public function update($id, EditLocalRequest $request)
	{
        $local = Local::findOrFail($id);
        $local->fill($request->all());
        if( $local->update()){
            return (array('last_id' => $local->id));
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
		//
	}

}
