<?php

namespace App\Repositories\Repository;

use App\Models\Subject;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\SubjectRepositoryInterface;


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

//    public function getScore(){
//        return $this->model->with('register_subjects');
//    }
}
