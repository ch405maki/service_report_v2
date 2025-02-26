<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Machine;
use Inertia\Inertia;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::with('machine')->get(); // Eager load machines

        return Inertia::render('Staff/Index', ['staff' => $staff]);
    }

}
