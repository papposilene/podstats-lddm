<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrack extends FormRequest
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
            'contact_uuid' => 'nullable|uuid',
            'contact_uname' => 'string|max:255',
            'profession_uuid' => 'required|uuid',
            'studio_uuid' => 'nullable|uuid',
            'studio_name' => 'string|max:255',
            'game_uuid' => 'nullable|uuid',
            'game_title' => 'string|max:255',
            'track_id' => 'required|int',
            'track_type' => 'required|string|max:255',
            'track_title' => 'required|string|max:255',
            'track_date' => 'nullable|date_format:"Y-m-d"',
            'track_duratino' => 'nullable|date_format:"H:i:s"',
            'track_mbid' => 'nullable|uuid',
            'track_source' => 'nullable|url'
        ];
    }
}
