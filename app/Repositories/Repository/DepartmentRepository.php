<?php

namespace App\Repositories\Repository;

use App\Models\Department;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\DepartmentRepositoryInterface;

class DepartmentRepository extends BaseRepository implements DepartmentRepositoryInterface
{
    public function __construct(Department $department)
    {
        parent::__construct($department);
    }

    public function paginate($perPage = 10)
    {
        return $this->model->paginate($perPage);
    }

}
