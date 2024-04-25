<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'sujects';

    protected $primaryKey = 'id' ;

    public function departments(){
        return $this->belongsTo(Department::class);
    }

    public function registeredStudents(){
        return $this->belongsToMany(Student::class,'register_subjects');
    }
}
