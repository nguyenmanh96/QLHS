<?php

namespace App\Repositories\Repository;

use App\Models\Department;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\DepartmentRepositoryInterface;
use Illuminate\Http\Request;

class DepartmentRepository extends BaseRepository implements DepartmentRepositoryInterface
{
    public function __construct(Department $department)
    {
        parent::__construct($department);
    }

    public function createDepartment(Request $request)
    {
        return $this->create([
            'name' => $request->departmentName
        ]);
    }

    public function updateDepartment(Request $request, $id)
    {
        $department = $this->getById($id);
        $department->id = $request->input('id');
        $department->name = $request->input('name');
        $department->created_at = $request->input('created_at');
        $department->save();
    }

    public function deleteDepartment($id)
    {
        $department = $this->getById($id);
        $department->delete();
    }

    public function departmentExists($name)
    {
        return $this->where('name', $name)->exists();
    }


    public function paginate($perPage = 3)
    {
        return $this->model->paginate($perPage);
    }

}
