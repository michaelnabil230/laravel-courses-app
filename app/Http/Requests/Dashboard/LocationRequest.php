<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
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
        $rules = [];
        foreach (config('translatable.locales') as $locale) {
            $rules += [
                $locale . '.name' => ['required'],
            ];
        } //end of for each

        return $rules;
    }

    /**
     * Get the validation rules in the update method that applies to the request.
     *
     * @return array<string, mixed>
     */
    private function update(): array
    {
        $rules = [];
        foreach (config('translatable.locales') as $locale) {
            $rules += [
                $locale . '.name' => ['required'],
            ];
        } //end of for each

        return $rules;
    }
}
