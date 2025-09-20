<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    //
     use HasFactory, SoftDeletes;

     protected $guarded = [];
    // protected $fillable = [
    //     'user_id', 'address', 'kecamatan', 'kabupaten',
    //     'provinsi', 'phone_number', 'post_code', 'photo_profile'
    // ];

     public function user()
    {
       return $this->belongsTo(User::class, 'user_id');
    }
}
