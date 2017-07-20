<?php
/**
 * Created by PhpStorm.
 * User: saulo
 * Date: 19/06/17
 * Time: 16:52
 */

namespace App\Http\Requests;


use App\Entities\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserUpdateRequest extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return Auth::user()->level == User::ADMIN;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			//
		];
	}
}