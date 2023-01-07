<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteGroupRequest extends FormRequest
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
            'group_id' => ['required', 'uuid', 'exists:groups,uuid,deleted_at,NULL']
        ];
    }

    public function attributes()
    {
        return [
            'group_id' => __('string.group_id')
        ];
    }

    public function prepareForValidation()
    {
        $this->merge(['group_id' => $this->group_id]);
    }
}
