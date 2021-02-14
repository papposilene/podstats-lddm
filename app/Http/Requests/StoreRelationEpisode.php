<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRelationEpisode extends FormRequest
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
            'podcast_uuid' => 'required|uuid',
            'episode_uuid' => 'required|uuid',
            'staff_uname' => 'string|max:255',
            'staff_uuid' => 'nullable|uuid',
            'profession_uuid' => 'required|uuid'
        ];
    }
}
