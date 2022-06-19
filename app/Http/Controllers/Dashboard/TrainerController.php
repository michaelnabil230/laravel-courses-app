<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\TrainerRequest;
use App\Models\Trainer;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read-trainers'])->only(['index', 'show']);
        $this->middleware(['permission:create-trainers'])->only(['create', 'store']);
        $this->middleware(['permission:update-trainers'])->only(['edit', 'update']);
        $this->middleware(['permission:delete-trainers'])->only('destroy');
    }

    public function index(Request $request)
    {
        $trainers = Trainer::query()
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'Like', "%$search%");
            })
            ->latest()
            ->paginate()
            ->appends($request->query());

        return view('dashboard.trainers.index', compact('trainers'));
    }

    public function create()
    {
        return view('dashboard.trainers.create');
    }

    public function store(TrainerRequest $request)
    {
        Trainer::create($request->validated());

        $this->success('dashboard.added_successfully');

        return back();
    }

    public function edit(Trainer $trainer)
    {
        return view('dashboard.trainers.edit', compact('trainer'));
    }

    public function update(TrainerRequest $request, Trainer $trainer)
    {
        $trainer->update($request->validated());

        $this->success('dashboard.updated_successfully');

        return to_route('dashboard.trainers.index');
    }

    public function destroy(Trainer $trainer)
    {
        $trainer->delete();

        $this->success('dashboard.deleted_successfully');

        return to_route('dashboard.trainers.index');
    }
}
