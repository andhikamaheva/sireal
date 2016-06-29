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
use App\Models\Weight;
use Flash;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;


class WeightController extends Controller
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
        $valid = Weight::where('id', $id)->first();
        if (Auth::user()->can('weighting')) {

            if ($valid) {
                $this->data['title']     = 'Weighting ' . Setting::getSetting('site_name');
                $this->data['pageTitle'] = 'Weighting';
                $this->data['pageDesc']  = '';
                $this->data['weight']    = Weight::where('id', $id)->first();


                return view('dashboard.weights.edit', $this->data);

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
        $valid = Weight::find($id);

        if (Auth::user()->can('weighting')) {

            if ($valid) {
                $data = $request->all();
                $rules    = [
                    'tpa'       => 'required|between:1,10, numeric',
                    'audition'  => 'required|between:1,10,numeric',
                    'interview' => 'required|between:1,10,numeric',

                ];
                $messages = [
                    'tpa.required'       => 'The TPA field is required',
                    'tpa.between'        => 'The TPA value must between 0 - 10',
                    'tpa.numeric'        => 'The TPA value not valid number',
                    'audition.required'  => 'The Audition field is required',
                    'audition.between'   => 'The Audition value must between 0 - 10',
                    'audition.numeric'   => 'The Audition value not valid number',
                    'interview.required' => 'The Interview field is required',
                    'interview.between'  => 'The Interview value must between 0 - 10',
                    'interview.numeric'  => 'The Interview value not valid number',

                ];

                $validator = Validator::make($data, $rules, $messages);
                if ($validator->fails()) {
                    $errors = $validator->errors()->all();

                    return redirect()->back()->with('errors', $errors)->withInput($data);
                } else {
                    $valid->tpa       = $data['tpa'];
                    $valid->audition  = $data['audition'];
                    $valid->interview = $data['interview'];
                    if ($valid->update()) {
                        Flash::success('Data has been updated!');

                        return redirect()->route('dashboard');
                    } else {
                        Flash::error('Oopss..something went wrong. Please contact andhika@stikom.edu');

                        return redirect('dashboard');
                    }
                }


                return view('dashboard.weights.edit', $this->data);

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
