<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\State;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (! auth()->user()?->isAdmin()) {
                abort(403, 'You are not authorized to access this area.');
            }

            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $query = Lead::with('state')->latest('id');

        if ($search = trim((string) $request->get('q'))) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('mobile', 'like', "%{$search}%");
            });
        }

        $leads = $query->paginate(25)->withQueryString();

        return view('admin.leads.index', compact('leads'));
    }

    public function create()
    {
        $states = State::orderBy('name')->get();

        return view('admin.leads.create', compact('states'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateLead($request);
        Lead::create($validated);

        return redirect()->route('admin.leads.index')->with('success', 'Lead created successfully.');
    }

    public function show(Lead $lead)
    {
        $lead->load('state');

        return view('admin.leads.show', compact('lead'));
    }

    public function edit(Lead $lead)
    {
        $states = State::orderBy('name')->get();

        return view('admin.leads.edit', compact('lead', 'states'));
    }

    public function update(Request $request, Lead $lead)
    {
        $validated = $this->validateLead($request);
        $lead->update($validated);

        return redirect()->route('admin.leads.index')->with('success', 'Lead updated successfully.');
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();

        return redirect()->route('admin.leads.index')->with('success', 'Lead deleted successfully.');
    }

    private function validateLead(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|digits:10',
            'email' => 'required|email|max:255',
            'state_id' => 'nullable|integer|exists:states,id',
        ]);
    }
}
