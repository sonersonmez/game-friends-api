<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGroupRequest extends FormRequest
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
            'name'    => ['required', 'string', 'max:50', 'unique:groups'],
            'game.id' => ['required', 'uuid', 'exists:games,uuid,deleted_at,NULL']
        ];
    }

    public function attributes()
    {
        return [
            'name'    => __('string.name'),
            'game.id' => __('string.game_id')
        ];
    }
}
