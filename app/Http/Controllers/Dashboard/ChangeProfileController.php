<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UpdatePasswordRequest;
use App\Http\Requests\Dashboard\UpdateProfileRequest;

class ChangeProfileController extends Controller
{
    public function updatePassword(UpdatePasswordRequest $request)
    {
        auth()->user()->update($request->validated());

        $this->success('dashboard.updated_successfully');

        return to_route('dashboard.profile.edit');
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        auth()->user()->update($request->validated());

        $this->success('dashboard.updated_successfully');

        return to_route('dashboard.profile.edit');
    }

    public function destroy()
    {
        $user = auth()->user();
        $user->delete();

        $this->success('dashboard.deleted_successfully');

        return to_route('admin.login');
    }
}
