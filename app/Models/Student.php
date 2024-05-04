<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $table = 'students';

    protected $fillable = [
        'name',
        'code',
        'dob',
        'department_id',
    ];


    public function user(){
        return $this->hasOne(User::class);
    }

    public function results(){
        return $this->hasMany(Result::class);
    }


    public function departments(){
        return $this->belongsTo(Department::class);
    }

    public function registerSubjects(){
        return $this->hasMany(RegisterSubject::class);
    }
}
