<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\ServiceReport;

class ReportController extends Controller
{
    public function index()
    {
        $reports = ServiceReport::orderByDesc('created_at')
        ->get()
        ->unique('reported_by');

        // Return the Inertia page with the report data
        return Inertia::render('Reports/Index', [
            'reports' => $reports,
        ]);
    }

    public function show($reported_by){

        //dd($reported_by);

        $reports = ServiceReport::WHERE('reported_by', $reported_by)->get();

        // Return the Inertia page with the report data
        return Inertia::render('Reports/Show', [
            'reports' => $reports,
        ]);
    }
}
