<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisteredContractController extends Controller
{
    public function index()
    {
         //API GET
         $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/RegisteredContractAPI/GetAllRegisteredContract"; 
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $Hasils= json_decode($result);
        //  dd($Hasils);

        return view('registered_contract',['Contracts'=>$Hasils]);  
    }

    public function RegisteredContractDetail()
    {
        return view('registered_contract_detail');
    }
}
