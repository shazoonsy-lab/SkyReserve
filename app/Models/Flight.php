<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
      protected $fillable = [
        'flight_number',
        'airline',
        'aircraft',
        'departure_city',
        'arrival_city',
        'departure_time',
        'arrival_time',
        'seats',
        'price',
        'available_seats'
    ];

    protected $dates = ['departure_time','arrival_time'];


     // تحويل الحقول إلى تواريخ
    protected $casts = [
        'departure_time' => 'datetime',
        'arrival_time' => 'datetime',
    ];

    public function bookings()
{
    return $this->hasMany(Booking::class);
}

}
