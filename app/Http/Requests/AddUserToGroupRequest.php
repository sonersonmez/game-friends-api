<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserToGroupRequest extends FormRequest
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
            'user_id'  => ['required', 'uuid', 'exists:users,uuid,deleted_at,NULL'],
            'group_id' => ['required', 'uuid', 'exists:groups,uuid,deleted_at,NULL']
        ];
    }

    public function attributes()
    {
        return [
            'user_id'  => __('string.user_id'),
            'group_id' => __('string.group_id')
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'user_id'  => $this->user_id,
            'group_id' => $this->group_id
        ]);
    }
}
