<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class ProductRequest extends FormRequest
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
    public function rules()
    {
        return [
            'product_name' => 'required|max:60',
            'selling_price' => 'required',
            'brand' => 'required',
            'details' => 'max:255',
            'image' => 'image',
            'main_category' => 'required',
            'sub_category' => 'required'
        ];
    }
}
