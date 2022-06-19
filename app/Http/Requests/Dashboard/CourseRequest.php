<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
        $rules = [
            'trainer_id' => [
                'required',
                'exists:trainers,id'
            ],
            'location_id' => [
                'required',
                'exists:locations,id'
            ],
            'start_at' => [
                'required',
                'date',
            ],
            'end_at' => [
                'required',
                'date',
            ],
            'price' => [
                'required',
            ],
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules += [
                $locale . '.name' => ['required'],
                $locale . '.title' => ['required'],
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
        $rules = [
            'trainer_id' => [
                'required',
                'exists:trainers,id'
            ],
            'location_id' => [
                'required',
                'exists:locations,id'
            ],
            'start_at' => [
                'required',
                'date',
            ],
            'end_at' => [
                'required',
                'date',
            ],
            'price' => [
                'required',
            ],
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules += [
                $locale . '.name' => ['required'],
                $locale . '.title' => ['required'],
            ];
        } //end of for each
        return $rules;
    }
}
