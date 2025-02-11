<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\JobPost;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = JobPost::with('skills:name,id');

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->keyword . '%')
                  ->orWhere('extra_info', 'like', '%' . $request->keyword . '%')
                  ->orWhereHas('skills', function ($q) use ($request) {
                      $q->where('name', 'like', '%' . $request->keyword . '%');
                  });
            });
        }


        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        $jobs = $query->latest()->get();

        return Inertia::render('Dashboard', [
            'jobs' => $jobs
        ]);
    }
}
