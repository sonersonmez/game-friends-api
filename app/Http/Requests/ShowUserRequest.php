<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowUserRequest extends FormRequest
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
            'user_id' => ['required', 'uuid', 'exists:users,uuid,deleted_at,NULL']
        ];
    }

    public function attributes()
    {
        return [
            'user_id' => __('string.user_id')
        ];
    }

    public function prepareForValidation()
    {
        return $this->merge(['user_id' => $this->user_id]);
    }
}
