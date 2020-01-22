<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;

class PendingController extends Controller
{
    public function index(Request $request)
    {
        $session=[];
        array_push($session,[
            'LoginSession'=>$request->session()->get('LoginSession'),
            'Email'=>$request->session()->get('Email'),
            'Name'=>$request->session()->get('Name'),
            'Id'=>$request->session()->get('Id'),
            'RoleId'=>$request->session()->get('RoleId'),
            'SubMenuId'=>"2"
        ]);

        $role = json_encode(array(  
            // "Id"=> $request->Id_add,
            "ROLEID"=>$request->session()->get('RoleId'),
        
        ));

        $urlrole = config('global.base_url_outsystems').'/ACCWorldCMS/rest/CheckRoleAPI/CheckRole';

        $chrole = curl_init($urlrole);                   
        curl_setopt($chrole, CURLOPT_POST, true);                                  
        curl_setopt($chrole, CURLOPT_POSTFIELDS, $role);
        curl_setopt($chrole, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($chrole, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($chrole, CURLOPT_RETURNTRANSFER, true);                                                                  
        $resultrole = curl_exec($chrole);
        $errrole = curl_error($chrole);
        curl_close($chrole);
        $Hasilsrole= json_decode($resultrole);
        //dd($Hasilsrole);

        //API
        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/PendingListAPI/GetAllPendingList?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"];  
        $ch = curl_init($url);                                                     
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $Hasils = json_decode($result);
        // dd($Hasils);
        
        if((property_exists($Hasils,"Role")) && ($Hasils->Role->IsView == True)){
            return view('pending',[
                'Role' => $Hasils->Role,
                'Pendings' => $Hasils->Data,
                'role'=> $Hasilsrole->OUT_DATA, 
                'session' => $session            
            ]);  
        }else{
            return redirect('/invalid-permission');
        }      
    }

    public function show(Request $request)
    {
        //API GET
        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/PendingListAPI/GetPendingListByUserid?Userid=".$request->Id; 
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

        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/PendingListAPI/UpdatePendingList"; 
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
        
        return redirect('/pending')->with('success',' Update Data Successfully!');
	}
}
