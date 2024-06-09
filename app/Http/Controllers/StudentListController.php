<?php

namespace App\Http\Controllers;

use App\Enums\Pagination;
use App\Http\Requests\GradesRequest;
use App\Http\Requests\StudentRequest;
use App\Repositories\Repository\DepartmentRepository;
use App\Repositories\Repository\StudentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentListController extends Controller
{
    protected $studentRepository;

    protected $departmentRepository;

    public function __construct(StudentRepository $studentRepository, DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
        $this->studentRepository = $studentRepository;
    }

    public function index(Request $request)
    {
        $departments = $this->departmentRepository->getAll()->get();
        $students = $this->studentRepository->searchStudent($request);
        $students->each(function ($student) {

            $student->subjectReg = DB::table('subjects')
                ->join('register_subjects', 'subjects.id', '=', 'register_subjects.subject_id')
                ->where('register_subjects.student_id', $student->id)
                ->where('register_subjects.status', 'Registered')
                ->where('subjects.department_id', $student->department_id)
                ->count();

            $student->notReg = DB::table('subjects')
                ->join('register_subjects', 'subjects.id', '=', 'register_subjects.subject_id')
                ->where('register_subjects.student_id', $student->id)
                ->where('register_subjects.status', '!=', 'Registered')
                ->where('subjects.department_id', $student->department_id)->get();

            $avgScore = DB::table('results')
                ->join('subjects', 'results.subject_id', '=', 'subjects.id')
                ->where('results.student_id', $student->id)
                ->where('subjects.department_id', $student->department_id)
                ->avg('results.score');

            $student->avg_score = number_format($avgScore);
        });
        return view('admin.student.index', compact('students', 'departments'));
    }

    public function create()
    {
        $departments = $this->departmentRepository->getAll()->paginate(Pagination::PERPAGE);
        return view('admin.student.add', compact('departments'));
    }


    public function store(StudentRequest $request)
    {
        $this->studentRepository->addStudent($request);

        return redirect()->back()->with('success', __('messages.add_st_success'));
    }


    public function edit(Request $request)
    {
        $student = $this->studentRepository->getById($request['id']);
        $departments = $this->departmentRepository->getAll()->get();

        return view('admin.student.edit', compact('student', 'departments'));
    }

    public function update(StudentRequest $request)
    {
        $students = $this->studentRepository->update($request['id'], [
            'name' => $request['studentName'],
            'department_id' => $request['departmentId'],
            'dob' => $request['dob'],
            'sex' => $request['sex'],
        ]);
        $students->save();

        return redirect('admin/student-list')->with('success', __('messages.update_ok'));
    }

    public function show(Request $request)
    {
        $student = $this->studentRepository->getByID($request['id']);
        $subjects = $this->studentRepository->getRegisteredSubjects($request);
        foreach ($subjects as $subject)
            $subject->score = $subject->result->pluck('pivot')->firstWhere('student_id', $request['id'])['score'] ?? null;

        return view('admin.student.score_edit', compact('subjects', 'student'));
    }

    public function updateScore(GradesRequest $request)
    {
        $this->studentRepository->updateScore($request);

        return redirect()->back()->with('success', __('messages.update_grades_ok'));
    }

    public function destroy(Request $request)
    {
        if ($this->studentRepository->getById($request['id'])) {
            $this->studentRepository->delete($request['id']);
            return redirect('admin/student-list')->with('success', __('messages.delete_ok'));
        }

        return redirect('admin/student-list')->with('error', __('messages.st_not_exists'));
    }

    public function notification(Request $request)
    {
        $regOrNot = $this->studentRepository->sendNotifyAboutReg($request['id']);
        if ($regOrNot == true) {
            return response()->json(['status' => true, 'message' => __('messages.send_notify_success')]);
        } else {
            return response()->json(['status' => false, 'message' => __('messages.already_reg_all')]);
        }
    }
}
