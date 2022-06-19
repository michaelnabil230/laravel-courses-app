<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read-admins'])->only(['index', 'show']);
        $this->middleware(['permission:create-admins'])->only(['create', 'store']);
        $this->middleware(['permission:update-admins'])->only(['edit', 'update']);
        $this->middleware(['permission:delete-admins'])->only('destroy');
    }

    public function index(Request $request)
    {
        $admins = Admin::query()
            ->role('admin')
            ->when($request->search, function ($query, $search) {
                return $query
                    ->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            })
            ->latest()
            ->paginate()
            ->appends($request->query());

        return view('dashboard.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('dashboard.admins.create');
    }

    public function store(AdminRequest $request)
    {
        $validated = $request->safe()->except(['password', 'password_confirmation', 'permissions']);
        $admin = Admin::create($validated + [
            'password' => Hash::make($request->password)
        ]);
        $admin->syncRoles('admin');
        $admin->syncPermissions($request->permissions);

        $this->success('dashboard.added_successfully');

        return to_route('dashboard.admins.index');
    }

    public function edit(Admin $admin)
    {
        return view('dashboard.admins.edit', compact('admin'));
    }

    public function update(AdminRequest $request, Admin $admin)
    {
        $validated = $request->safe()->except(['password', 'password_confirmation', 'permissions']);

        $admin->update($validated + [
            'password' => Hash::make($request->password)
        ]);
        $admin->syncPermissions($request->permissions);

        $this->success('dashboard.updated_successfully');

        return to_route('dashboard.admins.index');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();

        $this->success('dashboard.deleted_successfully');

        return to_route('dashboard.admins.index');
    }
}
