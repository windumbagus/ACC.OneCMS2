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
    
        // dd($result);
    
        if ($result== "Berhasil login" ){
            $request->session()->put('LoginSession',$request->Username);
            return redirect('/');
        }else{
            return view('login',['error' =>$result]);    
        }
	}
 
	// menghapus session
	public function LogoutSession(Request $request) {
        $request->session()->forget('LoginSession');
        return redirect('login');        
	}
}
