<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'flight_id',
           'user_id',
        'customer_name',
        'customer_email',
        'phone',
        'seats',
        'seat_type',
        'seat_price',
        'total_price',
        'status',
        'booking_code',
        'employee_id',
    ];

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function payment()
{
    return $this->hasOne(Payment::class);
}

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    

}
