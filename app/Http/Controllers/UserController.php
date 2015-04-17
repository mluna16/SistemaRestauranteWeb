<?php namespace SistemaRestauranteWeb\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as Requests_Facades;
use Illuminate\Support\Facades\View;
use SistemaRestauranteWeb\Http\Requests;
use SistemaRestauranteWeb\Http\Controllers\Controller;

use Illuminate\Http\Request;
use SistemaRestauranteWeb\Http\Requests\CreatePasswordRequest;
use SistemaRestauranteWeb\Http\Requests\CreateUserRequest;
use SistemaRestauranteWeb\Http\Requests\CreateUserRequestAjax;
use SistemaRestauranteWeb\User;

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('auth/login');
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
     * @param CreateUserRequest|CreateUserRequestAjax $request
     * @param CreateUserRequest $requestNoAjax
     * @return Response
     * @internal param CreateUserRequestAjax $requestAjax
     */
	public function store( CreateUserRequest $request)
	{
        $user = User::create($request->all());
        $user->setPasswordAttribuite($user->password);
        if( $user->save()) return redirect(route('users.index'));
    }

    public function storeAjax(CreateUserRequestAjax $request){
        $user = User::create($request->all());
        $user->setPasswordAttribuite($user->password);
        if( $user->save()) return (array('last_id' => $user->id));
    }

    public function changePassword(CreatePasswordRequest $request, User $user){
        $user->fill($request->all());
        $user->UpdatePassword($user->password);
        if( $user->update()){
            $user->UpdateFirstTimeUser();
            return (array('last_id' => $user->id));
        }
    }
    public function softDelete($id){
        $user = User::findOrFail($id);
        $user->setStatus($id);
        return (array('valido' => 'ok'));
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
		//
	}

}
