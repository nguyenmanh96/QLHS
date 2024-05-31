<?php

namespace App\Http\Controllers\Student;

use App\Enums\Pagination;
use App\Http\Controllers\Controller;
use App\Repositories\Repository\RegisterSubjectRepository;
use App\Repositories\Repository\ResultRepository;
use Illuminate\Http\Request;
use App\Repositories\Repository\SubjectRepository;
use Illuminate\Support\Facades\Auth;

class StudentSubjectController extends Controller
{
    protected $subjectRepository;

    public function __construct(SubjectRepository $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    public function index()
    {
        $departmentID = Auth::user()->student->department_id;
        $subjects = $this->subjectRepository->where('department_id',$departmentID)->with('registeredSubject')->get();

//        dd($subjects);

        return view('student.subject', compact('subjects'));

    }

    public function store(Request $request)
    {
        $subject = $this->subjectRepository->getById($request['id']);

        $isRegistered = $subject->registeredSubject;
//        dd($isRegistered);



        if ($isRegistered) {
            $isRegistered->registeredSubject->updateOrCreate([
                'student_id' => Auth::user()->student->id,
                'status' => 'Registered',
                'subject_id' => $request['id'],
            ]);

            return redirect('student/subject')->with('success', __('messages.reg_ok'));
        }

        return redirect('student/subject')->with('error', __('validation.already_registered'));
    }



//    public function search(Request $request)
//    {
//        $results = $this->subjectRepository->result->getAll()->paginate(2);
//        $searchOption = $request['search_option'];
//        $searchKeyword = $request['search_keyword'];
//        $subjects = null;
//
//        switch ($searchOption) {
//            case 'order_number':
//                $subjects = $this->subjectRepository->search('id', 'like', '%' . $searchKeyword . '%')->paginate(2);
//                break;
//            case 'subject_name':
//                $subjects = $this->subjectRepository->search('name', 'like', '%' . $searchKeyword . '%')->paginate(2);
//                break;
//            case 'department_id':
//                $subjects = $this->subjectRepository->search('department_id', 'like', '%' . $searchKeyword . '%')->paginate(2);
//                break;
//            case 'actions':
//                $subjects = $this->subjectRepository->query()
//                    ->with('registeredSubjects')
//                    ->whereHas('registeredSubjects', function ($query) use ($searchKeyword) {
//                        $query->where('status', 'like', '%' . $searchKeyword . '%')->get();
//                    })
//                    ->paginate(2);
////                dd($subjects);
//                break;
//            case 'grades':
//                $subjects = $this->subjectRepository->query()
//                    ->with('result')
//                    ->whereHas('result', function ($query) use ($searchKeyword) {
//                        $query->where('score', 'like', '%' . $searchKeyword . '%')->get();
//                    })
//                    ->paginate(2);
//                break;
//            default:
//
//                break;
//
//        }
////        dd($subjects);
//        return view('student.subject', compact(['subjects']));
//    }

}
