<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Validators\ValidatorDepartment;
use App\Repositories\Repository\DepartmentRepository;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    protected $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function paginate()
    {
        $departments = $this->departmentRepository->paginate(5);

        return view('admin.department', compact('departments'));
    }

    public function departmentList()
    {
        $departments = $this->departmentRepository->getAll();

        return view('admin.department', compact('departments'));
    }

    public function addDepartment(Request $request)
    {
        ValidatorDepartment::validateDepartment($request->all());

        if ($this->departmentRepository->departmentExists($request)) {

            return response()->json(['status' => false,'message' => __('messages.dep-name_exists')]);
        } else {

            $this->departmentRepository->createDepartment($request);

            return response()->json(['status' => true,'message' => __('messages.add-dep_success')]);
        }
    }


    public function editDepartment($id)
    {
        $department = $this->departmentRepository->getByID($id);

        return view('admin.department_edit', compact('department'));
    }

    public function updateDepartment(Request $request, $id)
    {
        ValidatorDepartment::validateDepartment($request->all());

        if ($this->departmentRepository->departmentExists($request)) {
            return redirect()->back()->with('error', __('messages.dep-name_exists'));
        }
        $this->departmentRepository->updateDepartment($request, $id);

        return redirect('admin/department')->with('success', __('messages.update_ok'));
    }

    public function deleteDepartment($id)
    {
        if ($this->departmentRepository->idExists($id)){
            $this->departmentRepository->deleteDepartment($id);

            return redirect('admin/department')->with('success', __('messages.delete_ok'));
        }
        return redirect('admin/department')->with('error', __('messages.dep_not_exists'));
    }

}
