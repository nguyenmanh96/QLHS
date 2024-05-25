<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use SoftDeletes;

    protected $table = 'sujects';

    protected $fillable = [
        'name',
        'department_id',
    ];
    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function registerSubject(){
        return $this->hasMany(RegisterSubject::class);
    }

    public function result(){
        return $this->hasMany(Result::class);
    }
}
