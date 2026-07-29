<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = auth()->user();
            if (! $user?->isAdmin() && ! $user?->can('state-list')) {
                abort(403, 'You are not authorized to access this area.');
            }

            return $next($request);
        });
    }

    public function index()
    {
        $states = State::withCount('cities')->orderBy('name')->paginate(40);

        return view('admin.states.index', compact('states'));
    }

    public function create()
    {
        return view('admin.states.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:states,name',
        ]);

        State::create($validated);

        return redirect()->route('admin.states.index')->with('success', 'State created successfully.');
    }

    public function edit(State $state)
    {
        return view('admin.states.edit', compact('state'));
    }

    public function update(Request $request, State $state)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:states,name,' . $state->id,
        ]);

        $state->update($validated);

        return redirect()->route('admin.states.index')->with('success', 'State updated successfully.');
    }

    public function destroy(State $state)
    {
        $state->delete();

        return redirect()->route('admin.states.index')->with('success', 'State deleted successfully.');
    }
}
