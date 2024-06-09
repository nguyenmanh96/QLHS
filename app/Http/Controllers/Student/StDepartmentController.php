<?php

namespace App\Http\Controllers\Student;

use App\Enums\Pagination;
use App\Http\Controllers\Controller;
use App\Repositories\Repository\DepartmentRepository;

class StDepartmentController extends Controller
{
    protected $departmentRepository;
    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function index()
    {
        $departments = $this->departmentRepository->getAll()->paginate(Pagination::PERPAGE);
        return view('student.department',compact('departments'));
    }
}
