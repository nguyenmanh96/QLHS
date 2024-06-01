<?php

namespace App\Repositories\Repository;

use App\Models\Subject;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\SubjectRepositoryInterface;
use Illuminate\Support\Facades\Auth;


class SubjectRepository extends BaseRepository implements SubjectRepositoryInterface
{
    public function __construct(Subject $subject)
    {
        parent::__construct($subject);
    }

    public function query()
    {
        return $this->model->query();
    }

    public function getSubjectList()
    {
        $departmentID = Auth::user()->student->department_id;
        return $this->model->where('department_id', $departmentID)->with('registeredSubject', 'result');
    }

}
