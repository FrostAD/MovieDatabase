<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreActor extends FormRequest
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
            //TODO I merge the two names in to the controller
            'first_name' => 'required',
            'last_name' => 'required',
            'born_date' => 'required',
            'born_place' => 'required',
            'description' => 'required',
        ];
    }
}
