<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class StoreGameRequest extends FormRequest
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
            'name'        => ['required', 'string', 'max:255', 'unique:games'],
            'category.id' => ['required', 'uuid', 'exists:categories,uuid,deleted_at,NULL']
        ];
    }

    public function attributes()
    {
        return [
            'name'        => __('string.name'),
            'category.id' => __('string.category_id')
        ];
    }

    public function payload()
    {
        return [
            'name'        => $this->name,
            'category_id' => $this->getCategoryId()
        ];
    }
}
