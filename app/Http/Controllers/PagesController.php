<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Expert;
use App\Models\Service;
use App\Models\Work;
use App\Models\Branch;


class PagesController extends Controller
{


    public function welcome()
    {
        $experts = Expert::all();
        $services = Service::all();
        $works = Work::all();
        $branches = Branch::all();

        return view('welcome', compact('experts','branches', 'works','services'));
    }

    public function serviceview($id)
    {
        $services = Service::with(['category', 'expert'])->get();
        $relatedServices = Service::with(['category', 'expert'])
         ->where('id', '!=', $id)
         ->inRandomOrder()->limit(3)->get();
        return view('serviceview', compact('services','relatedServices'));
    }





    public function expertview($id)
    {
        // Fetch the expert's details by ID
        $expert = Expert::findOrFail($id);

        // Get related experts (excluding the current one)
        $relatedExperts = Expert::where('specialization', $expert->specialization)
        ->where('id', '!=', $id)  // Exclude the current expert
        ->take(3)  // Get top 3 related experts
        ->get();

        // Return the view with expert and related experts data
        return view('expertview', compact('expert', 'relatedExperts'));
    }

    public function workview($id)
    {
        // Fetch the work's details by ID
        $work = Work::findOrFail($id);

        // Get related works (e.g., based on the same expert or similar criteria)
        $relatedWorks = Work::where('id', '!=', $work->id)  // Exclude the current work
                            ->inRandomOrder()  // Get random related works
                            ->limit(4)  // Limit the number of related works
                            ->get();

        return view('workview', compact('work', 'relatedWorks'));
    }

    // branchview

    public function branchview($id)
{
    $branch = Branch::findOrFail($id);

    // Fetch related branches excluding the current one
    $relatedBranches = Branch::where('id', '!=', $id)
                            ->orderBy('created_at', 'desc') // Optional: Order by latest
                            ->limit(6) // Optional: Limit to 6 related branches
                            ->get();

    return view('branchview', compact('branch', 'relatedBranches'));
}



}
