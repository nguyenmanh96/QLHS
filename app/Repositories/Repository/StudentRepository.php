<?php

namespace App\Repositories\Repository;

use App\Models\Student;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\StudentRepositoryInterface;

class StudentRepository extends BaseRepository implements StudentRepositoryInterface
{
    public function __construct(Student $student)
    {
        parent::__construct($student);
    }


}
