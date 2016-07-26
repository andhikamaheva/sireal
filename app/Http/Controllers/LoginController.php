<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Flash;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Validator;

class LoginController extends Controller
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
        return view('login');
    }

    public function auth(Request $request)
    {
        $rules     = [
            'username'      => 'required',
            'user_password' => 'required',
        ];
        $messages  = [
            'username.required'      => 'Nama Pengguna harus diisi',
            'user_password.required' => 'Kata Sandi harus diisi',
        ];
        $data      = $request->all();
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return redirect()->back()->with('errors', $errors);
        } else {
            if (isset($data['remember'])) {
                if ($this->auth->attempt([
                    'username' => $data['username'],
                    'password' => $data['user_password'],
                ], true)
                ) {
                    $user = $this->auth->user();
                    return redirect('dashboard');
                } else {
                    Flash::error('Nama pengguna atau kata sandi Anda salah. Silahkan coba kembali');
                    return redirect()->back()->withInput($data);
                }
            } else {
                if ($this->auth->attempt([
                    'username' => $data['username'],
                    'password' => $data['user_password'],
                ])
                ) {
                    $user = $this->auth->user();
                    return redirect('dashboard');
                } else {
                    Flash::error('Nama pengguna atau kata sandi Anda salah. Silahkan coba kembali');
                    return redirect()->back()->withInput($data);
                }
            }
        }
    }

    public function logout()
    {
        $this->auth->logout();
        return redirect('dashboard');
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
    public function destroy($id)
    {
        //
    }
}
