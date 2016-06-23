<?php

namespace app\Http\Controllers\Dashboard;

use Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Setting;
use App\Models\User;
use Flash;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
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
        if (Auth::user()->can('view-user')) {
            $this->data['title']     = 'List Users ' . Setting::getSetting('site_name');
            $this->data['pageTitle'] = 'List Users';
            $this->data['pageDesc']  = 'List all Users in system';
            $this->data['users']     = User::all();

            return view('dashboard.users.index', $this->data);
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
        if (Auth::user()->can('add-user')) {
            $this->data['title']     = 'Create User ' . Setting::getSetting('site_name');
            $this->data['pageTitle'] = 'Create User';
            $this->data['pageDesc']  = 'Create a new User';
            $this->data['roles']     = Role::all();

            return view('dashboard.users.create', $this->data);
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
        if (Auth::user()->can('add-user')) {
            $data      = $request->all();
            $rules     = [
                'name'          => 'required|unique:users ',
                'username'      => 'required|unique:users',
                'email'         => 'required|email|unique:users',
                'user_password' => 'required',
                'roles'         => 'required',
            ];
            $messages  = [
                'name.required'          => 'User name is required',
                'name.unique'            => 'The name has already been taken',
                'username'               => 'Username is required',
                'username.unique'        => 'Username not exist',
                'email.required'         => 'Email is required',
                'email.email'            => 'Email is not valid',
                'email.unique'           => 'The name has already been taken',
                'user_password.required' => 'Password is required',
                'roles.required'         => 'User roles are required',
            ];
            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                $errors = $validator->errors()->all();

                return redirect()->back()->with('errors', $errors)->withInput($data);
            } else {
                $user           = new User();
                $user->name     = $data['name'];
                $user->username = $data['username'];
                $user->email    = $data['email'];
                $user->password = $data['user_password'];


                if ($user->save()) {
                    foreach ($data['roles'] as $role) {
                        $user->attachRole($role);
                    }
                    Alert::success('Success!', 'User has been created')->autoclose(2500);

                    return redirect()->back();
                }
            }

            return redirect()->back()->withInput($data);
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
        $user = User::find($id);
        if (Auth::user()->id == $user->id) {
            if ($user) {
                $this->data['title']     = 'Edit User ' . $user->username . ' ' . Setting::getSetting('site_name');
                $this->data['pageTitle'] = 'Edit User';
                $this->data['pageDesc']  = 'Edit a User';
                $this->data['user']      = $user;
                $this->data['roles']     = Role::all();
                $this->data['roleUser']  = RoleUser::where('user_id', '=', $user->id)->get();

                return view('dashboard.users.edit', $this->data);
            } else {
                Flash::error('Oopss..something went wrong. Data is not found. Please contact andhika@stikom.edu');

                return redirect('dashboard');
            }

        } elseif (Auth::user()->can('edit-user')) {

            if ($user) {
                $this->data['title']     = 'Edit User ' . $user->username . ' ' . Setting::getSetting('site_name');
                $this->data['pageTitle'] = 'Edit User';
                $this->data['pageDesc']  = 'Edit a User';
                $this->data['user']      = $user;
                $this->data['roles']     = Role::all();
                $this->data['roleUser']  = RoleUser::where('user_id', '=', $user->id)->get();

                return view('dashboard.users.edit', $this->data);
            } else {
                Flash::error('Oopss..something went wrong. Data is not found. Please contact andhika@stikom.edu');

                return redirect('dashboard');
            }
        } else {
            Flash::error("You don't have permissions to perform this action");

            return redirect('dashboard');
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
        $user = User::find($id);
        if (Auth::user()->id == $user->id) {
            if ($user) {
                $roleUser = RoleUser::where('user_id', '=', $user->id)->get();
                if (Auth::user()->can('edit-role')) {
                    $rules     = [
                        'name'  => 'required|unique:users,name,' . $user->id,
                        'email' => 'required|email|unique:users,email,' . $user->id,
                        'roles' => 'required',
                    ];
                    $messages  = [
                        'name.required'  => 'User name is required',
                        'name.unique'    => 'The User Name has already been taken',
                        'email.required' => 'Email is required',
                        'email.email'    => 'Email is not valid',
                        'email.unique'   => 'The User Email has already been taken',
                        'roles.required' => 'User roles is required',
                    ];
                    $data      = $request->all();
                    $validator = Validator::make($data, $rules, $messages);
                    if ($validator->fails()) {
                        $errors = $validator->errors()->all();

                        return redirect()->back()->with('errors', $errors)->withInput($data);
                    } else {
                        if ($data['user_password'] != "" || $data['user_password'] != null) {
                            $user->name          = $data['name'];
                            $user->email         = $data['email'];
                            $user->user_password = $data['user_password'];
                            if ($user->update()) {
                                $roleUser = RoleUser::where('user_id', '=', $id)->get();
                                $user->detachRoles($roleUser->pluck('role_id'));
                                $user->attachRoles($data['roles']);
                                Flash::success("Data has been updated");

                                return redirect()->route('users.index');
                            } else {
                            }
                        } else {
                            $user->name  = $data['name'];
                            $user->email = $data['email'];

                            if ($user->update()) {
                                $roleUser = RoleUser::where('user_id', '=', $id)->get();
                                $user->detachRoles($roleUser->pluck('role_id'));
                                $user->attachRoles($data['roles']);
                                Flash::success("Data has been updated");

                                return redirect()->route('users.index');
                            } else {
                                Flash::error("Oopss..something went wrong. Data is not found. Please contact andhika@stikom.edu");

                                return redirect()->back();
                            }
                        }
                    }
                } else {
                    $rules     = [
                        'name'  => 'required|unique:users,name,' . $user->id,
                        'email' => 'required|email|unique:users,email,' . $user->id,

                    ];
                    $messages  = [
                        'name.required'  => 'User name is required',
                        'name.unique'    => 'The User Name has already been taken',
                        'email.required' => 'Email is required',
                        'email.email'    => 'Email is not valid',
                        'email.unique'   => 'The User Email has already been taken',

                    ];
                    $data      = $request->all();
                    $validator = Validator::make($data, $rules, $messages);
                    if ($validator->fails()) {
                        $errors = $validator->errors()->all();

                        return redirect()->back()->with('errors', $errors)->withInput($data);
                    } else {
                        if ($data['user_password'] != "" || $data['user_password'] != null) {
                            $user->name          = $data['name'];
                            $user->email         = $data['email'];
                            $user->user_password = $data['user_password'];
                            if ($user->update()) {

                                Flash::success("Data has been updated");

                                return redirect()->route('dashboard');
                            } else {
                            }
                        } else {
                            $user->name  = $data['name'];
                            $user->email = $data['email'];

                            if ($user->update()) {

                                Flash::success("Data has been updated");

                                return redirect()->route('dashboard');
                            } else {
                                Flash::error("Oopss..something went wrong. Data is not found. Please contact andhika@stikom.edu");

                                return redirect()->back();
                            }
                        }
                    }
                }


            } else {
                Flash::success("Oopss..something went wrong. Data is not found. Please contact andhika@stikom.edu");

                return redirect()->route('dashboard');
            }
        } elseif (Auth::user()->can('edit-user')) {


            if ($user) {
                $roleUser  = RoleUser::where('user_id', '=', $user->id)->get();
                $rules     = [
                    'name'  => 'required|unique:users,name,' . $user->id,
                    'email' => 'required|email|unique:users,email,' . $user->id,
                    'roles' => 'required',
                ];
                $messages  = [
                    'name.required'  => 'User name is required',
                    'name.unique'    => 'The User Name has already been taken',
                    'email.required' => 'Email is required',
                    'email.email'    => 'Email is not valid',
                    'email.unique'   => 'The User Email has already been taken',
                    'roles.required' => 'User roles is required',
                ];
                $data      = $request->all();
                $validator = Validator::make($data, $rules, $messages);
                if ($validator->fails()) {
                    $errors = $validator->errors()->all();

                    return redirect()->back()->with('errors', $errors)->withInput($data);
                } else {
                    if ($data['user_password'] != "" || $data['user_password'] != null) {
                        $user->name          = $data['name'];
                        $user->email         = $data['email'];
                        $user->user_password = $data['user_password'];
                        if ($user->update()) {
                            $roleUser = RoleUser::where('user_id', '=', $id)->get();
                            $user->detachRoles($roleUser->pluck('role_id'));
                            $user->attachRoles($data['roles']);
                            Flash::success("Data has been updated");

                            return redirect()->route('users.index');
                        } else {
                        }
                    } else {
                        $user->name  = $data['name'];
                        $user->email = $data['email'];

                        if ($user->update()) {
                            $roleUser = RoleUser::where('user_id', '=', $id)->get();
                            $user->detachRoles($roleUser->pluck('role_id'));
                            $user->attachRoles($data['roles']);
                            Flash::success("Data has been updated");

                            return redirect()->route('users.index');
                        } else {
                            Flash::error("Oopss..something went wrong. Data is not found. Please contact andhika@stikom.edu");

                            return redirect()->back();
                        }
                    }
                }
            } else {
                Flash::success("Oopss..something went wrong. Data is not found. Please contact andhika@stikom.edu");

                return redirect()->route('dashboard');
            }
        } else {
            Flash::error("You don't have permission to perform this action");

            return redirect()->route('dashboard');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->data['pageTitle'] = 'List Users';
        $this->data['pageDesc']  = 'List all Users in system';
        if (Auth::user()->can('delete-user')) {
            $user = User::find($id);
            if ($user && $user->id != Auth::user()->id) {
                if ($request->ajax()) {
                    if ($user->delete()) {
                        $this->data['users'] = User::all();

                        return view('dashboard.users.index', $this->data)->renderSections()['content'];
                    }
                }
            } else {
                return response()->json([
                    'code'    => '401',
                    'status'  => 'failed',
                    'message' => "User not found",
                ], 401);
                Flash::error("You don't have permission to perform this action");

                return redirect()->route('dashboard');
            }
        } else {
            Flash::error("You don't have permission to perform this action");

            return response()->json([
                'code'    => '401',
                'status'  => 'failed',
                'message' => "You don't have permission to perform this action",
            ], 401);
        }
    }
}
