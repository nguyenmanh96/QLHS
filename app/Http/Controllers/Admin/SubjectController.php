<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Pagination;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;
use App\Repositories\Repository\SubjectRepository;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    protected $subjectRepository;

    public function __construct(SubjectRepository $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    public function index()
    {
        $subjects = $this->subjectRepository->getAll()->paginate(Pagination::PERPAGE);

        return view('admin.subject.index', compact('subjects'));
    }

    public function store(SubjectRequest $request)
    {
        $this->subjectRepository->create([
            'name' => $request['subjectName'],
            'department_id' => $request['departmentId']
        ]);

        return redirect()->back()->with('success', __('messages.add_sub_success'));
    }


    public function edit(Request $request)
    {
        $subject = $this->subjectRepository->getById($request['id']);

        return view('admin.subject.edit', compact('subject'));
    }

    public function update(SubjectRequest $request)
    {
        $this->subjectRepository->update($request['id'], [
            'name' => $request['subjectName'],
            'department_id' => $request['departmentId'],
        ]);

        return redirect('admin/subject')->with('success', __('messages.update_ok'));
    }

    public function destroy(Request $request)
    {
        $subjectId = $request['id'];
        $isRegistered = $this->subjectRepository->filterDelete($subjectId);

        if ($isRegistered === true) {
            $this->subjectRepository->delete($request['id']);
            return redirect()->back()->with('success', __('messages.delete_ok'));
        } elseif ($isRegistered === false) {
            return redirect()->back()->with('error', __('messages.st_already_registered'));
        }
        return redirect()->back()->with('error', __('messages.sub_not_exists'));

    }
}
