<?php namespace SistemaRestauranteWeb\Http\Requests;

use SistemaRestauranteWeb\Http\Requests\Request;

class CreatePasswordRequest extends Request {

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
            'password' => 'required|same:password_',
            'password_' => 'required',
		];
	}

}
