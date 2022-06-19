<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
    public function rules(): array
    {
        return request()->isMethod('post') ? $this->store() : $this->update();
    }

    /**
     * Get the validation rules in the store method that applies to the request.
     *
     * @return array<string, mixed>
     */
    private function store(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'unique:admins,email',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
            'permissions' => [
                'required',
                'array',
                'min:1',
            ],
        ];
    }

    /**
     * Get the validation rules in the update method that applies to the request.
     *
     * @return array<string, mixed>
     */
    private function update(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'unique:admins,email.' . $this->admin->id,
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
            'confirm_password' => [
                'required_with:password',
                'same:password',
            ],
            'permissions' => [
                'required',
                'array',
                'min:1',
            ],
        ];
    }
}
