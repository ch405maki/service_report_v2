<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Machine;
use App\Models\User;
use App\Models\Staff;

class ServiceReport extends Model
{
    use HasFactory;

    protected $table = 'service_reports';

    protected $fillable = [
        'staff_id',
        'machine_id',
        'job_order_no',
        'date',
        'type',
        'department',
        'problem_concern',
        'causes',
        'action_taken',
        'remark_recommendation',
        'reported_by',
        'reported_date_time',
        'serviced_by',
        'serviced_date_time',
        'approval',
        'otherType',
    ];

    /**
     * Get the user that owns the ServiceReport.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }
}
