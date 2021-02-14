<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContact extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (auth()->user()->can('create')) {
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
            'contact_gender' => 'nullable|string',
            'contact_uname' => 'required|string|unique:contacts,uname|max:255',
            'contact_fname' => 'nullable|string|max:255',
            'contact_mname' => 'nullable|string|max:255',
            'contact_lname' => 'nullable|string|max:255',
            'contact_livesAt' => 'nullable|uuid',
            'contact_bornOn' => 'nullable|date',
            'contact_bornAt' => 'nullable|uuid',
            'contact_diedOn' => 'nullable|date',
            'contact_diedAt' => 'nullable|uuid',
            'contact_biography' => 'nullable|string',
        ];
    }
}
