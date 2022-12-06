<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MasterDocumentRequest extends FormRequest
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
            'document_type' => 'required',
            'document_description' => 'string'
        ];
    }

    public function validated(){
        if( request()->method() == 'PUT' ){
            return array_merge(parent::validated(), [
                'updated_by' => Auth()->user()->UserId
            ]);
        }else if( request()->method() == 'POST' ){
            return array_merge(parent::validated(), [
                'created_by' => Auth()->user()->UserId
            ]);
        }
        
    }
}
