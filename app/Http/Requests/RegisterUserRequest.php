<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class RegisterUserRequest extends FormRequest
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
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'email:rfc,dns'],
            'password'              => ['required', 'string', 'min:8'],
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

    public function payload()
    {
        return [
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => Hash::make($this->password)
        ];
    }
}
