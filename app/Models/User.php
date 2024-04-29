<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use Notifiable, HasApiTokens, HasFactory ;

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
