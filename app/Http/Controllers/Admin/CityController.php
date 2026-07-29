<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use App\Helpers\LogActivity;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = auth()->user();
            if (! $user?->isAdmin() && ! $user?->can('city-list')) {
                abort(403, 'You are not authorized to access this area.');
            }

            return $next($request);
        });
    }

    public function index()
    {
        $cities = City::with('state')->orderBy('name')->paginate(40);

        return view('admin.cities.index', compact('cities'));
    }

    public function create()
    {
        $states = State::orderBy('name')->get();

        return view('admin.cities.create', compact('states'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'state_id' => 'required|exists:states,id',
        ]);

        City::create($validated);
        LogActivity::addToLog('City added successfully.');

        return redirect()->route('admin.cities.index')->with('success', 'City created successfully.');
    }

    public function edit(City $city)
    {
        $states = State::orderBy('name')->get();

        return view('admin.cities.edit', compact('city', 'states'));
    }

    public function update(Request $request, City $city)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'state_id' => 'required|exists:states,id',
        ]);

        $city->update($validated);
        LogActivity::addToLog('City updated successfully.');

        return redirect()->route('admin.cities.index')->with('success', 'City updated successfully.');
    }

    public function destroy(City $city)
    {
        $city->delete();
        LogActivity::addToLog('City deleted successfully.');

        return redirect()->route('admin.cities.index')->with('success', 'City deleted successfully.');
    }
}
