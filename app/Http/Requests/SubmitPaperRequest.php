<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SubmitPaperRequest extends Request
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
            'abstract' => 'required',
            'keywords' => 'required',
            'description' => 'required',
            'paper' => 'required|mimes:pdf'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required',
            'description.required' => 'Description is required',
            'abstract.required' => 'Please fill abstract',
            'keywords.required' => 'Please fill keywords, 1 is minimum',
            'paper.required' => 'Please attach file',
            'paper.mimes' => 'Please only upload .pdf file'
        ];
    } 
}
