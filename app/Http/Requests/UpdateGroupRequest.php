<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGroupRequest extends FormRequest
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
            'group_id'    => ['required', 'uuid', 'exists:groups,uuid,deleted_at,NULL'],
            'name'        => ['required_with:name', 'string', 'max:255']
        ];
    }

    public function attributes()
    {
        return [
            'group_id'    => __('string.group_id'),
            'name'        => __('string.name'),
        ];
    }

    public function prepareForValidation()
    {
        return [
            $this->merge(['group_id' => $this->group_id])
        ];
    }

    public function payload()
    {
        return [
            'group_id'    => $this->group_id,
            'name'        => $this->name
        ];
    }
}
