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
            'staff_id' => 'required|exists:staff,id',
            'machine_code' => 'required|string|unique:machines,machine_code',
            'ip' => 'nullable|ip',
            'status' => 'required|in:active,inactive,maintenance',
        ]);

        $machine = Machine::create($validated);

        return response()->json([
            'message' => 'Machine created successfully!',
            'machine' => $machine,
        ], Response::HTTP_CREATED);
    }
}
