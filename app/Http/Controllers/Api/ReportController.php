<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\JsonResponse;
use App\Models\ServiceReport;
use Validator;

class ReportController extends Controller
{
    public function index(): JsonResponse
    {
        $reports = ServiceReport::all()->unique('reported_by');

        return response()->json($reports);
    }
}
