<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * مهم جداً مع Spatie
     */
    protected $guard_name = 'web';

    /**
     * الحقول القابلة للتعبئة
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo',
    ];

    /**
     * الحقول المخفية
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * التحويلات
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /* =======================
       العلاقات
    ======================= */

    // الحجوزات التي أنشأها الموظف
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'employee_id');
    }
}
