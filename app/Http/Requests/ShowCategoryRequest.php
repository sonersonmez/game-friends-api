<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowCategoryRequest extends FormRequest
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
            'category_id' => ['required', 'uuid', 'exists:categories,uuid,deleted_at,NULL']
        ];
    }

    public function attributes()
    {
        return [
            'category_id' => __('string.category_id')
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['category_id' => $this->category_id]);
    }
}
