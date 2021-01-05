<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees  =  Employee::all();
        // $employees = $emp->join('users', 'users.id', '=', 'employees.user_id');
        return view('user.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //insert cara 1
        // $user = new PersonalUser;
        // $user->username = $request->username;
        // $user->pass = $request->pass;
        // $user->first_name = $request->first_name;
        // $user->last_name = $request->last_name;
        // $user->email = $request->email;
        // $user->placeofbirth = $request->placeofbirth;
        // $user->dateofbirth = $request->dateofbirth;
        // $user->address = $request->address;
        // $user->company = $request->company;
        // $user->job = $request->job;
        // $user->level = $request->level;
        // $user->save();


        //insert cara 3 setelah tambah fillable/guarded di model
        // User::create($request->all());
        
        //validasi
        $request->validate([
            'username' => 'required|min:6',
            // 'password' => 'required|min:8',
            'first_name' => 'required|min:2',
            'email' => 'required|email',
            'placeofbirth' => 'required',
            'dateofbirth' => 'required',
            'address' => 'required',
            'company' => 'required',
            'job' => 'required',
            'level' => 'required'
        ]);

        $usr = User::create([
            'level' => Str::ucfirst($request->level),
            'name' => Str::ucfirst($request->first_name),
            'email' => $request->email,
            'password' => bcrypt("test1234"),
            'remember_token' => Str::random(60)
        ]);

        //insert data cara 2, tambahkan juga fillable/guarded di modelnya
        $emp = Employee::create([
            'user_id' => $usr->id,
            'username' => $request->username,
            // 'password' => Crypt::encryptString($request->password),
            'first_name' => Str::ucfirst($request->first_name),
            'last_name' => Str::ucfirst($request->last_name),
            // 'email' => $request->email,
            'placeofbirth' => Str::ucfirst($request->placeofbirth),
            'dateofbirth' => $request->dateofbirth,
            'address' => Str::upper($request->address),
            'company' => Str::title($request->company),
            'job' => Str::ucfirst($request->job)
            // 'level' => Str::ucfirst($request->level)
        ]);


        return redirect('/employees');
        // return dd($emp);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {   
        return view('user.detail', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    // public function decryptpassword(Employee $employee){
    //     Employee::where('id', $employee->id)
    //                 ->update([ 'password' => Crypt::decryptString($employee->password) ]);

    //     return redirect('employees/'.$employee->id_staff.'/edit');
    // }

    public function edit(Employee $employee)
    {
        return view('user.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'username' => 'required|min:6',
            // 'password' => 'required|min:8',
            'first_name' => 'required|min:2',
            'email' => 'required|email',
            'placeofbirth' => 'required',
            'dateofbirth' => 'required',
            'address' => 'required',
            'company' => 'required',
            'job' => 'required',
            'level' => 'required'
        ]);
        // if (Hash::needsRehash($user->password)) {
        //     $hashed = Hash::make($request->pass);
        //     User::where('id', $user->id)
        //             ->update([
        //                 'level' => Str::ucfirst($request->level),
        //                 'name' => Str::ucfirst($request->first_name),
        //                 'email' => $request->email,
        //                 'password' => $hashed,
        //                 'remember_token' => Str::random(60)
        //             ]);
        // }
        // $usr = User::select('password')->where('id', $employee->id)->get();
        // dd($usr);
        // dd($request->pass);
        // if (Hash::check($)) {
        //     # code...
        // }

        // if ($usr === $request->pass) {
        //     echo "tidak ada perubahan";
        // }echo "lakukan hash";

        
        User::where('id', $employee->user_id)
                    ->update([
                        'level' => Str::ucfirst($request->level),
                        'name' => Str::ucfirst($request->first_name),
                        'email' => $request->email,
                        'password' => $request->pass,
                        'remember_token' => Str::random(60)
                    ]);
        Employee::where('id', $employee->id)
                    ->update([
                        'username' => $request->username,
                        // 'password' => Crypt::encryptString($request->password),
                        'first_name' => Str::ucfirst($request->first_name),
                        'last_name' => Str::ucfirst($request->last_name),
                        // 'email' => $request->email,
                        'placeofbirth' => Str::ucfirst($request->placeofbirth),
                        'dateofbirth' => $request->dateofbirth,
                        'address' => Str::upper($request->address),
                        'company' => Str::title($request->company),
                        'job' => Str::ucfirst($request->job)
                    ]);

        return redirect('/employees');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        Employee::destroy($employee->id);
        User::destroy($employee->user_id);
        return redirect('/employees');
    }
}
