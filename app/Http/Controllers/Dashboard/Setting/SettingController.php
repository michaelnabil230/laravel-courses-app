<?php

namespace App\Http\Controllers\Dashboard\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'logo' => ['sometimes', 'nullable', 'image'],
            'email' => ['required', 'email'],
            'phone' => [
                'required',
                'numeric',
                'regex:/^(01)[0-2,5]{1}[0-9]{8}$/',
            ],
        ]);

        if ($request->logo) {
            Storage::delete(setting()->get('logo'));
            $validated['logo'] = $request->logo->store('logo');
        }

        setting($validated)->save();

        $this->success('dashboard.added_successfully');

        return to_route('dashboard.setting.index');
    }
}
