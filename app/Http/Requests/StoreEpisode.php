<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEpisode extends FormRequest
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
            'podcast_uuid' => 'required|uuid',
            'season_id' => 'required|int',
            'episode_id' => 'required|int',
            'episode_title' => 'required|string|max:255',
            'episode_airedOn' => 'required|date_format:"Y-m-d"',
            'episode_duration' => 'nullable|date_format:"H:i:s"',
            'episode_description' => 'nullable|string',
            'episode_source' => 'nullable|url',
        ];
    }
}
