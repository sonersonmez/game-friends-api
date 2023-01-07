<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGameRequest extends FormRequest
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
            'game_id'     => ['required', 'uuid', 'exists:games,uuid,deleted_at,NULL'],
            'name'        => ['required_with:name', 'string', 'max:255', 'unique:games'],
            'category.id' => ['required_with:category.id', 'uuid', 'exists:categories,uuid,deleted_at,NULL']
        ];
    }

    public function attributes()
    {
        return [
            'name'        => __('string.name'),
            'category.id' => __('string.category_id')
        ];
    }

    public function prepareForValidation()
    {
        $this->merge(['game_id' => $this->game_id]);
    }

    public function categoryId()
    {
        return $this->filled('ccategory_id')
            ? Category::getId($this->input('category.id'))
            : null;
    }

    public function payload()
    {
        $payload = [];

        if ($this->filled('category.id')) {
            $payload['category_id'] = Category::getId($this->input('category.id'));
        }

        return [
            ...$payload,
            ...collect($this->validated())->except([
                'category',
            ]),
        ];
    }
}
