<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venues extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'categories',
        'amenities',
        'images',
        'location',
        'state',
        'city',
        'start_time',
        'end_time',
        'slot_booking',
        'charge_per_slot',
        'available_days',
        'exclude_dates',
        'overwrite_default'
    ];
}
