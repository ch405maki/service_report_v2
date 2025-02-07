<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceReportResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'job_order_no' => $this->job_order_no,
            'date' => $this->date,
            'department' => $this->department,
            'machine_code' => $this->machine_code,
            'problem_concern' => $this->problem_concern,
            'causes' => $this->causes,
            'action_taken' => $this->action_taken,
            'remark_recommendation' => $this->remark_recommendation,
            'reported_by' => $this->reported_by,
            'reported_date_time' => $this->reported_date_time,
            'serviced_by' => $this->serviced_by,
            'serviced_date_time' => $this->serviced_date_time,
            'approval' => $this->approval,
        ];
    }
}
