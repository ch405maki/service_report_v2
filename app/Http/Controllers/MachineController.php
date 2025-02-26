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
            'staffList' => $staff,
            'machines' => $machines
        ]);
    }

    public function create()
    {
        // Get staff members who do not have a machine
        $staff = Staff::doesntHave('machine')->get();

        // Get all machines with their associated staff
        $machines = Machine::with('staff')->get();

        return Inertia::render('Machines/Create', [
            'staff' => $staff,
            'machines' => $machines
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'staff_id' => 'required|exists:staff,id',
        ]);

        $machine = Machine::findOrFail($id);
        $machine->staff_id = $request->staff_id;
        $machine->save();

        return redirect()->back()->with('success', 'User assigned to machine successfully.');
    }

}
