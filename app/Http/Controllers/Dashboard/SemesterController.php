<?php

namespace App\Http\Controllers\Dashboard;

use Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Semester;
use App\Models\Setting;
use App\Models\Subject;
use App\Models\SemesterSubject;
use Flash;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;


class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function index()
    {
        //

        if (Auth::user()->can('view-semester')) {
            $this->data['title']     = 'List Semesters ' . Setting::getSetting('site_name');
            $this->data['pageTitle'] = 'List Semesters';
            $this->data['pageDesc']  = 'List all Semesters in system';
            $this->data['semesters'] = Semester::all();

            return view('dashboard.semesters.index', $this->data);

        } else {
            Flash::error("You don't have permissions to perform this action!");

            return redirect()->route('dashboard');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (Auth::user()->can('add-semester')) {
            $this->data['title']     = 'Create Semester ' . Setting::getSetting('site_name');
            $this->data['pageTitle'] = 'Create Semester';
            $this->data['pageDesc']  = 'Create a new Semester';
            $this->data['subjects']  = Subject::all();

            return view('dashboard.semesters.create', $this->data);
        } else {
            Flash::error("You don't have permissions to perform this action!");

            return redirect()->route('dashboard');
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if (Auth::user()->can('add-semester')) {
            $data      = $request->all();
            $rules     = [
                'name'     => 'required|unique:semesters',
                'start_at' => 'required|date',
                'end_at'   => 'required|date',
                'status'   => 'required|in:1,0',
                'subjects' => 'required',
            ];
            $messages  = [
                'name.required'     => 'The Semester Name field is required',
                'name.unique'       => 'The Semester Name not exist',
                'start_at.required' => 'The Start Date field is required',
                'start_at.date'     => 'The Start Date field not valid format',
                'end_at.required'   => 'The End Date field is required',
                'end_at.date'       => 'The End Date field not valid format',
                'status.required'   => 'The Status is required',
                'status.in'         => 'The Status value is not valid',
                'subjects.required' => 'The Subjects field is required',

            ];
            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                $errors = $validator->errors()->all();

                return redirect()->back()->with('errors', $errors)->withInput($data);
            } else {
                $semester           = new Semester();
                $semester->name     = $data['name'];
                $semester->start_at = $data['start_at'];
                $semester->end_at   = $data['end_at'];
                $semester->status   = $data['status'];
                if ($semester->save()) {
                    $semester->subjects()->attach($data['subjects']);

                    Flash::success("Data Semester has been saved!");

                    return redirect()->route('semesters.index');
                }

            }
        } else {
            Flash::error("You don't have permissions to perform this action!");

            return redirect()->route('dashboard');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if (Auth::user()->can('edit-semester')) {
            $semester = Semester::find($id);
            if ($semester) {
                $this->data['title']             = 'Edit Semester ' . $semester->username . ' ' . Setting::getSetting('site_name');
                $this->data['pageTitle']         = 'Edit Semester';
                $this->data['pageDesc']          = 'Edit a Semester';
                $this->data['semester']          = $semester;
                $this->data['subjects']          = Subject::all();
                $this->data['semester_subjects'] = SemesterSubject::where('semester_id', $semester->id)->get();


                return view('dashboard.semesters.edit', $this->data);
            } else {
                Flash::error('Oopss..something went wrong. Data is not found. Please contact andhika@stikom.edu');

                return redirect('dashboard');
            }
        } else {
            Flash::error("You don't have permissions to perform this action");

            return redirect('dashboard');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if (Auth::user()->can('edit-semester')) {
            $semester = Semester::find($id);
            if ($semester) {
                $data = $request->all();

                $rules     = [
                    'name'     => 'required|unique:semesters,name,' . $semester->id,
                    'start_at' => 'required|date',
                    'end_at'   => 'required|date',
                    'status'   => 'required|in:1,0',
                    'subjects' => 'required'
                ];
                $messages  = [
                    'name.required'     => 'The Name field is required',
                    'name.unique'       => 'The Semester Name has already been taken',
                    'start_at.required' => 'The Start Date field is required',
                    'start_at.date'     => 'The Start Date is not valid format',
                    'end_et.required'   => 'The End Date field is required',
                    'end_et.date'       => 'The End Date is not valid format',
                    'status.required'   => 'The Status field is required',
                    'status.in'         => 'The Status value not valid',
                    'subjects.required' => 'The Subjects field is required',
                ];
                $validator = Validator::make($data, $rules, $messages);
                if ($validator->fails()) {
                    $errors = $validator->errors()->all();

                    return redirect()->back()->with('errors', $errors)->withInput($data);
                } else {
                    $semester->name     = $data['name'];
                    $semester->start_at = $data['start_at'];
                    $semester->end_at   = $data['end_at'];
                    $semester->status   = $data['status'];
                    if ($semester->update()) {
                        $semester_subjects = SemesterSubject::where('semester_id',
                            $semester->id)->get();
                        foreach ($semester_subjects as $key) {
                            $semester->subjects()->detach($key->id);
                        }
                        $semester->subjects()->attach($data['subjects']);
                        Flash::success("Data has been updated");

                        return redirect()->route('semesters.index');

                    } else {
                        Flash::error('Oopss..something went wrong. Please contact andhika@stikom.edu');

                        return redirect('dashboard');
                    }

                }

            } else {
                Flash::success("Oopss..something went wrong. Data is not found. Please contact andhika@stikom.edu");

                return redirect()->route('dashboard');
            }

        } else {
            Flash::error("You don't have permission to perform this action");

            return redirect()->route('dashboard');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $this->data['title']     = 'List Semesters ' . Setting::getSetting('site_name');
        $this->data['pageTitle'] = 'List Semesters';
        $this->data['pageDesc']  = 'List all Semesters';
        if (Auth::user()->can('delete-semester')) {
            if ($request->ajax()) {
                $semester = Semester::find($id);
                if ($semester) {
                    if ($semester->status == 1) {
                        return response()->json([
                            'code'    => '406',
                            'status'  => 'Not Acceptable',
                            'message' => "Semester is active, please inactive first!",
                        ], 406);
                    } else {

                        if ($semester->delete()) {

                            $this->data['semesters'] = Semester::all();

                            return view('dashboard.semesters.index', $this->data)->renderSections()['content'];
                        } else {
                            return response()->json([
                                'code'    => '501',
                                'status'  => 'Not Implemented',
                                'message' => "Oopps..there is something went wrong, please contact andhika@stikom.edu",
                            ], 501);

                        }

                    }
                } else {
                    return response()->json([
                        'code'    => '204',
                        'status'  => 'No Content',
                        'message' => "Semester not exist",
                    ], 204);
                }

            } else {
                Flash::error("You don't have permission to perform this action");

                return redirect()->route('dashboard');
            }
        } else {
            Flash::error("You don't have permission to perform this action");

            return redirect()->route('dashboard');
        }
    }
}
