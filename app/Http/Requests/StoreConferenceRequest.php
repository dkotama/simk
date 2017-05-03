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
            'url' => 'required|alpha_num',
            'submission_deadline' => 'required',
            'acceptance' => 'required',
            'camera_ready' => 'required',
            'registration' => 'required',
            'start_conference' => 'required',
            'end_conference' => 'required'
        ];
    }
}
