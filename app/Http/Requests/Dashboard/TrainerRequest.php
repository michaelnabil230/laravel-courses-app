<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class TrainerRequest extends FormRequest
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
                'max:255'
            ],
            'phone' => [
                'required',
                'numeric',
                'regex:/^(01)[0-2,5]{1}[0-9]{8}$/',
                'unique:trainers,phone'
            ],
            'note' => [
                'sometimes',
                'nullable'
            ]
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
                'max:255'
            ],
            'phone' => [
                'required',
                'numeric',
                'regex:/^(01)[0-2,5]{1}[0-9]{8}$/',
                'unique:trainers,phone.' . $this->trainer->id
            ],
            'note' => [
                'sometimes',
                'nullable'
            ]
        ];
    }
}
