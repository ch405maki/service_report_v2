<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Staff;
use App\Models\Machine;

class MachineController extends Controller
{
    public function index()
    {
        // Get staff members who do not have a machine
        $staff = Staff::doesntHave('machine')->get();

        // Get all machines with their associated staff
        $machines = Machine::with('staff')->get();

        return Inertia::render('Machines/Index', [
            'staff' => $staff,
            'machines' => $machines
        ]);
    }
}
