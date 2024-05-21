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
            'name' => $request->input('departmentName')
        ]);
    }

    public function updateDepartment(Request $request, $id)
    {
        $department = [
            'name' => $request->input('departmentName'),
        ];

        return $this->update($id, $department);
    }

    public function deleteDepartment($id)
    {
        return $this->delete($id);
    }

    public function departmentExists(Request $request)
    {
        return $this->exists('name', $request->input('departmentName'));
    }

    public function paginate($perPage)
    {
        return $this->pagination($perPage);
    }

}
