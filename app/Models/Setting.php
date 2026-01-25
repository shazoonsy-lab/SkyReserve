<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name', 'logo', 'admin_bg', 'seat_prices', 'notification_email'
    ];

    protected $casts = [
        'seat_prices' => 'array', // لتخزين JSON كـ array تلقائياً
    ];
}
