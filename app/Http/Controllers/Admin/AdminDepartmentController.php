<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Repository\DepartmentRepository;
use Illuminate\Http\Request;
use App\Http\Requests\DepartmentNameRequest;


class AdminDepartmentController extends Controller
{
    protected $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function index()
    {
        $perPage = 3;
        $departments = $this->departmentRepository->getAll()->paginate($perPage);

        return view('admin.department.department', compact('departments'));
    }

    public function store(DepartmentNameRequest $request)
    {
        $department = $request['departmentName'];

        $this->departmentRepository->create(['name' => $department]);

        return redirect('admin/department')->with('success', __('messages.add-dep_success'));
    }


    public function edit(Request $request)
    {
        $department = $this->departmentRepository->getByID($request['id']);

        return view('admin.department.department_edit', compact('department'));
    }

    public function update(DepartmentNameRequest $request)
    {
        $id = $request['id'];
        $this->departmentRepository->update($id, ['name' => $request['departmentName']]);

        return redirect('admin/department')->with('success', __('messages.update_ok'));
    }

    public function destroy(Request $request)
    {
        if ($this->departmentRepository->getById($request['id'])) {
            $this->departmentRepository->delete($request['id']);

            return redirect('admin/department')->with('success', __('messages.delete_ok'));
        }
        return redirect('admin/department')->with('error', __('messages.dep_not_exists'));
    }

}
