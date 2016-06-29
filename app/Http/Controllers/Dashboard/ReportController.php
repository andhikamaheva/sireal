<?php

namespace App\Http\Controllers\Dashboard;

use Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\AuditionScore;
use App\Models\Batch;
use App\Models\Oprec;
use App\Models\OprecInterview;
use App\Models\Setting;
use App\Models\SelectedSubject;
use App\Models\OprecAudition;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Weight;
use Flash;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class ReportController extends Controller
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
        if (Auth::user()->can('report')) {
            $this->data['title']     = 'Report ' . Setting::getSetting('site_name');
            $this->data['pageTitle'] = 'Report';
            $this->data['pageDesc']  = '';
            $this->data['batches']   = Batch::where('status', 1)->get();
            $this->data['subjects']  = Subject::all();


            return view('dashboard.reports.index', $this->data);
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


        if (Auth::user()->can('report')) {
            $data      = $request->all();
            $rules     = [
                'batch'   => 'required|numeric',
                'subject' => 'required|numeric',

            ];
            $messages  = [
                'batch.required'   => 'The Batch field is required',
                'batch.numeric'    => 'The Batch value not valid format',
                'subject.required' => 'The Subject field is required',
                'subject.numeric'  => 'The Subject value not valid format',

            ];
            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                $errors = $validator->errors()->all();

                return redirect()->back()->with('errors', $errors)->withInput($data);
            } else {
                //Weighting
                $weight = Weight::first();
                $w1     = $weight->tpa / ($weight->tpa + $weight->audition + $weight->interview);

                $w2 = $weight->audition / ($weight->tpa + $weight->audition + $weight->interview);
                $w3 = $weight->interview / ($weight->tpa + $weight->audition + $weight->interview);

                //Vektor S
                $subjects = SelectedSubject::where('subject_id', $data['subject'])->get();
                $vektorS  = array();
                $vektorV  = array();
                $total    = 0;
                foreach ($subjects as $subject) {
                    $tpa = $subject->score;
                    //dd($w1);
                    $audition  = OprecAudition::where('oprec_id', $subject->oprec_id)->sum('score') / 2;
                    $interview = OprecInterview::where('oprec_id', $subject->oprec_id)->first();
                    $student   = Oprec::find($subject->oprec_id);
                    $student   = Student::find($student->student_id);
                    $vekS      = pow($tpa, $w1) * pow($audition, $w2) * pow($interview->score, $w3);
                    $total += $vekS;
                    $name  = Subject::find($subject->subject_id);
                    $final = array( 'nim'     => $student->nim,
                                    'name'    => $student->name,
                                    'subject' => $name->name,
                                    'vektorS' => $vekS
                    );
                    array_push($vektorS, $final);


                }


                foreach ($vektorS as $key) {
                    $vekV  = $key['vektorS'] / $total;
                    $final = array(
                        'nim'     => $key['nim'],
                        'name'    => $key['name'],
                        'subject' => $key['subject'],
                        'score'   => $vekV
                    );
                    array_push($vektorV, $final);
                }

                $name                  = Subject::find($subject->subject_id);
                $this->data['subject'] = $name->name;



                $this->data['students'] = $vektorV;
                

                //dd($this->data['students']);


                return view('dashboard.reports.export', $this->data);

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
    }
}
