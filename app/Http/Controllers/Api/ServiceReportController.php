<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\ServiceReportResource;
use Illuminate\Http\JsonResponse;
use App\Models\ServiceReport;
use Validator;

class ServiceReportController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        // $reports = ServiceReport::where('user_id', auth()->id())->get();
        $reports = ServiceReport::latest()->get();
        return $this->sendResponse(ServiceReportResource::collection($reports), 'Service reports retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        //dd($request->all());
        // Get the request data
        $input = $request->all();

        // Add the authenticated user's ID to the input array
        // $input['user_id'] = auth()->id();

        // Validate the input data
        $validator = Validator::make($input, [
            'job_order_no' => 'required|unique:service_reports,job_order_no',
            'date' => 'required|date',
            'type' => 'required',
            'department' => 'required',
            'machine_id' => 'required',
            'problem_concern' => 'required',
            'causes' => 'nullable',
            'action_taken' => 'nullable',
            'remark_recommendation' => 'nullable',
            'reported_by' => 'required',
            'reported_date_time' => 'required|date',
            'serviced_by' => 'nullable',
            'serviced_date_time' => 'nullable|date',
            'approval' => 'nullable',
            'staff_id' => 'required',
            'otherType' => 'nullable',
        ]);

        // Return validation errors if validation fails
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        // Create the new service report with the input data, including the user_id
        $report = ServiceReport::create($input);

        // Return a success response with the created report data
        return $this->sendResponse(new ServiceReportResource($report), 'Service report created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $report = ServiceReport::find($id);

        if (is_null($report)) {
            return $this->sendError('Service report not found.');
        }

        return $this->sendResponse(new ServiceReportResource($report), 'Service report retrieved successfully.');
    }

    public function update(Request $request, ServiceReport $report): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'job_order_no' => 'required|unique:service_report,job_order_no,' . $report->id,
            'date' => 'required|date',
            'type' => 'required',
            'department' => 'required',
            'machine_code' => 'required',
            'problem_concern' => 'required',
            'causes' => 'nullable',
            'action_taken' => 'nullable',
            'remark_recommendation' => 'nullable',
            'reported_by' => 'required',
            'reported_date_time' => 'required|date',
            'serviced_by' => 'nullable',
            'serviced_date_time' => 'nullable|date',
            'approval' => 'nullable',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $report->update($input);

        return $this->sendResponse(new ServiceReportResource($report), 'Service report updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceReport $report): JsonResponse
    {
        $report->delete();
        return $this->sendResponse([], 'Service report deleted successfully.');
    }
}
