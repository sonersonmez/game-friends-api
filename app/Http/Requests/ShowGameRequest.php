<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowGameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'game_id' => ['required', 'uuid', 'exists:games,uuid,deleted_at,NULL']
        ];
    }

    public function attributes()
    {
        return [
            'game_id' => __('string.game_id')
        ];
    }

    public function prepareForValidation()
    {
        $this->merge(['game_id' => $this->game_id]);
    }
}
