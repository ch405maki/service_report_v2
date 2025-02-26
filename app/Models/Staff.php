<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staff';

    protected $fillable = [
        'name',
        'department',
    ];

    public function serviceReports()
    {
        return $this->hasMany(ServiceReport::class); // Each Staff has many ServiceReports
    }
    
    public function machine()
    {
        return $this->hasOne(Machine::class);
    }
}