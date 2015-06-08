<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ArticleRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		// return false;

		// For just now enable anyone to make any changes
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
        // We can add a rule based on the method requested for create/edit methods

        $rules = array();
        $rules['title'] = 'required|min:3';
        $rules['body'] = 'required';
        $rules['published_at'] = 'required|date';


        return $rules;
	}

}
