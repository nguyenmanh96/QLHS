<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegisterSubject extends Model
{
    use SoftDeletes;

    protected $table = 'register_subjects';

    protected $fillable = [
        'student_id',
        'subject_id',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }
}
