<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::all();
        return view('patient.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patient.create');
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
        // $patient = new Patient;
        // $patient->full_name = $request->name;
        // $patient->placeofbirth = $request->placeofbirth;
        // $patient->dateofbirth = $request->dateofbirth;
        // $patient->address = $request->address;
        // $patient->country = $request->company;
        // $patient->job = $request->job;
        // $patient->save();


        //insert cara 3 setelah tambah fillable/guarded di model
        // Patient::create($request->all());
        
        //validasi
        $request->validate([
            'first_name' => 'required|min:2',
            'placeofbirth' => 'required',
            'dateofbirth' => 'required',
            'address' => 'required',
            'country' => 'required',
            'job' => 'required'
        ]);

        //insert data cara 2, tambahkan juga fillable/guarded di modelnya
        Patient::create([
            'first_name' => Str::ucfirst($request->first_name),
            'last_name' => Str::ucfirst($request->last_name),
            'placeofbirth' => Str::ucfirst($request->placeofbirth),
            'dateofbirth' => $request->dateofbirth,
            'address' => Str::title($request->address),
            'country' => Str::ucfirst($request->country),
            'job' => Str::ucfirst($request->job)
        ]);

        return redirect('/patients');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        return view('patient.detail', compact('patient'));
        // return $patient;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        return view('patient.edit', compact('patient')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'first_name' => 'required|min:3',
            // 'last_name' => 'required',
            'placeofbirth' => 'required',
            'dateofbirth' => 'required',
            'address' => 'required',
            'country' => 'required',
            'job' => 'required'
        ]);
        
        Patient::where('id_patient', $patient->id_patient)
                    ->update([
                        'first_name' => Str::ucfirst($request->first_name),
                        'last_name' => Str::ucfirst($request->last_name),
                        'placeofbirth' => Str::ucfirst($request->placeofbirth),
                        'dateofbirth' => $request->dateofbirth,
                        'address' => Str::title($request->address),
                        'country' => Str::ucfirst($request->country),
                        'job' => Str::ucfirst($request->job)
                    ]);
        return redirect('/patients');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        Patient::destroy($patient->id_patient);
        return redirect('/patients');
    }
}
