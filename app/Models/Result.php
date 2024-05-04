<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Result extends Model
{
    use SoftDeletes;

    protected $table = 'results';

    protected $fillable = [
        'student_id',
        'subject_id',
        'score',
    ];

    public function students(){
        return $this->belongsToMany(Student::class);
    }

    public function subjects(){
        return $this->belongsToMany(Result::class);
    }
}
