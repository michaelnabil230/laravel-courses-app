<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\LocationRequest;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read-locations'])->only(['index', 'show']);
        $this->middleware(['permission:create-locations'])->only(['create', 'store']);
        $this->middleware(['permission:update-locations'])->only(['edit', 'update']);
        $this->middleware(['permission:delete-locations'])->only('destroy');
    }

    public function index(Request $request)
    {
        $locations = Location::query()
            ->when($request->search, function ($query, $search) {
                return $query->where(DB::raw("name->'$.column' LIKE %$search%"));
            })
            ->latest()
            ->paginate()
            ->appends($request->query());

        return view('dashboard.locations.index', compact('locations'));
    }

    public function create()
    {
        return view('dashboard.locations.create');
    }

    public function store(LocationRequest $request)
    {
        Location::create($request->validated());

        $this->success('dashboard.added_successfully');

        return back();
    }

    public function edit(Location $location)
    {
        return view('dashboard.locations.edit', compact('location'));
    }

    public function update(LocationRequest $request, Location $location)
    {
        $location->update($request->validated());

        $this->success('dashboard.updated_successfully');

        return to_route('dashboard.locations.index');
    }

    public function destroy(Location $location)
    {
        $location->delete();

        $this->success('dashboard.deleted_successfully');

        return to_route('dashboard.locations.index');
    }
}
