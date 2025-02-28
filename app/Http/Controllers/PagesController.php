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
        // Fetch the service by its ID with related 'category' and 'expert' details
        $service = Service::with(['category', 'expert'])->findOrFail($id);

        // Return the service data to the view
        return view('serviceview', compact('service'));
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


    public function branchview($id)
    {
        // Fetch branch details (ensure the branch exists or show 404 if not found)
        $branch = Branch::findOrFail($id);

        // Fetch services associated with this branch, eager load the 'category' and 'expert' relationships
        $services = $branch->services()->with(['category', 'expert'])->get();

        // Return the branch details along with associated services to the view
        return view('branchview', compact('branch', 'services'));
    }









}
