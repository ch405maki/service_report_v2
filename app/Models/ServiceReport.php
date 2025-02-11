<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceReport extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'service_report';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'job_order_no',
        'date',
        'type',
        'department',
        'machine_code',
        'problem_concern',
        'causes',
        'action_taken',
        'remark_recommendation',
        'reported_by',
        'reported_date_time',
        'serviced_by',
        'serviced_date_time',
        'approval',
    ];

    /**
     * Get the user that owns the ServiceReport.
     */
    public function user()
    {
        return $this->belongsTo(User::class); // Each ServiceReport belongs to a User
    }
}
