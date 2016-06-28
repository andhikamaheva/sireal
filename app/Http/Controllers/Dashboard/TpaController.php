<?php

namespace App\Http\Controllers\Dashboard;

use Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Oprec;
use App\Models\Setting;
use App\Models\SelectedSubject;
use Flash;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class TpaController extends Controller
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
        if (Auth::user()->can('scores-tpa')) {
            $this->data['title']     = 'List Students ' . Setting::getSetting('site_name');
            $this->data['pageTitle'] = 'List Students';
            $this->data['pageDesc']  = 'List all students';


            $this->data['oprecs'] = Oprec::with('students', 'file')->whereHas('file', function ($query) {
                $query->where('status', 1);
            })->get();


            return view('dashboard.tpas.index', $this->data);
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
        if (Auth::user()->can('scores-tpa')) {
            $this->data['title']     = 'TPA Scoring ' . Setting::getSetting('site_name');
            $this->data['pageTitle'] = 'TPA Scoring ';
            $this->data['pageDesc']  = '';
            $this->data['oprec']     = Oprec::with('students')->where('oprecs.status', 1)->where('oprecs.id',
                $id)->first();


            $coordinators           = Auth::user()->subjects->pluck('id');
            //dd($this->data['oprec']->selectedsubjects);
            $this->data['subjects'] = array();
            foreach ($coordinators as $key) {
                foreach ($this->data['oprec']->selectedsubjects as $newkey) {
                    if ($key == $newkey->id) {
                        array_push($this->data['subjects'], $newkey);


                    }
                }

            }
            //dd($this->data['subjects']);

            $valid = false;
            foreach ($coordinators as $key) {
                foreach ($this->data['oprec']->selectedsubjects as $newkey) {
                    if ($key == $newkey->id) {
                        $valid = true;

                        return view('dashboard.tpas.edit', $this->data);
                    }
                }

            }


            Flash::error("You don't have permissions to perform this action!");

            return redirect()->route('dashboard');
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
        if (Auth::user()->can('scores-tpa')) {
            $oprec = Oprec::find($id);
            if ($oprec) {
                $data     = $request->all();
                $rules    = [

                ];
                $messages = [

                    'score.between' => 'The Score value is not valid number format',
                    'score.numeric' => 'The Score value is not valid number format',
                ];
                foreach ($request->get('score') as $key => $val) {
                    $rules['score.' . $key]                 = 'numeric|between:0,100';
                    $messages['score.' . $key . '.numeric'] = 'The Score value is not valid number format';
                    $messages['score.' . $key . '.between'] = 'The Score value is not valid number format';

                }


                $validator = Validator::make($data, $rules, $messages);
                if ($validator->fails()) {
                    $errors = $validator->errors()->all();

                    return redirect()->back()->with('errors', $errors)->withInput($data);
                } else {
                    foreach ($data['score'] as $item) {

                        $subject_score = SelectedSubject::where('oprec_id', $id)->where('subject_id',
                            key($data['score']))->update([ 'score' => $item ]);

                        next($data['score']);
                    }

                    Flash::success("Data has been updated");

                    return redirect()->route('tpas.index');

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
