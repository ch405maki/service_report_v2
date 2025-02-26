<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $fillable = ['staff_id', 'machine_code', 'ip', 'status'];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
