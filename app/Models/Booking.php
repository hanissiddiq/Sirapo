<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class Booking extends Model
{
    use HasFactory, SoftDeletes;

    // protected $fillable = ['booking_date', 'booking_time', 'user_name', 'status'];
    protected $fillable = [
        'booking_date',
        'booking_time',
        'user_id',
        'package_id',
        'status',
        'queue_number',
        'user_name', // kalau kolomnya ada
    ];

    public function payments()
    {
        return $this->hasOne(Payment::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
