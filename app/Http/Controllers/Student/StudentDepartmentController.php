<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Repositories\Repository\DepartmentRepository;

class StudentDepartmentController extends Controller
{
    protected $departmentRepository;
    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function index()
    {
        $perPage = 2;
        $departments = $this->departmentRepository->getAll()->paginate($perPage);
        return view('student.department',compact('departments'));
    }
}
