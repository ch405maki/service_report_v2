<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\ServiceReport;
use App\Models\Machine;
use App\Models\Staff;

class ReportController extends Controller
{
    public function index()
    {
        $reports = ServiceReport::with('machine') // Load the related machine
            ->orderByDesc('created_at')
            ->get()
            ->unique('reported_by');

        return Inertia::render('Reports/Index', [
            'reports' => $reports,
        ]);
    }

    public function show($reported_by)
    {
        // Fetch reports with machine details
        $reports = ServiceReport::where('reported_by', $reported_by)
                    ->with('machine') // Ensure a relationship with machines
                    ->latest()
                    ->get();

        // Get the unique machine code (assuming one per reported_by)
        $machine_code = $reports->isNotEmpty() ? $reports->first()->machine->code ?? 'No Machine Assigned' : 'No Machine Assigned';

        // Return the Inertia page with the report and machine data
        return Inertia::render('Reports/Show', [
            'reports' => $reports,
            'machine_code' => $machine_code
        ]);
    }


    public function machine()
    {
        $reports = ServiceReport::with(['machine', 'staff'])
            ->whereIn('id', function ($query) {
                $query->selectRaw('MAX(id)')
                    ->from('service_reports')
                    ->groupBy('machine_id');
            })
            ->orderByDesc('created_at')
            ->get();
    
        return Inertia::render('Reports/Machine/Index', [
            'reports' => $reports,
        ]);
    }
    

    public function machine_show($machine_id)
    {
        $reports = ServiceReport::where('machine_id', $machine_id)
            ->latest()
            ->get();
    
        if ($reports->isEmpty()) {
            return Inertia::render('Reports/Machine/Show', [
                'reports' => [],
                'machine_code' => null,
            ]);
        }
    
        return Inertia::render('Reports/Machine/Show', [
            'reports' => $reports,
            'machine_code' => $reports->first()->machine->machine_code ?? 'No Machine Assigned',
        ]);
    }

    public function inventory_pc()
    {
        // Get staff members who do not have a machine
        $staff = Staff::doesntHave('machine')->get();

        // Get all machines with their associated staff
        $machines = Machine::with('staff')->get();

        return Inertia::render('Reports/Inventory/Index', [
            'staffList' => $staff,
            'machines' => $machines
        ]);
    }
    
}
