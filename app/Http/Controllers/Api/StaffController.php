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
        $staff = Staff::paginate(10); // Paginate results
        return response()->json([
            'staff' => $staff,
        ], Response::HTTP_OK);
    }

    // Store a newly created staff in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
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


