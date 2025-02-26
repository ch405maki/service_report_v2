<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Machine;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MachineController extends Controller
{
    /**
     * Store a newly created machine.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'staff_id' => 'nullable',
            'machine_code' => 'required|string|unique:machines,machine_code',
            'ip' => 'nullable|ip',
            'status' => 'required|in:active,inactive,maintenance',
            'monitor' => 'nullable|string',
            'processor' => 'nullable|string',
            'motherboard' => 'nullable|string',
            'memory' => 'nullable|string',
            'drive' => 'nullable|string',
            'video_card' => 'nullable|string',
            'mac_address' => 'nullable|string',
            'ups' => 'nullable|string',
            'ms_office' => 'nullable|string',
            'operating_system' => 'nullable|string',
        ]);

        $machine = Machine::create($validated);

        return response()->json([
            'message' => 'Machine created successfully!',
            'machine' => $machine,
        ], Response::HTTP_CREATED);
    }

    public function assignUser(Request $request, $id)
    {
        $request->validate([
            'staff_id' => 'nullable|exists:staff,id', // Allow null for unassigning
        ]);

        $machine = Machine::findOrFail($id);
        $machine->staff_id = $request->staff_id; // Assign staff or set to null
        $machine->save();

        return response()->json([
            'message' => $request->staff_id ? 'User assigned successfully' : 'User unassigned successfully',
            'machine' => $machine
        ]);
    }

}
