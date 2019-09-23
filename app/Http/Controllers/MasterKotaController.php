<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterKotaController extends Controller
{
    public function index()
    {
         //API GET
         $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterKotaAPI/GetAllMasterKota"; 
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $Hasils= json_decode($result);
        //  dd($Hasils);

        return view('master_kota',['Kotas'=>$Hasils]);    
    }

    public function show(Request $request)
    {
        //API GET
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterKotaAPI/GetMasterKotaById?MstCityId=".$request->Id; 
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val= json_decode($result);
        // dd($val);

        return json_encode($val);
    }

    public function save(Request $request)
    {
        
    }

    public function update(Request $request)
    {
        
    }

    public function delete(Request $request)
    {
        
    }
}
