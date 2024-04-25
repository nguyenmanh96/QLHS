<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $primaryKey = 'id';

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function results(){
        return $this->hasMany(Result::class);
    }

    public function subjects()
    {
        return $this->hasManyThrough(Subject::class, Result::class);
    }

    public function departments(){
        return $this->belongsTo(Department::class);
    }

    public function registeredSubjects(){
        return $this->belongsToMany(Subject::class,'register_subjects');
    }
}
