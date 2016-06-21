<?php

namespace app\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Flash;
use Alert;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\PermissionRole;
use App\Models\Permission;
use App\Models\Setting;
use Illuminate\Support\Str;
use Validator;

class RoleController extends Controller
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
        if (Auth::user()->can('view-role')) {
            $this->data['title']         = 'List Roles '.Setting::getSetting('site_name');
            $this->data['pageTitle']     = 'List Roles';
            $this->data['pageDesc']      = 'List all Roles in system';
            $this->data['roles']         = Role::all();
            return view('dashboard.roles.index', $this->data);
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
        if (Auth::user()->can('add-role')) {
            $this->data['title']           = 'Create Role '.Setting::getSetting('site_name');
            $this->data['pageTitle']       = 'Create Role';
            $this->data['pageDesc']        = 'Create a new Role';
            $this->data['permissions']     = Permission::all();
            return view('dashboard.roles.create', $this->data);
        } else {
            Flash::error("You don't have permissions to perform this action!");
            return redirect()->route('dashboard');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if (Auth::user()->can('add-role')) {
            $data  = $request->all();
            $rules = [
          'name'             => 'required|unique:roles',
          'display_name'     => 'required|unique:roles',
          'permissions'      => 'required',
          'description'      => 'required',
            ];
            $messages = [
             'name.required'                  => 'Role Name is required',
             'name.unique'                    => 'Role Name not exist',
             'display_name.required'          => 'Display Name is required',
             'display_name.unique'            => 'Display Name not exist',
             'permissions.required'           => 'Permissions are required',
             'description.required'           => 'Description is required',
            ];
            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                return redirect()->back()->with("errors", $errors)->withInput($data);
            } else {
                $role               = new Role();
                $role->name         = Str::slug($data['name']);
                $role->display_name = $data['display_name'];
                $role->description  = $data['description'];
                if ($role->save()) {
                    $role->attachPermissions($data['permissions']);
                    Flash::success("Data has been saved!");
                    return redirect()->route('roles.index');
                } else {
                    Flash::error('Oopss..something went wrong. Please contact andhika@stikom.edu');
                    return redirect('dashboard');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if (Auth::user()->can('edit-role')) {
            $role = Role::find($id);
            if ($role) {
                $this->data['title']                 = 'Edit Role '.$role->display_name.' '.Setting::getSetting('site_name');
                $this->data['pageTitle']             = 'Edit Role';
                $this->data['pageDesc']              = 'Edit a Role';
                $this->data['role']                  = $role;
                $this->data['permissions']           = Permission::all();
                $this->data['permissionRole']        = PermissionRole::where('role_id', '=', $role->id)->get();
                return view('dashboard.roles.edit', $this->data);
            } else {
                Flash::error('Oopss..something went wrong. Data is not found. Please contact andhika@stikom.edu');
                return redirect('dashboard');
            }
        } else {
            Flash::error("You don't have permissions to perform this action!");
            return redirect()->route('dashboard');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if (Auth::user()->can('edit-role')) {
            $role = Role::find($id);
            if ($role) {
                $data  = $request->all();
                $rules = [
              'name'             => 'required|unique:roles,name,'.$role->id,
              'display_name'     => 'required|unique:roles,display_name,'.$role->id,
              'permissions'      => 'required',
              'description'      => 'required',
             ];
                $messages = [
              'name.required'                  => 'Role Name is required',
              'name.unique'                    => 'Role Name not exist',
              'display_name.required'          => 'Display Name is required',
              'display_name.unique'            => 'Display Name not exist',
              'permissions.required'           => 'Permissions are required',
              'description.required'           => 'Description is required',
             ];
                $validator = Validator::make($data, $rules, $messages);
                if ($validator->fails()) {
                    $errors = $validator->errors()->all();
                    return redirect()->back()->with('errors', $errors)->withInput($data);
                } else {
                    $role->name         = Str::slug($data['name']);
                    $role->display_name = $data['display_name'];
                    $role->description  = $data['description'];
                    if ($role->update()) {
                        $permissionRole = PermissionRole::where('role_id', '=', $role->id)->get();
                        $role->detachPermissions($permissionRole->pluck('permission_id'));
                        $role->attachPermissions($data['permissions']);
                        Flash::success("Data has been updated!");
                        return redirect()->route('roles.index');
                    } else {
                        Flash::error('Oopss..something went wrong. Please contact andhika@stikom.edu');
                        return redirect('dashboard');
                    }
                }
            } else {
                Flash::error('Oopss..something went wrong. Data is not found. Please contact andhika@stikom.edu');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        if (Auth::user()->can('delete-role')) {
            $role = Role::find($id);
            if ($role) {
                if ($request->ajax()) {
                    if ($role->delete()) {
                        $role->users()->sync([]);
                        $role->perms()->sync([]);
                        $role->forceDelete();
                        $this->data['title']         = 'List Roles '.Setting::getSetting('site_name');
                        $this->data['pageTitle']     = 'List Roles';
                        $this->data['pageDesc']      = 'List all Roles in system';
                        $this->data['roles']         = Role::all();
                        return view('dashboard.roles.index', $this->data)->renderSections()['content'];
                    } else {
                        Flash::error('Oopss..something went wrong. Please contact andhika@stikom.edu');
                        return redirect()->route('dashboard.index');
                    }
                } else {
                    return response()->json(['code' => '401', 'status' => 'failed', 'message' => "Role not found" ], 401);
                }
            } else {
                Flash::error('Oopss..something went wrong. Data is not found. Please contact andhika@stikom.edu');
                return redirect('dashboard');
            }
        } else {
            Flash::error("You don't have permissions to perform this action!");
            return redirect()->route('dashboard');
        }
    }
}
