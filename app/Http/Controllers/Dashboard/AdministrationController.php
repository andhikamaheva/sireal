<?php

namespace App\Http\Controllers\Dashboard;

use Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Oprec;
use App\Models\Setting;
use Flash;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;


class AdministrationController extends Controller
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
        if (Auth::user()->can('scores-administration')) {
            $this->data['title']     = 'List Students ' . Setting::getSetting('site_name');
            $this->data['pageTitle'] = 'List Students';
            $this->data['pageDesc']  = 'List all students';
            $this->data['oprecs']    = Oprec::with('students')->where('oprecs.status', 1)->get();





            return view('dashboard.administrations.index', $this->data);
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
        if (Auth::user()->can('scores-administration')) {
            $this->data['title']     = 'Administration Scoring ' . Setting::getSetting('site_name');
            $this->data['pageTitle'] = 'Administration Scoring ';
            $this->data['pageDesc']  = '';
            $this->data['oprec']     = Oprec::with('students')->where('oprecs.status', 1)->where('oprecs.id',
                $id)->first();

            //dd($this->data['oprec']->file);


            return view('dashboard.administrations.edit', $this->data);
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
        if (Auth::user()->can('scores-administration')) {
            $oprec = Oprec::find($id);
            if ($oprec) {
                $data      = $request->all();
                $rules     = [
                    'status' => 'required|in:1,0'
                ];
                $messages  = [
                    'status.required' => 'Status is required',
                    'status.in'       => 'Status value is not valid',
                ];
                $validator = Validator::make($data, $rules, $messages);
                if ($validator->fails()) {
                    $errors = $validator->errors()->all();

                    return redirect()->back()->with('errors', $errors)->withInput($data);
                } else {
                    $oprec->file->status = $data['status'];
                    if ($oprec->file->update()) {
                        Flash::success("Data has been updated");

                        return redirect()->route('administrations.index');
                    } else {
                        Flash::error('Oopss..something went wrong. Please contact andhika@stikom.edu');

                        return redirect('dashboard');
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
