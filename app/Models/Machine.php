<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'machine_code',
        'ip',
        'status',
        'monitor',
        'processor',
        'motherboard',
        'memory',
        'drive',
        'video_card',
        'mac_address',
        'ups',
        'ms_office',
        'operating_system',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}