<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdateUserRequest extends FormRequest
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
            'user_id'               => ['required', 'uuid', 'exists:users,uuid,deleted_at,NULL'],
            'name'                  => ['required_with:name', 'string', 'max:255'],
            'email'                 => ['required_with:email', 'email:rfc,dns', 'unique:users'],
            'password'              => ['required_with:password', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required_with:password', 'min:8', 'same:password']
        ];
    }

    public function attributes()
    {
        return [
            'name'                  => __('string.name'),
            'email'                 => __('string.email'),
            'password'              => __('string.email'),
            'password_confirmation' => __('string.password_confirmation')
        ];
    }

    public function prepareForValidation()
    {
        return $this->merge(['user_id' => $this->user_id]);
    }

    public function payload()
    {
        return [
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => Hash::make($this->password)
        ];
    }
}
