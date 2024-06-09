<?php

namespace App\Repositories\Repository;

use App\Enums\Pagination;
use App\Mail\AccountNotifyMail;
use App\Mail\RegNotifyMail;
use App\Models\Student;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\StudentRepositoryInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class StudentRepository extends BaseRepository implements StudentRepositoryInterface
{
    public function __construct(Student $student)
    {
        parent::__construct($student);
    }

    public function addStudent($request)
    {
        $student = $this->model->create([
            'name' => $request['studentName'],
            'dob' => $request['dob'],
            'sex' => $request['sex'],
            'code' => 'NW' . rand(1000, 9999),
            'department_id' => $request['departmentId'],
        ]);

        $subjects = DB::table('subjects')
            ->join('departments', 'subjects.department_id', '=', 'departments.id')
            ->where('departments.id', $student->department_id)
            ->pluck('subjects.id');

        foreach ($subjects as $subjectId) {
            $student->registeredSubject()->attach($subjectId, [
                'status' => 'Unregistered'
            ]);
            $student->result()->attach($subjectId, [
                'score' => null
            ]);
        }

        $user = $student->user()->create([
            'email' => $request['email'],
            'password' => bcrypt(Str::ascii($request['studentName']) . 'ngonsongmoi'),
            'type' => 'Student',
        ]);

        Mail::to($user->email)->send(new AccountNotifyMail($user));

    }

    public function getRegisteredSubjects($request)
    {
        $query = $this->model->query()->find($request['id'])->registeredSubject()->wherePivot('status', 'Registered');

        if (!empty($request['subjectName_keyword'])) {
            $query->where('subjects.name', 'like', '%' . $request['subjectName_keyword'] . '%');
        }

        if (!empty($request['departmentName_keyword'])) {
            $query->whereHas('department', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request['departmentName_keyword'] . '%');
            });
        }

        if (!empty($request['grades_keyword'])) {
            $query->whereHas('result', function ($q) use ($request) {
                $q->where('score', $request['grades_keyword']);
            });
        }

        return $query->paginate(Pagination::PERPAGE);
    }

    public function updateScore($request)
    {
        $result = $this->model->query()
            ->with('result')
            ->find($request['studentId']);
        $subjectResult = $result->result->pluck('pivot')
            ->where('subject_id', $request['subjectId'])
            ->first();
        $subjectResult->update([
            'score' => $request['grades'],
        ]);
    }

    public function searchStudent($request)
    {
        $query = $this->model->query();
        if ($request['age_from_keyword']) {
            $query->where('dob', '<=', Carbon::now()->subYears($request['age_from_keyword']));
        }
        if ($request['age_to_keyword']) {
            $query->where('dob', '>=', Carbon::now()->subYears($request['age_to_keyword']));
        }
        if ($request['score_from_keyword'] || $request['score_to_keyword']) {
            $query->whereHas('result', function ($scoreQuery) use ($request) {
                $scoreQuery->select(DB::raw('AVG(score) as avg_score'))->groupBy('student_id');
                if ($request['score_from_keyword']) {
                    $scoreQuery->havingRaw('avg_score >= ?', [$request['score_from_keyword']]);
                }
                if ($request['score_to_keyword']) {
                    $scoreQuery->havingRaw('avg_score <= ?', [$request['score_to_keyword']]);
                }
            });
        }
        return $query->paginate(Pagination::PERPAGE);
    }

    public function sendNotifyAboutReg($request)
    {
        $student = $this->model->find($request);
        $user = $student->user;
        $isReg = $this->model->find($request)->registeredSubject->pluck('pivot')
            ->where('status', '!=', 'Registered');
        if (!$isReg->isEmpty()) {
            Mail::to($user->email)->send(new RegNotifyMail($student));
            return true;
        } else {
            return false;
        }
    }
}
