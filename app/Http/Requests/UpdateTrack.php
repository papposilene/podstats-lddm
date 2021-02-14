<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTrack extends FormRequest
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
            'track_uuid' => 'required|uuid',
            'artist_uuid' => 'required_unless:artist_uname|uuid',
            'artist_uname' => 'required_unless:artist_uuid|string|max:255',
            'track_type' => 'required|string|max:255',
            'track_title' => 'required|string|max:255',
            'track_date' => 'nullable|date_format:"Y-m-d"',
            'track_duratino' => 'nullable|date_format:"H:i:s"',
            'track_mbid' => 'nullable|uuid'
        ];
    }
}
