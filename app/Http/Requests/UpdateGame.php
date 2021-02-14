<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGame extends FormRequest
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
            'game_uuid' => 'required|uuid',
            'game_title' => 'required|string|max:255',
            'game_releasedOn' => 'required|date_format:"Y-m-d"',
            'studio_uuid' => 'required|uuid',
            'consoles' => 'required|array',
            'modes' => 'required|array',
            'genres' => 'required|array',
        ];
    }
}
