<?php

namespace app\Http\Controllers\Dashboard;

use Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Setting;
use App\Models\Student;
use Flash;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class StudentController extends Controller
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
		if (Auth::user()->can('view-student')) {
			$this->data['title']     = 'List Students ' . Setting::getSetting('site_name');
			$this->data['pageTitle'] = 'List Students';
			$this->data['pageDesc']  = 'List all Students in system';
			$this->data['students']  = Student::all();
			return view('dashboard.students.index', $this->data);
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
		if (Auth::user()->can('add-student')) {
			$this->data['title']     = 'Add Student ' . Setting::getSetting('site_name');
			$this->data['pageTitle'] = 'Add Student';
			$this->data['pageDesc']  = 'Add a New Student';
			return view('dashboard.students.create', $this->data);
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
		if (Auth::user()->can('add-student')) {
			$data      = $request->all();
			$rules     = [
				'nim'      => 'required|numeric|unique:students',
				'name'     => 'required|unique:students',
				'nickname' => 'required|unique:students',
				'phone'    => 'required|unique:students',
				'email'    => 'required|email|unique:students',
			];
			$messages  = [
				'nim.required'      => 'The NIM field is required',
				'nim.numeric'       => 'The NIM field must be a number',
				'nim.unique'        => 'The NIM has already been taken',
				'name.required'     => 'The Name field is required',
				'name.unique'       => 'The Name has already been taken',
				'nickname.required' => 'The Nickname field is required',
				'nickname.unique'   => 'The Nickname has already been taken',
				'phone.required'    => 'The Phone field is required',
				'phone.unique'      => 'The Phone has already been taken',
				'email.required'    => 'The Email field is required',
				'email.email'       => 'The Email field not valid email address',
				'email.unique'      => 'The Email has already been taken',
			];
			$validator = Validator::make($data, $rules, $messages);
			if ($validator->fails()) {
				$errors = $validator->errors()->all();
				return redirect()->back()->with('errors', $errors)->withInput($data);
			} else {
				$student           = new Student();
				$student->nim      = $data['nim'];
				$student->name     = $data['name'];
				$student->nickname = $data['nickname'];
				$student->phone    = $data['phone'];
				$student->email    = $data['email'];
				if ($student->save()) {
					Flash::success("Data has been saved!");
					return redirect()->route('students.index');
				}
				return redirect()->route('students.index');
			}
			$student = new Student();
			return redirect()->route('students.index');
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
		if (Auth::user()->can('edit-student')) {
			$student = Student::find($id);
			if ($student) {
				$this->data['title']     = 'Edit Studnet ' . $student->name . ' ' . Setting::getSetting('site_name');
				$this->data['pageTitle'] = 'Edit Student';
				$this->data['pageDesc']  = 'Edit a Student';
				$this->data['student']   = $student;
				return view('dashboard.students.edit', $this->data);
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
	 * @param  int                      $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
		if (Auth::user()->can('edit-student')) {
			$student = Student::find($id);
			if ($student) {
				$data      = $request->all();
				$rules     = [
					'nim'      => 'required|numeric|unique:students,nim,' . $student->id,
					'name'     => 'required|unique:students,name,' . $student->id,
					'nickname' => 'required|unique:students,nickname,' . $student->id,
					'phone'    => 'required|unique:students,phone,' . $student->id,
					'email'    => 'required|email|unique:students,email,' . $student->id,
				];
				$messages  = [
					'nim.required'      => 'The NIM field is required',
					'nim.numeric'       => 'The NIM field must be a number',
					'nim.unique'        => 'The NIM has already been taken',
					'name.required'     => 'The Name field is required',
					'name.unique'       => 'The Name has already been taken',
					'nickname.required' => 'The Nickname field is required',
					'nickname.unique'   => 'The Nickname has already been taken',
					'phone.required'    => 'The Phone field is required',
					'phone.unique'      => 'The Phone has already been taken',
					'email.required'    => 'The Email field is required',
					'email.email'       => 'The Email field not valid email address',
					'email.unique'      => 'The Email has already been taken',
				];
				$validator = Validator::make($data, $rules, $messages);
				if ($validator->fails()) {
					$errors = $validator->errors()->all();
					return redirect()->back()->with('errors', $errors)->withInput($data);
				} else {
					$student->nim      = $data['nim'];
					$student->name     = $data['name'];
					$student->nickname = $data['nickname'];
					$student->phone    = $data['phone'];
					$student->email    = $data['email'];
					if ($student->update()) {
						Flash::success("Data has been updated!");
						return redirect()->route('students.index');
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
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, $id)
	{
		//
		$this->data['pageTitle'] = 'List Students';
		$this->data['pageDesc']  = 'List all Students in system';
		if (Auth::user()->can('delete-student')) {
			$student = Student::find($id);
			if ($student) {
				if ($request->ajax()) {
					if ($student->delete()) {
						$this->data['students'] = Student::all();
						return view('dashboard.students.index', $this->data)->renderSections()['content'];
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
