<?php

namespace App\Http\Controllers\Dashboard;

use Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Semester;
use App\Models\Setting;
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
                'status'   => 'required|numeric',
            ];
            $messages  = [
                'name.required'     => 'The Semester Name field is required',
                'name.unique'       => 'The Semester Name not exist',
                'start_at.required' => 'The Start Date field is required',
                'start_at.date'     => 'The Start Date field not valid format',
                'end_at.required'   => 'The End Date field is required',
                'end_at.date'       => 'The End Date field not valid format',
                'status.required'   => 'The Status is required',
                'status.numeric'    => 'The Status not valid format',

            ];
            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                $errors = $validator->errors()->all();

                return redirect()->back()->with('errors', $errors)->withInput($data);
            } else {
                $semester           = new Semester();
                $semester->name     = $data['name'];
                $semester->start_at = $data['start_at'];//Carbon::createFromDate('y-m-d', );
                $semester->end_at   = $data['end_at'];//Carbon::createFromDate('y-m-d', $data['end_at']);
                $semester->status   = $data['status'];
                if ($semester->save()) {
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
