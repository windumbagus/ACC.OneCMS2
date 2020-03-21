<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccYesMigrationController extends Controller
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
            'SubMenuId'=>"25" // "25" untuk SubMenu AccYesMigration
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

        $datacount = json_encode(array(
            "doTransactionApply" => array(   
                // "Id"=> $request->Id_add,
                "P_GUID"=>"",
                "TRANSACTION_CODE"=>"GET_APPLY",
                "P_STATUS"=>"PENDING",
            ),
        ));

        $urlcount = config('global.base_url_sofia').'/restV2/acccash/getdata/transactionapply';

        $chcount = curl_init($urlcount);                   
        curl_setopt($chcount, CURLOPT_POST, true);                                  
        curl_setopt($chcount, CURLOPT_POSTFIELDS, $datacount);
        curl_setopt($chcount, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($chcount, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($chcount, CURLOPT_RETURNTRANSFER, true);                                                                  
        $resultcount = curl_exec($chcount);
        $errcount = curl_error($chcount);
        curl_close($chcount);
        $Hasilscount= json_decode($resultcount); 


        //API GET
        //$url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/ACCYesMigrationAPI/GetAllACCYesMigration?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
        $url = config('global.base_url_outsystems').'/ACCWorldCMS/rest/ACCYesMigrationAPI/GetAllACCYesMigration?RoleId='.$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
        
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $Hasils= json_decode($result);
        // dd($Hasils);

        if((property_exists($Hasils,"Role")) && ($Hasils->Role->IsView == True)){
            return view(
                'acc_yes_migration',[
                    'Role' => $Hasils->Role,
                    'Migrations' => $Hasils->Data,
                    'role'=> $Hasilsrole->OUT_DATA, 
                    'countpendingacccash'=>count($Hasilscount->OUT_DATA[0]->dataApply),
                    'session' => $session
            ]);
        }else{
            return redirect('/invalid-permission');
        }   
    }

    public function delete($Id=null, Request $request)
    {
         //API GET
        //  $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/ACCYesMigrationAPI/DeleteACCYesMigrationById?MstUserAccYesId=".$request->Id; 
         $url = config('global.base_url_outsystems').'/ACCWorldCMS/rest/ACCYesMigrationAPI/DeleteACCYesMigrationById?MstUserAccYesId='.$request->Id; 
         
         //  dd($url);        
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $url);
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $data = json_decode($result);
         // dd($result);
 
         return redirect('/acc-yes-migration')->with('success','Data ACC Yes Migration Delete Successfull !!!');

    }

    public function migrate(Request $request)
    {
         //API GET
        //  $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/ACCYesMigrationAPI/MigrateAccYes"; 
         $url = config('global.base_url_outsystems').'/ACCWorldCMS/rest/ACCYesMigrationAPI/MigrateAccYes'; 
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $Hasils= json_decode($result);
        //  dd($Hasils);

         if(property_exists($Hasils, 'Success')){
            return redirect('/acc-yes-migration')->with('success', $Hasils->Message);
        }else{
            return redirect('/acc-yes-migration')->with('error', $Hasils->Message);
        }
    }
    
}
