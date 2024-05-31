<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable implements CanResetPassword
{
    use Notifiable, HasApiTokens, HasFactory,SoftDeletes;

    protected $table = 'users';

    protected $fillable = [
        'email',
        'password',
        'type',
        'avatar',
        'google_token',
        'student_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}


