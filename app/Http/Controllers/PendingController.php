<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PendingController extends Controller
{
    public function index()
    {
        //API
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/PendingListAPI/GetAllPendingList"; 
        $ch = curl_init($url);                                                     
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $data = json_decode($result);
        // dd($data); bangsat
        
        return view('pending',['Pendings' => $data]);    
    }
}
