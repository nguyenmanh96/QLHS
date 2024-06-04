<?php

namespace App\Repositories\Repository;

use App\Enums\Pagination;
use App\Models\Subject;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\SubjectRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SubjectRepository extends BaseRepository implements SubjectRepositoryInterface
{
    public function __construct(Subject $subject)
    {
        parent::__construct($subject);
    }

    public function query()
    {
        return $this->model->query();
    }

    public function getSubjectList()
    {
        $departmentID = Auth::user()->student->department_id;
        return $this->model->where('department_id', $departmentID)->with('registeredSubject', 'result');
    }

    public function registerSubject($subjectId)
    {
        $subject = $this->model->find($subjectId);
        $exist = $subject->registeredSubject()->where('student_id', Auth::user()->student->id)->exists();
        $status = $subject->registeredSubject()->where(['student_id' => Auth::user()->student->id, 'status' => 'Registered'])->exists();

        if ($exist) {
            if (!$status) {
                $subject->registeredSubject()->where('student_id', Auth::user()->student->id)->update(['status' => 'Registered']);
                return true;
            }
            return false;
        }

        return null;
    }

    public function searchSubjects($filters)
    {
        $query = $this->model->where('department_id', Auth::user()->student->department_id);

        if (isset($filters['subjectName_keyword'])) {
            $query->where('name', 'like', '%' . $filters['subjectName_keyword'] . '%');
        }

        if (isset($filters['departmentId_keyword'])) {
            $query->where('department_id', $filters['departmentId_keyword']);
        }

        if (isset($filters['grades_keyword'])) {
            $query->whereHas('result', function ($q) use ($filters) {
                $q->where('score', $filters['grades_keyword']);
            });
        }

        if (isset($filters['status_keyword'])) {
            $query->whereHas('registeredSubject', function ($q) use ($filters) {
                $q->where('status', $filters['status_keyword']);
            });
        }

        return $query->paginate(Pagination::PERPAGE);
    }

    public function filterDelete($request)
    {
        $subject = $this->model->find($request);
        $exists = $subject->registeredSubject()->with('status', 'Registered')->exists();

        if ($subject) {
            if (!$exists) {

                return true;
            }

            return false;
        }

        return null;
    }

}
