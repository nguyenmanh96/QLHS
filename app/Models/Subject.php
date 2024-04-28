<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;

class Subject extends Model
{
    protected $table = 'sujects';


    public function departments(){
        return $this->belongsTo(Department::class);
    }

    public function registeredStudents(){
        return $this->belongsToMany(Student::class,'register_subjects');
    }
}
