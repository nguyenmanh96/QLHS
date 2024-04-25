<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';

    protected $primaryKey = 'id';

    public function students(){
        return $this->hasMany(Student::class);
    }

    public function subjects(){
        return $this->hasMany(Subject::class);
    }
}
