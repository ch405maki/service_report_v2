<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceReport;
use Inertia\Inertia;

class ServiceReportController extends Controller
{
    public function show($id)
    {
        // Fetch the service report by ID
        $report = ServiceReport::findOrFail($id);

        // Return the Inertia page with the report data
        return Inertia::render('ServiceReports/View', [
            'report' => $report,
        ]);
    }
}
