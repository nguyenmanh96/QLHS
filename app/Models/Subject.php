<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use SoftDeletes;

    protected $table = 'subjects';

    protected $fillable = [
        'name',
        'department_id',
    ];
    public function department()
    {
        return $this->belongsTo(Department::class,'department_id');
    }

    public function registeredSubject()
    {
        return $this->belongsToMany(Student::class, 'register_subjects', 'subject_id', 'student_id')
            ->withPivot('status');
    }

    public function result()
    {
        return $this->belongsToMany(Student::class,'results', 'subject_id', 'student_id')->withPivot('score');
    }
}
