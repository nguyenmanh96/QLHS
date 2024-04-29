<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;

class Subject extends Model
{
    protected $table = 'sujects';

    protected $fillable = [
        'name',
        'department_id',
    ];
    public function departments(){
        return $this->belongsTo(Department::class);
    }

    public function registeredStudents(){
        return $this->hasMany(RegisterSubject::class);
    }

    public function results(){
        return $this->hasMany(Result::class);
    }
}
