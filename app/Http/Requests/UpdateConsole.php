<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConsole extends FormRequest
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
            'console_uuid' => 'required|uuid',
            'console_name' => 'required|string|max:255',
            'manufacturer_uuid' => 'required|uuid',
            'console_type' => 'required|string|max:255',
            'console_generation' => 'nullable|int',
            'console_releasedOn' => 'nullable|date_format:"Y"'
        ];
    }
}
