<?php
namespace App\Http\Controllers;

use App\Models\Work;
use App\Models\Expert;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    /**
     * Display a listing of the works.
     */
    public function index()
    {
        $works = Work::with('expert')->get();
        return view('works.index', compact('works'));
    }

    /**
     * Show the form for creating a new work.
     */
    public function create()
    {
        $experts = Expert::all();
        return view('works.create', compact('experts'));
    }

    /**
     * Store a newly created work.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo1' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
            'expert_id' => 'required|exists:experts,id',
            'completed_at' => 'nullable|date',
        ]);

        // Handle image uploads
        $photo1 = $request->file('photo1')->store('works', 'public');
        $photo2 = $request->file('photo2') ? $request->file('photo2')->store('works', 'public') : null;
        $photo3 = $request->file('photo3') ? $request->file('photo3')->store('works', 'public') : null;

        Work::create([
            'name' => $request->name,
            'photo1' => $photo1,
            'photo2' => $photo2,
            'photo3' => $photo3,
            'description' => $request->description,
            'expert_id' => $request->expert_id,
            'completed_at' => $request->completed_at,
        ]);

        return redirect()->route('works.index')->with('success', 'Work added successfully!');
    }

    /**
     * Display the specified work.
     */
    public function show(Work $work)
    {
        return view('works.show', compact('work'));
    }

    /**
     * Show the form for editing the work.
     */
    public function edit(Work $work)
    {
        $experts = Expert::all();
        return view('works.edit', compact('work', 'experts'));
    }

    /**
     * Update the work.
     */
    public function update(Request $request, Work $work)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
            'expert_id' => 'required|exists:experts,id',
            'completed_at' => 'nullable|date',
        ]);

        // Handle image updates
        if ($request->hasFile('photo1')) {
            $work->photo1 = $request->file('photo1')->store('works', 'public');
        }
        if ($request->hasFile('photo2')) {
            $work->photo2 = $request->file('photo2')->store('works', 'public');
        }
        if ($request->hasFile('photo3')) {
            $work->photo3 = $request->file('photo3')->store('works', 'public');
        }

        $work->update($request->except(['photo1', 'photo2', 'photo3']));

        return redirect()->route('works.index')->with('success', 'Work updated successfully!');
    }

    /**
     * Remove the work.
     */
    public function destroy(Work $work)
    {
        $work->delete();
        return redirect()->route('works.index')->with('success', 'Work deleted successfully!');
    }
}
