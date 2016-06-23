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
    public function destroy(Request $request, $id)
    {
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
                            $this->data['batches'] = Baatch::all();

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
