<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleManager extends Model
{
    use HasFactory;

    protected $table = 'schedulemanagers';
    protected $fillable = [
        'service_id', 'zone_id', 'date',
        'day', 'month', 'year', 'from_hour', 'within_hour',
        'team_id', 'team_availability', 'is_booked',
        'created_at', 'updated_at'
    ];
}
