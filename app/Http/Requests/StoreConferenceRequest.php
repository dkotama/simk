<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreConferenceRequest extends Request
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
            'name' => 'required',
            'url' => 'required',
            'start_submit' => 'required',
            'end_submit' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'required'
            //
        ];
    }
}
