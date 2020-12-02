<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovie extends FormRequest
{
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
            'title' => 'required',
            'timespan_hours' => 'required',
            'timespan_minutes' => 'required',
            'description' => 'required',
            'published_at' => 'required',
            'genres' => 'required',
            'poster' => 'required',
            'producer' => 'required',
            'music' => 'required',
            'studio' => 'required',
            'country' => 'required',
            'studio' => 'required',
        ];
    }
}
