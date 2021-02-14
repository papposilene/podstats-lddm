<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSource extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (auth()->user()->can('update')) {
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
            'source_uuid' => 'required|uuid',
            'item_uuid' => 'required|uuid',
            'item_model' => 'required|string|max:255',
            'source_type' => 'required|string|max:255',
            'source_data' => 'required|string|max:255',
        ];
    }
}
