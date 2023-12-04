<?php

namespace App\Models;

use App\Models\Venues;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bookings extends Model
{
    use HasFactory;

    protected $table = 'bookings';
    
    protected $fillable = [
        'venus_id',
        'booking_date',
        'slots',
        'amount'
    ];
    
}
