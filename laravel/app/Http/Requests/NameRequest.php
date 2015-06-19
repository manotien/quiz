<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Validation\Validator;
class NameRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return false;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
	
		return [
			'name'=>'required'
		];
	}
	protected function formatErrors(Validator $validator)
	{
		dd("as");
	    return $validator->errors()->all();
	}
}
