<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Specialty;

class AdminSpecialtyController extends Controller
{
    // Display all specialties
    public function index()
    {
        $specialties = Specialty::withCount('doctors')
            ->latest()
            ->get();

        return view('admin.specialties.index', compact('specialties'));
    }

    // Show create specialty form
    public function create()
    {
        return view('admin.specialties.create');
    }

    // Store new specialty
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:specialties,name',
            'description' => 'nullable|string|max:1000',
        ]);

        Specialty::create($validated);

        return redirect()
            ->route('admin.specialties.index')
            ->with('success', 'Specialty added successfully!');
    }

    // Show edit specialty form
    public function edit($id)
    {
        $specialty = Specialty::findOrFail($id);

        return view('admin.specialties.edit', compact('specialty'));
    }

    // Update specialty
    public function update(Request $request, $id)
    {
        $specialty = Specialty::findOrFail($id);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('specialties', 'name')->ignore($specialty->id),
            ],
            'description' => 'nullable|string|max:1000',
        ]);

        $specialty->update($validated);

        return redirect()
            ->route('admin.specialties.index')
            ->with('success', 'Specialty updated successfully!');
    }

    // Delete specialty
    public function destroy($id)
    {
        $specialty = Specialty::findOrFail($id);

        if ($specialty->doctors()->exists()) {
            return redirect()
                ->route('admin.specialties.index')
                ->with('error', 'Cannot delete this specialty because it has doctors assigned to it.');
        }

        $specialty->delete();

        return redirect()
            ->route('admin.specialties.index')
            ->with('success', 'Specialty deleted successfully!');
    }
}
