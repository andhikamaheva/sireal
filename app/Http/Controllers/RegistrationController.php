<?php

namespace App\Http\Controllers;

use Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Setting;
use App\Models\Oprec;
use App\Models\File;
use App\Models\Student;
use App\Models\Subject;
use Flash;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $this->data['subjects'] = Subject::all();

        return view('index', $this->data);
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
        $data = $request->all();

        $rules     = [
            'nim' => 'required|exists:students,nim,nim,' . $data['nim'],
        ];
        $messages  = [
            'nim.required' => 'NIM harus diisi'
        ];
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->fails()) {
            Alert::error('Data tidak valid, silahkan hubungi admin');

            return redirect()->route('registration.index');
        } else {
            $rules = [
                'ktp'        => 'required|mimes:jpg,png',
                'photo'      => 'required|mimes:jpg,png',
                'app_letter' => 'required|mimes:pdf',
                'cv'         => 'required|mimes:pdf',
                'transcript' => 'required|mimes:pdf',
                'subjects'   => 'required'
            ];

            $messages = [
                'ktp.required'        => 'KTP wajib disertakan',
                'photo.required'      => 'CV wajib disertakan',
                'app_letter.required' => 'Surat Lamaran wajib disertakan',
                'cv.required'         => 'CV wajib disertakan',
                'transcript.required' => 'Transkrip wajib disertakan',
                'subjecst.required'   => 'Mata Kuliah wajib diisi',

                'ktp.mimes'        => 'Format KTP salah',
                'photo.mimes'      => 'Format CV salah',
                'app_letter.mimes' => 'Format Surat Lamaran salah',
                'cv.mimes'         => 'Format CV salah',
                'transcript.mimes' => 'Format Transkrip salah',
            ];

            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                $errors = $validator->errors()->all();

                return redirect()->back()->with('errors', $errors);
            } else {
                $student           = Student::where('nim', $data['nim'])->get();
                $oprec             = new Oprec();
                $oprec->batch_id   = 6;
                $oprec->student_id = $student[0]->id;
                if ($oprec->save()) {

                    $destinationPath = 'upload';
                    $extension       = $request->file('ktp')->getClientOriginalExtension();
                    $filename        = $student[0]->nim . '-ktp.' . $extension;
                    $ktp             = $filename;
                    $upload          = $request->file('ktp')->move($destinationPath, $filename);


                    $extension = $request->file('cv')->getClientOriginalExtension();
                    $filename  = $student[0]->nim . '-cv.' . $extension;
                    $cv        = $filename;
                    $upload    = $request->file('cv')->move($destinationPath, $filename);

                    $extension = $request->file('app_letter')->getClientOriginalExtension();
                    $filename  = $student[0]->nim . '-app.' . $extension;
                    $app       = $filename;
                    $upload    = $request->file('app_letter')->move($destinationPath, $filename);

                    $extension = $request->file('transcript')->getClientOriginalExtension();
                    $filename  = $student[0]->nim . '-transkrip.' . $extension;
                    $transkrip = $filename;
                    $upload    = $request->file('transcript')->move($destinationPath, $filename);

                    $extension = $request->file('photo')->getClientOriginalExtension();
                    $filename  = $student[0]->nim . '-photo.' . $extension;
                    $photo     = $filename;
                    $upload    = $request->file('photo')->move($destinationPath, $filename);

                    $oprec->selectedsubject()->attach($data['subjects']);

                    $file             = new File();
                    $file->ktp        = $ktp;
                    $file->cv         = $cv;
                    $file->app_letter = $app;
                    $file->transcript = $transkrip;
                    $file->photo      = $photo;
                    if ($file->save()) {
                        $oprec->file_id = $file->id;
                        if ($oprec->update()) {
                            Alert::success('Pendaftaran Berhasil!');

                            return redirect()->back();
                        }
                    }

                }
            }

        }


        /*$validator = Validator::make($data, $rules, $messages);
        if ($validator->fails()) {

        } else {

        }*/
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
