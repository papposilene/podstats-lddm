<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePodcast extends FormRequest
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
            'podcast_name' => 'required|string|max:255',
            'podcast_beganOn' => 'required|date',
            'podcast_endedOn' => 'nullable|date',
            'podcast_description' => 'nullable|string',
            'podcast_source' => 'nullable|url',
            'podcast_cover' => 'nullable|file|mimes:jpeg,jpg',
        ];
    }
}
