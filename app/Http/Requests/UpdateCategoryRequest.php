<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'category_id' => ['required', 'uuid', 'exists:categories,uuid,deleted_at,NULL'],
            'name'        => ['required_with:name', 'string', 'max:255']
        ];
    }

    public function attributes()
    {
        return [
            'category_id' => __('string.category_id'),
            'name'        => __('string.name'),
        ];
    }

    public function prepareForValidation()
    {
        return [
            $this->merge(['category_id' => $this->category_id])
        ];
    }

    public function payload()
    {
        return [
            'category_id' => $this->category_id,
            'name'        => $this->name
        ];
    }
}
