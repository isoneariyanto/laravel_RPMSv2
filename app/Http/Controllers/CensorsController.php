<?php

namespace App\Http\Controllers;
use App\Models\Censor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

class CensorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {   
            $search = $request->id;
        
            $heartbeat = Censor::search($search)->get();
            dd($heartbeat);
            // $heartbeat->paginate(5);
            // return view('censor.heartbeat', compact('heartbeat'));
    }

    public function heartbeat()
    {   
        $list = 5;
        $heartbeat = Censor::select('id','heartbeat','created_at')->paginate($list);
        return view('censor.heartbeat', compact('heartbeat'));
        // dd($request->list);
    }

    // public function heartbeatPage(Request $request)
    // {   
    //     // dd($request->pages);
    //     $list = $request->list
    //     // $heartbeat = Censor::select('id','heartbeat','created_at')->paginate($list);
    //     return redirect()->route('/heartbeatCensor', [$list]);
    //     // dd($pagValue);
    // }

    public function temperature()
    {
        $temperature = Censor::select('id','temperature','created_at')->paginate(7);
        
        return view('censor.temperature', compact('temperature'));
    }

    public function upload(){
        // $token = csrf_token();
        $id = request('id');
        $suhu = request('suhu');
        $nadi = request('nadi');
        // $query = DB::table('censors')->insert(
        //     ['id' => $id, 'temperature' => $suhu, 'heartbeat' => $nadi, 'waktu' => null]
        // );
        $query = Censor::create([
            'id' => $id,
            'temperature' => $suhu,
            'heartbeat' => $nadi
        ]);
        if($query){
            echo json_encode(array(
                'status'=>'ok'
            ));
        }
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Censor  $censor
     * @return \Illuminate\Http\Response
     */
    public function show(Censor $censor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Censor  $censor
     * @return \Illuminate\Http\Response
     */
    public function edit(Censor $censor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Censor  $censor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Censor $censor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Censor  $censor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Censor $censor)
    {
        //
    }
}
