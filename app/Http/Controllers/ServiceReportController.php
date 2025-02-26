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
        $staffs = Staff::with(['machine' => function ($query) {
            $query->select('id', 'staff_id', 'machine_code');
        }])->withCount('serviceReports')->get();
    
        // Return the Inertia page with the report data 
        return Inertia::render('ServiceReports/Index', [
            'staffs' => $staffs,
        ]);
    }

    public function show($id)
    {
        // Fetch the service report by ID with the related machine details
        $report = ServiceReport::with('machine')->findOrFail($id);
    
        // Return the Inertia page with the report data, including machine code
        return Inertia::render('ServiceReports/Show', [
            'report' => $report,
            'machine_code' => $report->machine?->machine_code ?? 'N/A', // Handle null values safely
        ]);
    }
    

    public function create($id)
    {
        // Get the current user's name
        $user = auth()->user()->name;

        // Retrieve the staff record with the given ID and its associated machine
        $staff = Staff::with('machine')->where('id', $id)->firstOrFail();

        // Pass the staff data (name, machine_code, department) to the Vue component
        return Inertia::render('ServiceReports/Create', [
            'user' => $user,
            'staff' => [
                'id' => $staff->id,
                'name' => $staff->name,
                'machine_id' => $staff->machine ? $staff->machine->id : 'No Machine Assigned',
                'machine_code' => $staff->machine ? $staff->machine->machine_code : 'No Machine Assigned',
                'department' => $staff->department,
            ],
        ]);
    }

}
