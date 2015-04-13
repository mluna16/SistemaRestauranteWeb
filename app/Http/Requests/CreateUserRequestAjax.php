<?php namespace SistemaRestauranteWeb\Http\Requests;

use SistemaRestauranteWeb\Http\Requests\Request;

class CreateUserRequestAjax extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|same:password_',
            'password_' => 'required',
            'type' => 'required|in:admin,caja,cocina,mesonero',
        ];
    }

}
