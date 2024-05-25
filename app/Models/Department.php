<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    protected $table = 'departments';

    protected $fillable = [
        'name',
    ];

    public function student(){
        return $this->hasMany(Student::class);
    }

    public function subject(){
        return $this->hasMany(Subject::class);
    }
}
