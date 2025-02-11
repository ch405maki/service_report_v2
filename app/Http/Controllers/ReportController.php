<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\ServiceReport;

class ReportController extends Controller
{
    public function index()
    {
        $reports = ServiceReport::all()->unique('reported_by');

        // Return the Inertia page with the report data
        return Inertia::render('Reports/Index', [
            'reports' => $reports,
        ]);
    }
}
