<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterSubject extends Model
{
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

    public function subjects(){
        return $this->belongsTo(Subject::class);
    }
}
