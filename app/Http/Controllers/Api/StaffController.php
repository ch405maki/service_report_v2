<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // Ensure this is correctly imported
use App\Models\Staff;

class StaffController extends Controller
{
    // Display a listing of staff
    public function index()
    {
        return response()->json(Staff::all());
    }

    // Store a newly created staff in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'machine_code' => 'required|string|unique:staff|max:255',
            'department' => 'required|string|max:255',
        ]);

        $staff = Staff::create($request->all());

        return response()->json($staff, 201);
    }

    // Display the specified staff member
    public function show(Staff $staff)
    {
        return response()->json($staff);
    }

    // Update the specified staff in storage
    public function update(Request $request, Staff $staff)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'machine_code' => 'sometimes|required|string|unique:staff,machine_code,' . $staff->id,
            'department' => 'sometimes|required|string|max:255',
        ]);

        $staff->update($request->all());

        return response()->json($staff);
    }

    // Remove the specified staff from storage
    public function destroy(Staff $staff)
    {
        $staff->delete();
        return response()->json(['message' => 'Staff deleted successfully']);
    }
}


