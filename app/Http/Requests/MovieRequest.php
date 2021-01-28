<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'name' => 'required|min:5|max:255'
            'title' => 'required',
            'published' => 'required',
            'rating' => 'required',
            'rating_imbd' => 'required',
            'timespan' => 'required',
            'description' => 'required',
//            'poster' => 'required',
            'country_produced' => 'required',
            'trailer' => 'required',
            'genres' => 'required',
            'actors' => 'required',
            'producers' => 'required',
            'musicians' => 'required',
            'studios' => 'required',
            'screenwritters' => 'required',

        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
