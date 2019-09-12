<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;

class PendinglistController extends Controller
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
        // dd($data);
        
        return view('pendinglist',['Pendings' => $data]);    
    }

    public function update(Request $request)
    {
        //API GET
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/PendingListAPI/GetPendingListByUserid?Userid=".$request->Id; 
        // $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/PendingListAPI/GetPendingListByUserid?Userid=".$request->Id; 
        $ch = curl_init($url);                                                     
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val= json_decode($result);
        // dd($val);

        return json_encode($val);
    }

    public function verification(Request $request) {
        $data = json_encode(array(
            "UserId" => "$request->pendinglist_Userid_update_data",
            "Reason" => "$request->pendinglist_Reason_update_data",
            "IsApproving" => "$request->pendinglist_isApproving_update_data",
        )); 
        // dd($data);

        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/PendingListAPI/UpdatePendingList"; 
        $ch = curl_init($url);                   
        curl_setopt($ch, CURLOPT_POST, true);                                  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $data = json_decode($result);
        // dd($result);

        // if ($request->pendinglist_isApproving_update_data == true) {
        //     Alert::success('User has been Approve');
        // } else {
        //     Alert::success('User has been Rejected');
        // }
        
        return redirect('/pendinglist');
	}
}
