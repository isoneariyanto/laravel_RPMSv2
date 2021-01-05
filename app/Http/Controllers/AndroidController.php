<?php

namespace App\Http\Controllers;

use App\Models\Censor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AndroidController extends Controller
{
    public function AndroidCensorShow()
    {
        $cs = Censor::select('id','heartbeat','temperature','created_at')
                    ->withCasts([
                        'created_at' => 'datetime:Y-m-d H:i'
                    ])->get();
        echo $cs;
    }

    public function AndroidPatientShow(){
        $patient = Patient::select('first_name','last_name','placeofbirth','dateofbirth','address','country','job')
            ->withCasts([
                'dateofbirth' => 'datetime:d-m-Y'
            ])->get();
        echo $patient;
    }

    public function AndroidLoginAuth(Request $request){
        // $token = $request->session()->token();
        $response = array();
        $token = csrf_token();
        $email = $request->email;
        $password = $request->password;
        if(is_null($email) && is_null($password)){
            echo "null";
        }else{
            $str = array([
                '_token' => $token,
                'email' => $email,
                'password' => $password
            ]);
            echo json_encode($str);
        } 
        // print_r($request->input('email'));
    }

    public function showtoken(){
        // $token = $request->session()->token();
        $token = csrf_token();
        echo $token;
    }
}
