<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSerieGameAdd extends FormRequest
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
            'serie_uuid' => 'required|uuid',
            'game_order' => 'required|int',
            'game_title' => 'required|string|max:255',
            'game_uuid' => 'nullable'
        ];
    }
}
