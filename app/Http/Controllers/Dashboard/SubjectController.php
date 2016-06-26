<?php

namespace app\Http\Controllers\Dashboard;

use Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Setting;
use App\Models\Subject;
use App\Models\User;
use App\Models\SubjectCoordinator;
use Flash;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Validator;

class SubjectController extends Controller
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
        if (Auth::user()->can('view-subject')) {
            $this->data['title']     = 'List Subjects ' . Setting::getSetting('site_name');
            $this->data['pageTitle'] = 'List Subjects';
            $this->data['pageDesc']  = 'List all Practice Subjects in system';
            $this->data['subjects']  = Subject::all();

            //$this->data['users']     = User::where('status', 1)->get();


            return view('dashboard.subjects.index', $this->data);
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
        if (Auth::user()->can('add-subject')) {
            $this->data['title']     = 'Create Practice Subject ' . Setting::getSetting('site_name');
            $this->data['pageTitle'] = 'Create Subject';
            $this->data['pageDesc']  = 'Create a new Practice Subject';
            $this->data['users']     = User::all();

            return view('dashboard.subjects.create', $this->data);
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
        if (Auth::user()->can('add-subject')) {
            $rules     = [
                'code'  => 'required|unique:subjects,code',
                'name'  => 'required|unique:subjects,name',
                'users' => 'required',
            ];
            $messages  = [
                'code.required'  => 'The Subject Code field is required',
                'code.unique'    => 'The Subject Code has already been taken',
                'name.required'  => 'The Subject Name field is required',
                'name.unique'    => 'The Subject Name has already been taken',
                'users.required' => 'The Users field is required',

            ];
            $data      = $request->all();
            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                $errors = $validator->errors()->all();

                return redirect()->back()->with('errors', $errors)->withInput($data);
            } else {
                $subject       = new Subject();
                $subject->code = Str::upper($data['code']);
                $subject->name = $data['name'];
                if ($subject->save()) {
                    $subject->coordinators()->attach($data['users']);
                    Flash::success("Data has been saved!");

                    return redirect()->route('subjects.index');
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
        if (Auth::user()->can('edit-subject')) {
            $subject = Subject::find($id);
            if ($subject) {
                $this->data['title']     = 'Edit Subject ' . $subject->name . ' ' . Setting::getSetting('site_name');
                $this->data['pageTitle'] = 'Edit Subject';
                $this->data['pageDesc']  = 'Edit a Practice Subject';
                $this->data['subject']   = $subject;
                $this->data['users']     = User::all();

                $this->data['coordinators'] = SubjectCoordinator::where('subject_id', $subject->id)->get();

                return view('dashboard.subjects.edit', $this->data);
            } else {
                Flash::error('Oopss..something went wrong. Data is not found. Please contact andhika@stikom.edu');

                return redirect('dashboard');
            }
        } else {
            Flash::error("You don't have permissions to perform this action!");

            return redirect()->route('dashboard');
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
        if (Auth::user()->can('edit-subject')) {
            $subject = Subject::find($id);
            if ($subject) {
                $data      = $request->all();
                $rules     = [
                    'code'  => 'required|unique:subjects,code,' . $subject->id,
                    'name'  => 'required|unique:subjects,name,' . $subject->id,
                    'users' => 'required',
                ];
                $messages  = [
                    'code.required'  => 'The Subject Code field is required',
                    'code.unique'    => 'The Subject Code has already been taken',
                    'name.required'  => 'The Subject Name field is required',
                    'name.unique'    => 'The Subject Name has already been taken',
                    'users.required' => 'The Users field is required',
                ];
                $validator = Validator::make($data, $rules, $messages);
                if ($validator->fails()) {
                    $errors = $validator->errors()->all();

                    return redirect()->back()->with('errors', $errors)->withInput($data);
                } else {
                    $subject->code = Str::upper($data['code']);
                    $subject->name = $data['name'];
                    if ($subject->update()) {
                        $coordinators = SubjectCoordinator::where('subject_id',
                            $subject->id)->get();
                        if ($coordinators) {
                            foreach ($coordinators as $key) {
                                $subject->coordinators()->detach($key->id);
                            }

                        }

                        $subject->coordinators()->attach($data['users']);
                        Flash::success("Data has been updated!");

                        return redirect()->route('subjects.index');
                    } else {
                        Flash::error('Oopss..something went wrong. Please contact andhika@stikom.edu');

                        return redirect('dashboard');
                    }
                }
            } else {
                Flash::error('Oopss..something went wrong. Data is not found. Please contact andhika@stikom.edu');

                return redirect('dashboard');
            }
        } else {
            Flash::error("You don't have permissions to perform this action!");

            return redirect()->route('dashboard');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        if (Auth::user()->can('delete-subject')) {
            $subject = Subject::find($id);
            if ($subject) {
                if ($request->ajax()) {
                    if ($subject->delete()) {
                        $this->data['title']     = 'List Subjects ' . Setting::getSetting('site_name');
                        $this->data['pageTitle'] = 'List Subjects';
                        $this->data['pageDesc']  = 'List all Practice Subjects in system';
                        $this->data['subjects']  = Subject::all();

                        return view('dashboard.subjects.index', $this->data)->renderSections()['content'];
                    }
                } else {
                    return response()->json([
                        'code'    => '401',
                        'status'  => 'failed',
                        'message' => "Subject not found",
                    ],
                        401);
                    Flash::error('Oopss..something went wrong. Please contact andhika@stikom.edu');

                    return redirect('dashboard');
                }
            } else {
                return response()->json([
                    'code'    => '401',
                    'status'  => 'failed',
                    'message' => "User not found",
                ], 401);
                Flash::error("You don't have permission to perform this action");

                return redirect()->route('dashboard');
            }
        } else {
            Flash::error("You don't have permission to perform this action");

            return response()->json([
                'code'    => '401',
                'status'  => 'failed',
                'message' => "You don't have permission to perform this action",
            ], 401);
        }
    }
}
