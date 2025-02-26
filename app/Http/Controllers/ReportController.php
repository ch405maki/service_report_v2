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

    public function show($reported_by){

        //dd($reported_by);

        $reports = ServiceReport::WHERE('reported_by', $reported_by)->latest()->get();

        // Return the Inertia page with the report data
        return Inertia::render('Reports/Show', [
            'reports' => $reports,
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
                'machine_code' => null, // Handle empty case
            ]);
        }
    
        return Inertia::render('Reports/Machine/Show', [
            'reports' => $reports,
            'machine_code' => $reports->first()->machine->machine_code ?? 'No Machine Assigned',
        ]);
    }
    
}
