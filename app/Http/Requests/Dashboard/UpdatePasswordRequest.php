<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\MatchCurrentPassword;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
        return [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'current_password' => ['required', 'string', 'min:8', MatchCurrentPassword::make(auth('admin')->user()->password)],
        ];
    }
}
