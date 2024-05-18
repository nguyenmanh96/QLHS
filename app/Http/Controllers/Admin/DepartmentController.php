<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Repository\DepartmentRepository;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    protected $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function paginateDepartment()
    {
        $departments = $this->departmentRepository->paginate();
        return view('admin.department', compact('departments'));
    }

    public function departmentList()
    {
        $departments = $this->departmentRepository->getAll();

        return view('admin.department', compact('departments'));
    }

    public function addDepartment(Request $request)
    {
        $department = $request->departmentName;
        if ($this->departmentRepository->departmentExists($department)) {
            return redirect()->back()->with('error', __('messages.exists'));
        }
        $this->departmentRepository->createDepartment($request);

        return redirect('admin/department')->with('success', __('messages.add_success'));
    }

    public function editDepartment($id)
    {
        $department = $this->departmentRepository->getByID($id);

        return view('admin.department_edit', compact('department'));
    }

    public function updateDepartment(Request $request, $id)
    {
        $this->departmentRepository->updateDepartment($request, $id);

        return redirect('admin/department')->with('success', __('messages.update_ok'));
    }

    public function deleteDepartment($id)
    {
        $this->departmentRepository->deleteDepartment($id);

        return redirect('admin/department')->with('success', __('messages.delete_ok'));
    }


}
