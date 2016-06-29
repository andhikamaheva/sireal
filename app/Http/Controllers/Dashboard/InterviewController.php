<?php

namespace App\Http\Controllers\Dashboard;

use Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\AuditionScore;
use App\Models\Oprec;
use App\Models\OprecInterview;
use App\Models\Setting;
use App\Models\SelectedSubject;
use App\Models\OprecAudition;
use Flash;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class InterviewController extends Controller
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
        if (Auth::user()->can('scores-interview')) {
            $this->data['title']     = 'List Students ' . Setting::getSetting('site_name');
            $this->data['pageTitle'] = 'List Students';
            $this->data['pageDesc']  = 'List all students';


            $this->data['oprecs'] = Oprec::with('students', 'file')->whereHas('file', function ($query) {
                $query->where('status', 1);
            })->get();


            return view('dashboard.interviews.index', $this->data);
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
        $valid = Oprec::find($id);
        if (Auth::user()->can('scores-interview')) {

            if ($valid) {
                $this->data['title']     = 'Interview Scoring ' . Setting::getSetting('site_name');
                $this->data['pageTitle'] = 'Interview Scoring ';
                $this->data['pageDesc']  = '';
                $this->data['oprec']     = Oprec::with('students')->where('oprecs.status', 1)->where('oprecs.id',
                    $id)->first();
                $this->data['scores']    = OprecInterview::where('oprec_id', $id)->first();


                return view('dashboard.interviews.edit', $this->data);

            } else {
                Flash::error("You don't have permissions to perform this action!");

                return redirect()->route('auditions.index');
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
        if (Auth::user()->can('scores-interview')) {
            $oprec = Oprec::find($id);
            if ($oprec) {
                $data      = $request->all();
                $rules     = [
                    'background'    => 'required|between:0,100, numeric',
                    'appearance'    => 'required|between:0,100,numeric',
                    'communication' => 'required|between:0,100,numeric',
                    'creativity'    => 'required|between:0,100,numeric',
                ];
                $messages  = [
                    'background.required'    => 'The Background field is required',
                    'background.between'     => 'The Background value must between 0 - 100',
                    'background.numeric'     => 'The Background value not valid number',
                    'appearance.required'    => 'The Appearance field is required',
                    'appearance.between'     => 'The Appearance value must between 0 - 100',
                    'appearance.numeric'     => 'The Appearance value not valid number',
                    'communication.required' => 'The Communication field is required',
                    'communication.between'  => 'The Communication value must between 0 - 100',
                    'communication.numeric'  => 'The Communication value not valid number',
                    'creativity.required'    => 'The Creativity field is required',
                    'creativity.between'     => 'The Creativity value must between 0 - 100',
                    'creativity.numeric'     => 'The Creativity value not valid number',
                ];
                $validator = Validator::make($data, $rules, $messages);
                if ($validator->fails()) {
                    $errors = $validator->errors()->all();

                    return redirect()->back()->with('errors', $errors)->withInput($data);
                } else {
                    $valid = OprecInterview::where('oprec_id', $id)->first();
                    if ($valid) {
                        $score     = ($data['background'] + $data['appearance'] + $data['communication'] + $data['creativity']) / 4;
                        $interview = OprecInterview::where('oprec_id',
                            $id)->update([ 'background'    => $data['background'],
                                           'appearance'    => $data['appearance'],
                                           'communication' => $data['communication'],
                                           'creativity'    => $data['creativity'],
                                           'note'          => $data['note'],
                                           'score'         => $score
                        ]);
                        Flash::success('Data has been updated!');

                        return redirect()->route('interviews.index');


                    } else {
                        $interview                = new OprecInterview();
                        $interview->background    = $data['background'];
                        $interview->appearance    = $data['appearance'];
                        $interview->communication = $data['communication'];
                        $interview->creativity    = $data['creativity'];
                        $interview->note          = $data['note'];
                        $interview->oprec_id      = $id;
                        $interview->score         = ($data['background'] + $data['appearance'] + $data['communication'] + $data['creativity']) / 4;
                        $interview->user_id       = Auth::user()->id;
                        if ($interview->save()) {
                            Flash::success('Data has been updated!');

                            return redirect()->route('interviews.index');
                        }


                    }


                }

            } else {
                Flash::error('Oopss..something went wrong. Please contact andhika@stikom.edu');

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
    }
}
