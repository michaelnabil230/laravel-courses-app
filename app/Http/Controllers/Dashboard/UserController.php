<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read-users'])->only(['index', 'show']);
        $this->middleware(['permission:create-users'])->only(['create', 'store']);
        $this->middleware(['permission:update-users'])->only(['edit', 'update']);
        $this->middleware(['permission:delete-users'])->only('destroy');
    }

    public function index(Request $request)
    {
        $users = User::query()
            ->when($request->search, function ($query, $search) {
                return $query
                    ->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            })
            ->latest()
            ->paginate()
            ->appends($request->query());

        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {
        return view('dashboard.users.create');
    }

    public function store(UserRequest $request)
    {
        $validated = $request->safe()->except(['password', 'password_confirmation']);

        User::create($validated + [
            'password' => Hash::make($request->password),
        ]);

        $this->success('dashboard.added_successfully');

        return to_route('dashboard.users.index');
    }

    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('admin'));
    }

    public function update(UserRequest $request, User $user)
    {
        $validated = $request->safe()->except(['password', 'password_confirmation']);

        $user->update($validated + [
            'password' => Hash::make($request->password),
        ]);

        $this->success('dashboard.updated_successfully');

        return to_route('dashboard.users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();

        $this->success('dashboard.deleted_successfully');

        return to_route('dashboard.users.index');
    }
}
