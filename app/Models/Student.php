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
        'sex'
    ];


    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function result()
    {
        return $this->belongsToMany(Subject::class, 'results', 'student_id', 'subject_id')->withPivot('score');
    }


    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function registeredSubject()
    {
        return $this->belongsToMany(Subject::class, 'register_subjects', 'student_id', 'subject_id')
            ->withPivot('status');
    }
}
