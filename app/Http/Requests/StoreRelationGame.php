<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRelationGame extends FormRequest
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
            'game_uuid' => 'required|uuid',
            'contact_uname' => 'string|max:255',
            'contact_uuid' => 'nullable|uuid',
            'profession_uuid' => 'required|uuid'
        ];
    }
}
