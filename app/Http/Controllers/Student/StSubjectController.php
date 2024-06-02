<?php

namespace App\Http\Controllers\Student;

use App\Enums\Pagination;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Repository\SubjectRepository;
use Illuminate\Support\Facades\Auth;

class StSubjectController extends Controller
{
    protected $subjectRepository;

    public function __construct(SubjectRepository $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    public function index()
    {
        $subjects = $this->subjectRepository->getSubjectList()->paginate(Pagination::PERPAGE);
        foreach ($subjects as $subject) {
            $subject->status = $subject->registeredSubject->pluck('pivot')->firstWhere('student_id', Auth::user()->student->id)['status'] ?? null;
            $subject->score = $subject->result->pluck('pivot')->firstWhere('student_id', Auth::user()->student->id)['score'] ?? null;
        }

        return view('student.subject', compact(['subjects']));
    }

    public function store(Request $request)
    {
        $subjectId = $request['id'];
        $registered = $this->subjectRepository->registerSubject($subjectId);

        if ($registered === true) {
            return redirect()->back()->with('success', __('messages.reg_ok'));
        } elseif ($registered === false) {
            return redirect()->back()->with('error', __('messages.already_registered'));
        } else{
            return redirect()->back()->with('error', __('messages.cannot_register'));
        }
    }

    public function search(Request $request)
    {
        $filters = $request->only(['subjectName_keyword', 'departmentId_keyword', 'grades_keyword', 'status_keyword']);
        $subjects = $this->subjectRepository->searchSubjects($filters);
        foreach ($subjects as $subject) {
            $subject->status = $subject->registeredSubject->pluck('pivot')->firstWhere('student_id', Auth::user()->student->id)['status'] ?? null;
            $subject->score = $subject->result->pluck('pivot')->firstWhere('student_id', Auth::user()->student->id)['score'] ?? null;
        }

        return view('student.subject', compact('subjects'));
    }
}
