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

    public function paginate($perPage = 10)
    {
        return $this->model->paginate($perPage);
    }
}
