<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceReport;
use App\Models\Staff;
use Inertia\Inertia;

class ServiceReportController extends Controller
{
    public function index()
    {
        $staffs = Staff::withCount('serviceReports')->get();

        // Return the Inertia page with the report data 
        return Inertia::render('ServiceReports/Index', [
            'staffs' => $staffs,
        ]);
    }

    public function show($id)
    {
        // Fetch the service report by ID
        $report = ServiceReport::findOrFail($id);
        // Return the Inertia page with the report data
        return Inertia::render('ServiceReports/Show', [
            'report' => $report,
        ]);
    }

    public function create($id)
    {
        // Get the current user's name
        $user = auth()->user()->name;

        // Retrieve the staff record with the given ID
        $staff = Staff::where('id', $id)->first();

        // Pass the staff data (name, machine_code, department) to the Vue component
        return Inertia::render('ServiceReports/Create', [
            'user' => $user,
            'staff' => [
                'id' => $staff->id,
                'name' => $staff->name,
                'machine_code' => $staff->machine_code,
                'department' => $staff->department,
            ],
        ]);
    }


}
