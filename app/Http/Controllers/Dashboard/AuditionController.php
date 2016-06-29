<?php

namespace App\Http\Controllers\Dashboard;

use Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\AuditionScore;
use App\Models\Oprec;
use App\Models\Setting;
use App\Models\SelectedSubject;
use App\Models\OprecAudition;
use Flash;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuditionController extends Controller
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
        if (Auth::user()->can('scores-audition')) {
            $this->data['title']     = 'List Students ' . Setting::getSetting('site_name');
            $this->data['pageTitle'] = 'List Students';
            $this->data['pageDesc']  = 'List all students';


            $this->data['oprecs'] = Oprec::with('students', 'file')->whereHas('file', function ($query) {
                $query->where('status', 1);
            })->get();


            return view('dashboard.auditions.index', $this->data);
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

        $validA = OprecAudition::where('oprec_id', $id)->count();
        $validB = OprecAudition::where('oprec_id', $id)->where('user_id', Auth::user()->id)->first();


        if (Auth::user()->can('scores-audition')) {

            if ($validA <= 2) {
                $this->data['title']     = 'Audition Scoring ' . Setting::getSetting('site_name');
                $this->data['pageTitle'] = 'Audition Scoring ';
                $this->data['pageDesc']  = '';
                $this->data['oprec']     = Oprec::with('students')->where('oprecs.status', 1)->where('oprecs.id',
                    $id)->first();
                $this->data['scores']    = OprecAudition::with('auditionscores')->where('oprec_id',
                    $id)->where('user_id', Auth::user()->id)->first();
                //dd($this->data['scores']->auditionscores[0]->id);
                // dd($this->data['scores']);

                //dd($this->data['oprec']->file);


                return view('dashboard.auditions.edit', $this->data);

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
        if (Auth::user()->can('scores-audition')) {
            $oprec = Oprec::find($id);
            if ($oprec) {
                $data      = $request->all();
                $rules     = [
                    'skill'         => 'required|between:0,100, numeric',
                    'appearance'    => 'required|between:0,100,numeric',
                    'communication' => 'required|between:0,100,numeric',
                    'improvisation' => 'required|between:0,100,numeric',
                ];
                $messages  = [
                    'skill.required'         => 'The Skill field is required',
                    'skill.between'          => 'The Skill value must between 0 - 100',
                    'skill.numeric'          => 'The Skill value not valid number',
                    'appearance.required'    => 'The Appearance field is required',
                    'appearance.between'     => 'The Appearance value must between 0 - 100',
                    'appearance.numeric'     => 'The Appearance value not valid number',
                    'communication.required' => 'The Communication field is required',
                    'communication.between'  => 'The Communication value must between 0 - 100',
                    'communication.numeric'  => 'The Communication value not valid number',
                    'improvisation.required' => 'The Improvisation field is required',
                    'improvisation.between'  => 'The Improvisation value must between 0 - 100',
                    'improvisation.numeric'  => 'The Improvisation value not valid number',
                ];
                $validator = Validator::make($data, $rules, $messages);
                if ($validator->fails()) {
                    $errors = $validator->errors()->all();

                    return redirect()->back()->with('errors', $errors)->withInput($data);
                } else {
                    $valid = OprecAudition::where('oprec_id', $id)->where('user_id', Auth::user()->id)->first();
                    if (!$valid) {

                        $audition           = new OprecAudition();
                        $audition->oprec_id = $id;
                        $audition->user_id  = Auth::user()->id;
                        if ($audition->save()) {
                            $score                    = new AuditionScore();
                            $score->skill             = $data['skill'];
                            $score->appearance        = $data['appearance'];
                            $score->communication     = $data['communication'];
                            $score->improvisation     = $data['improvisation'];
                            $score->note              = $data['note'];
                            $score->oprec_audition_id = $audition->id;
                            if ($score->save()) {
                                $audition->score = ($score->skill+$score->appearance+$score->communication+$score->improvisation)/4;
                                if($audition->save()){
                                    Flash::success('Data has been updated!');

                                    return redirect()->route('auditions.index');
                                } else {
                                    Flash::error('Oopss..something went wrong. Please contact andhika@stikom.edu');

                                    return redirect('dashboard');
                                }

                            } else {
                                Flash::error('Oopss..something went wrong. Please contact andhika@stikom.edu');

                                return redirect('dashboard');
                            }

                        } else {
                            Flash::error('Oopss..something went wrong. Please contact andhika@stikom.edu');

                            return redirect('dashboard');
                        }
                    } else {
                        $score = AuditionScore::where('oprec_audition_id', $valid->id)->update([ 'skill' => $data['skill'], 'appearance' => $data['appearance'],
                        'communication' => $data['communication'], 'improvisation' => $data['improvisation'], 'note' => $data['note']]);
                        $audition = OprecAudition::find($valid->id);
                        $audition->score = ($data['skill']+$data['appearance']+$data['communication']+$data['improvisation'])/4;
                        if($audition->update()){
                            Flash::success('Data has been updated!');

                            return redirect()->route('auditions.index');
                        } else {
                            Flash::error('Oopss..something went wrong. Please contact andhika@stikom.edu');

                            return redirect('dashboard');
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
