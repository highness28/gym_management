<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Auth;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::user()->user_type == 4 || Auth::user()->user_type == 3) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'birthdate' => 'required|date',
            'contact_number' => 'required|regex:/(09)[0-9]{9}/',
            'email' => 'required|unique:users,email,'.$request->id.',id',
            'password' => 'required|min:5',
            'image' => 'image',
            'confirm_password' => 'required|same:password|min:5',
            'user_type' => 'required'
        ];
    }
}
