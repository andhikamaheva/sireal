<?php

namespace App\Http\Controllers\Dashboard;

use Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Semester;
use App\Models\Setting;
use App\Models\User;
use Flash;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Batch;
use App\Models\BatchActivity;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->middleware('auth');
    }

    public function index()
    {
        //
        if (Auth::user()->can('view-batch')) {
            $this->data['title']     = 'List Batches ' . Setting::getSetting('site_name');
            $this->data['pageTitle'] = 'List Batches';
            $this->data['pageDesc']  = 'List all Batches';
            $this->data['batches']   = Batch::all();


            return view('dashboard.batches.index', $this->data);
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
        if (Auth::user()->can('add-batch')) {
            $this->data['title']     = 'Add Batch' . Setting::getSetting('site_name');
            $this->data['pageTitle'] = 'Add Batch';
            $this->data['pageDesc']  = 'Add a New Batch';
            $this->data['semesters'] = Semester::where('status', 1)->get();

            return view('dashboard.batches.create', $this->data);
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
        if (Auth::user()->can('add-batch')) {
            $data = $request->all();


            $rules     = [
                'semester'           => 'required|exists:semesters,id,status,1',
                'name'               => 'required|unique:batches',
                'start_at'           => 'required|date',
                'end_at'             => 'required|date|max:' . $data['start_at'],
                'status'             => 'required|in:1,0',
                'regist_start_at'    => 'required|date|after:' . $data['start_at'] . '|before:' . $data['end_at'],
                'regist_end_at'      => 'required|date|after:' . $data['start_at'] . '|before:' . $data['end_at'],
                'practice_start_at'  => 'required|date|after:' . $data['regist_end_at'] . '|before:' . $data['end_at'],
                'practice_end_at'    => 'required|date|after:' . $data['regist_end_at'] . '|before:' . $data['end_at'],
                'tpa_start_at'       => 'required|date|after:' . $data['regist_end_at'] . '|before:' . $data['end_at'],
                'tpa_end_at'         => 'required|date|after:' . $data['regist_end_at'] . '|before:' . $data['end_at'],
                'interview_start_at' => 'required|date|after:' . $data['regist_end_at'] . '|before:' . $data['end_at'],
                'interview_end_at'   => 'required|date|after:' . $data['regist_end_at'] . '|before:' . $data['end_at'],

            ];
            $messages  = [
                'semester.required'           => 'The Semester field is required',
                'semester.exists'             => 'The Semester value is no exist',
                'name.required'               => 'The Batch Name field is required',
                'name.unique'                 => 'The Batch Name already taken',
                'start_at.required'           => 'The Start Date is required',
                'start_at.date'               => 'The Start Date is not valid format',
                'end_at.required'             => 'The End Date is required',
                'end_at.date'                 => 'The End Date is not valid format',
                'status.required'             => 'The Status field is required',
                'status.in'                   => 'The Status value is not valid',
                'regist_start_at.required'    => 'The Registration Start Date is required',
                'regist_start_at.date'        => 'The Registration Start Date is not valid format',
                'regist_start_at.after'       => 'The Registration Start Date must be after Start Date',
                'regist_start_at.before'      => 'The Registration Start Date must before End Date',
                'regist_end_at.required'      => 'The Registration End Date is required',
                'regist_end_at.date'          => 'The Registration End Date is not valid format',
                'regist_end_at.after'         => 'The Registration End Date must be after Start Date',
                'regist_end_at.before'        => 'The Registration End Date must before End Date',
                'practice_start_at.required'  => 'The Practice Start Date is required',
                'practice_start_at.date'      => 'The Practice Start Date is not valid format',
                'practice_start_at.after'     => 'The Practice Start Date must be after Registration End Date',
                'practice_start_at.before'    => 'The Practice Start Date must before End Date',
                'practice_end_at.required'    => 'The Practice End Date is required',
                'practice_end_at.date'        => 'The Practice End Date is not valid format',
                'practice_end_at.after'       => 'The Practice End Date must be after Registration End Date',
                'practice_end_at.before'      => 'The Practice End Date must before End Date',
                'tpa_start_at.required'       => 'The TPA Start Date is required',
                'tpa_start_at.date'           => 'The TPA Start Date is not valid format',
                'tpa_start_at.after'          => 'The TPA Start Date must be after Registration End Date',
                'tpa_start_at.before'         => 'The TPA Start Date must before End Date',
                'tpa_end_at.required'         => 'The TPA End Date is required',
                'tpa_end_at.date'             => 'The TPA End Date is not valid format',
                'tpa_end_at.after'            => 'The TPA End Date must be after Registration End Date',
                'tpa_end_at.before'           => 'The TPA End Date must before End Date',
                'interview_start_at.required' => 'The Interview Start Date is required',
                'interview_start_at.date'     => 'The Interview Start Date is not valid format',
                'interview_start_at.after'    => 'The Interview Start Date must be after Registration End Date',
                'interview_start_at.before'   => 'The Interview Start Date must before End Date',
                'interview_end_at.required'   => 'The Interview End Date is required',
                'interview_end_at.date'       => 'The Interview End Date is not valid format',
                'interview_end_at.after'      => 'The Interview End Date must be after Registration End Date',
                'interview_end_at.before'     => 'The Interview End Date must before End Date',


            ];
            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                $errors = $validator->errors()->all();

                return redirect()->back()->with('errors', $errors)->withInput($data);
            } else {
                $batch              = new Batch();
                $batch->semester_id = $data['semester'];
                $batch->name        = $data['name'];
                $batch->start_at    = $data['start_at'];
                $batch->end_at      = $data['end_at'];
                $batch->status      = $data['status'];
                if ($batch->save()) {
                    $registration           = new BatchActivity();
                    $registration->name     = 'Registration';
                    $registration->batch_id = $batch->id;
                    $registration->start_at = $data['regist_start_at'];
                    $registration->end_at   = $data['regist_end_at'];
                    $registration->type     = 0;
                    $registration->save();

                    $practice           = new BatchActivity();
                    $practice->name     = 'Practice Test';
                    $practice->batch_id = $batch->id;
                    $practice->start_at = $data['practice_start_at'];
                    $practice->end_at   = $data['practice_end_at'];
                    $practice->type     = 1;
                    $practice->save();

                    $tpa           = new BatchActivity();
                    $tpa->name     = 'TPA';
                    $tpa->batch_id = $batch->id;
                    $tpa->start_at = $data['tpa_start_at'];
                    $tpa->end_at   = $data['tpa_end_at'];
                    $tpa->type     = 2;
                    $tpa->save();

                    $interview           = new BatchActivity();
                    $interview->name     = 'Interview';
                    $interview->batch_id = $batch->id;
                    $interview->start_at = $data['interview_start_at'];
                    $interview->end_at   = $data['interview_end_at'];
                    $interview->type     = 3;
                    $interview->save();

                    Flash::success('Data has been saved');

                    return redirect()->route('batches.index');


                } else {
                    Flash::error('Oopss..something went wrong. Data is not found. Please contact andhika@stikom.edu');

                    return redirect('dashboard');
                }
                /*  $semester           = new Semester();
                  $semester->name     = $data['name'];
                  $semester->start_at = $data['start_at'];//Carbon::createFromDate('y-m-d', );
                  $semester->end_at   = $data['end_at'];//Carbon::createFromDate('y-m-d', $data['end_at']);
                  $semester->status   = $data['status'];
                  if ($semester->save()) {
                      Flash::success("Data Semester has been saved!");

                      return redirect()->route('semesters.index');
                  }*/

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
        if (Auth::user()->can('edit-batch')) {
            $batch = Batch::find($id);
            if ($batch) {
                $this->data['title']     = 'Edit Batch ' . $batch->name . ' ' . Setting::getSetting('site_name');
                $this->data['pageTitle'] = 'Edit Batch';
                $this->data['pageDesc']  = 'Edit a Batch';
                $this->data['batch']     = $batch;
                $this->data['semesters'] = Semester::where('status', 1)->get();

                return view('dashboard.batches.edit', $this->data);
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
        if (Auth::user()->can('edit-batch')) {
            $batch = Batch::find($id);
            if ($batch) {
                $data = $request->all();

                $rules    = [
                    'semester'           => 'required|exists:semesters,id,status,1',
                    'name'               => 'required|unique:batches,name,' . $batch->id,
                    'start_at'           => 'required|date',
                    'end_at'             => 'required|date|max:' . $data['start_at'],
                    'status'             => 'required|in:1,0',
                    'regist_start_at'    => 'required|date|after:' . $data['start_at'] . '|before:' . $data['end_at'],
                    'regist_end_at'      => 'required|date|after:' . $data['start_at'] . '|before:' . $data['end_at'],
                    'practice_start_at'  => 'required|date|after:' . $data['regist_end_at'] . '|before:' . $data['end_at'],
                    'practice_end_at'    => 'required|date|after:' . $data['regist_end_at'] . '|before:' . $data['end_at'],
                    'tpa_start_at'       => 'required|date|after:' . $data['regist_end_at'] . '|before:' . $data['end_at'],
                    'tpa_end_at'         => 'required|date|after:' . $data['regist_end_at'] . '|before:' . $data['end_at'],
                    'interview_start_at' => 'required|date|after:' . $data['regist_end_at'] . '|before:' . $data['end_at'],
                    'interview_end_at'   => 'required|date|after:' . $data['regist_end_at'] . '|before:' . $data['end_at'],

                ];
                $messages = [
                    'semester.required'           => 'The Semester field is required',
                    'semester.exists'             => 'The Semester value is no exist',
                    'name.required'               => 'The Batch Name field is required',
                    'name.unique'                 => 'The Batch Name already taken',
                    'start_at.required'           => 'The Start Date is required',
                    'start_at.date'               => 'The Start Date is not valid format',
                    'end_at.required'             => 'The End Date is required',
                    'end_at.date'                 => 'The End Date is not valid format',
                    'status.required'             => 'The Status field is required',
                    'status.in'                   => 'The Status value is not valid',
                    'regist_start_at.required'    => 'The Registration Start Date is required',
                    'regist_start_at.date'        => 'The Registration Start Date is not valid format',
                    'regist_start_at.after'       => 'The Registration Start Date must be after Start Date',
                    'regist_start_at.before'      => 'The Registration Start Date must before End Date',
                    'regist_end_at.required'      => 'The Registration End Date is required',
                    'regist_end_at.date'          => 'The Registration End Date is not valid format',
                    'regist_end_at.after'         => 'The Registration End Date must be after Start Date',
                    'regist_end_at.before'        => 'The Registration End Date must before End Date',
                    'practice_start_at.required'  => 'The Practice Start Date is required',
                    'practice_start_at.date'      => 'The Practice Start Date is not valid format',
                    'practice_start_at.after'     => 'The Practice Start Date must be after Registration End Date',
                    'practice_start_at.before'    => 'The Practice Start Date must before End Date',
                    'practice_end_at.required'    => 'The Practice End Date is required',
                    'practice_end_at.date'        => 'The Practice End Date is not valid format',
                    'practice_end_at.after'       => 'The Practice End Date must be after Registration End Date',
                    'practice_end_at.before'      => 'The Practice End Date must before End Date',
                    'tpa_start_at.required'       => 'The TPA Start Date is required',
                    'tpa_start_at.date'           => 'The TPA Start Date is not valid format',
                    'tpa_start_at.after'          => 'The TPA Start Date must be after Registration End Date',
                    'tpa_start_at.before'         => 'The TPA Start Date must before End Date',
                    'tpa_end_at.required'         => 'The TPA End Date is required',
                    'tpa_end_at.date'             => 'The TPA End Date is not valid format',
                    'tpa_end_at.after'            => 'The TPA End Date must be after Registration End Date',
                    'tpa_end_at.before'           => 'The TPA End Date must before End Date',
                    'interview_start_at.required' => 'The Interview Start Date is required',
                    'interview_start_at.date'     => 'The Interview Start Date is not valid format',
                    'interview_start_at.after'    => 'The Interview Start Date must be after Registration End Date',
                    'interview_start_at.before'   => 'The Interview Start Date must before End Date',
                    'interview_end_at.required'   => 'The Interview End Date is required',
                    'interview_end_at.date'       => 'The Interview End Date is not valid format',
                    'interview_end_at.after'      => 'The Interview End Date must be after Registration End Date',
                    'interview_end_at.before'     => 'The Interview End Date must before End Date',


                ];

                $validator = Validator::make($data, $rules, $messages);
                if ($validator->fails()) {
                    $errors = $validator->errors()->all();

                    return redirect()->back()->with('errors', $errors)->withInput($data);
                } else {

                    $batch->semester_id = $data['semester'];
                    $batch->name        = $data['name'];
                    $batch->start_at    = $data['start_at'];
                    $batch->end_at      = $data['end_at'];
                    $batch->status      = $data['status'];
                    if ($batch->update()) {
                        $registration           = BatchActivity::where('batch_id', $batch->id)->where('type', 0)->first();
                        $registration->start_at = $data['regist_start_at'];
                        $registration->end_at   = $data['regist_end_at'];
                        $registration->update();

                        $practice           = BatchActivity::where('batch_id', $batch->id)->where('type', 1)->first();
                        $practice->start_at = $data['practice_start_at'];
                        $practice->end_at   = $data['practice_end_at'];
                        $practice->update();

                        $tpa           = BatchActivity::where('batch_id', $batch->id)->where('type', 2)->first();
                        $tpa->start_at = $data['tpa_start_at'];
                        $tpa->end_at   = $data['tpa_end_at'];
                        $tpa->update();

                        $interview           = BatchActivity::where('batch_id', $batch->id)->where('type', 3)->first();
                        $interview->start_at = $data['interview_start_at'];
                        $interview->end_at   = $data['interview_end_at'];
                        $interview->update();
                        
                        

                        Flash::success('Data has been updated');

                        return redirect()->route('batches.index');


                    } else {
                        Flash::success("Oopss..something went wrong. Data is not found. Please contact andhika@stikom.edu");

                        return redirect()->route('dashboard');
                    }
                }
            } else {
                Flash::error("You don't have permission to perform this action");

                return redirect()->route('dashboard');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy(
        Request $request,
        $id
    ) {
        //
        $this->data['title']     = 'List Batches ' . Setting::getSetting('site_name');
        $this->data['pageTitle'] = 'List Batches';
        $this->data['pageDesc']  = 'List all Batches';
        if (Auth::user()->can('delete-batch')) {
            if ($request->ajax()) {
                $batch = Batch::find($id);
                if ($batch) {
                    if ($batch->status == 1) {
                        return response()->json([
                            'code'    => '406',
                            'status'  => 'Not Acceptable',
                            'message' => "Batch is active, please inactive first!",
                        ], 406);
                    } else {

                        if ($batch->delete()) {

                            $this->data['batches'] = Batch::all();

                            return view('dashboard.batches.index', $this->data)->renderSections()['content'];
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
                        'message' => "Batch not exist",
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
