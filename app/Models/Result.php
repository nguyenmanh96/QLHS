<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'results';

    protected $primaryKey = 'id';

    public function students(){
        return $this->belongsTo(Student::class);
    }

    public function subjects(){
        return $this->belongsTo(Result::class);
    }
}
