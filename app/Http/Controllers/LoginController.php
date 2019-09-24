<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }
    // membuat session
	public function LoginSession(Request $request) {
        $data = json_encode(array(
            "Username"=>"$request->Username",
            "Password"=>"$request->Password",
        )); 
        // dd($data);
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/LoginAPI/Login"; 
        $ch = curl_init($url);                   
        curl_setopt($ch, CURLOPT_POST, true);                                  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $Hasil= json_decode($result);
        // dd($err);
        if ($Hasil->Error == "Berhasil login" ){
            $request->session()->put('LoginSession',$Hasil->User->Username);
            $request->session()->put('Email',$Hasil->User->Email);
            $request->session()->put('Name',$Hasil->User->Name);
            $request->session()->put('Id',$Hasil->User->Id);
            $request->session()->put('RoleId',$Hasil->User->RoleId);

            return redirect('/');
        }else{
            return view('login',['error' =>$result]);    
        }
	}
 
	// menghapus session
	public function LogoutSession(Request $request) {
        $request->session()->forget('LoginSession');
        // return redirect('login');        
        return redirect(\URL::previous());
	}
}
