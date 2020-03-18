<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataTertanggungUtamaExport;

class DataTertanggungUtamaController extends Controller
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
            'SubMenuId'=>"32" // "32" untuk SubMenu DataTertanggungUtama
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

         //API
        //  $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/DataTertanggungUtamaAPI/GetAllDataTertanggungUtama?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
         $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/DataTertanggungUtamaAPI/GetAllDataTertanggungUtama?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $Hasils = json_decode($result);
         // dd($Hasils);
            
         if((property_exists($Hasils,"Role")) && ($Hasils->Role->IsView == True)){
            return view(
                'data_tertanggung_utama',[
                    'Role' => $Hasils->Role,
                    'Utamas' => $Hasils->Data,
                    'role'=> $Hasilsrole->OUT_DATA, 
                    'countpendingacccash'=>count($Hasilscount->OUT_DATA[0]->dataApply),
                    'session' => $session
            ]);
        }else{
            return redirect('/invalid-permission');
        }   
    }

    public function show(Request $request)
    {
        // $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/DataTertanggungUtamaAPI/GetDataTertanggungUtamaById?MstDataTertanggungUtamaId=".$request->Id; 
        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/DataTertanggungUtamaAPI/GetDataTertanggungUtamaById?MstDataTertanggungUtamaId=".$request->Id; 
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val = json_decode($result);
        // dd($val);
        return json_encode($val);
    }

    public function download(Request $request)
    {
        //API
        $session=[];
        array_push($session,[
            'LoginSession'=>$request->session()->get('LoginSession'),
            'Email'=>$request->session()->get('Email'),
            'Name'=>$request->session()->get('Name'),
            'Id'=>$request->session()->get('Id'),
            'RoleId'=>$request->session()->get('RoleId'),
            'SubMenuId'=>"32" // "32" untuk SubMenu DataTertanggungUtama
        ]);

        // $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/DataTertanggungUtamaAPI/GetAllDataTertanggungUtama?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"];  
        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/DataTertanggungUtamaAPI/GetAllDataTertanggungUtama?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $Hasils = json_decode($result);
        // dd($Hasils);
        $data = [];
        foreach ($Hasils->Data as $Hasil){

            if (property_exists($Hasil->MstGCM, 'CharValue3')){
                $CharValue3 = $Hasil->MstGCM->CharValue3;
            }else{
                $CharValue3 = "";
            }

            if (property_exists($Hasil->MstGCM, 'CharValue4')){
                $CharValue4 = $Hasil->MstGCM->CharValue4;
            }else{
                $CharValue4 = "";
            }
            if (property_exists($Hasil->MstGCM, 'CharValue5')){
                $CharValue5 = $Hasil->MstGCM->CharValue5;
            }else{
                $CharValue5 = "";
            }

            if (property_exists($Hasil->MstGCM, 'CharDesc2')){
                $CharDesc2 = $Hasil->MstGCM->CharDesc2;
            }else{
                $CharDesc2 = "";
            }

            if (property_exists($Hasil->MstGCM, 'CharDesc3')){
                $CharDesc3 = $Hasil->MstGCM->CharDesc3;
            }else{
                $CharDesc3 = "";
            }

            if (property_exists($Hasil->MstGCM, 'CharDesc4')){
                $CharDesc4 = $Hasil->MstGCM->CharDesc4;
            }else{
                $CharDesc4 = "";
            }

            if (property_exists($Hasil->MstGCM, 'CharDesc5')){
                $CharDesc5 = $Hasil->MstGCM->CharDesc5;
            }else{
                $CharDesc5 = "";
            }

            if (property_exists($Hasil->MstGCM, 'TimeStamp1')){
                $TimeStamp1 = $Hasil->MstGCM->TimeStamp1;
            }else{
                $TimeStamp1 = "";
            }

            if (property_exists($Hasil->MstGCM, 'TimeStamp2')){
                $TimeStamp2 = $Hasil->MstGCM->TimeStamp2;
            }else{
                $TimeStamp2 = "";
            }

            if (property_exists($Hasil->MstDataTertanggungUtama, 'Handphone')){
                $Handphone = $Hasil->MstDataTertanggungUtama->Handphone;
            }else{
                $Handphone = "";
            }

            if (property_exists($Hasil->MstDataTertanggungUtama, 'NoKTP')){
                $NoKTP = $Hasil->MstDataTertanggungUtama->NoKTP;
            }else{
                $NoKTP = "";
            }

            if (property_exists($Hasil->MstDataTertanggungUtama, 'UpdatedDate')){
                $UpdatedDate = $Hasil->MstDataTertanggungUtama->UpdatedDate;
            }else{
                $UpdatedDate = "";
            }
 
            if (property_exists($Hasil->MstDataTertanggungUtama, 'UserUpdated')){
                $UserUpdated = $Hasil->MstDataTertanggungUtama->UserUpdated;
            }else{
                $UserUpdated = "";
            }

            if (property_exists($Hasil->MstDataTertanggungUtama, 'MstDataPemegangPolisId')){
                $MstDataPemegangPolisId = $Hasil->MstDataTertanggungUtama->MstDataPemegangPolisId;
            }else{
                $MstDataPemegangPolisId = "";
            }

            array_push($data,[
                "Id"=>$Hasil->MstGCM->Id,
                "Condition"=>$Hasil->MstGCM->Condition,
                "CharValue1"=>$Hasil->MstGCM->CharValue1,
                "CharDesc1"=>$Hasil->MstGCM->CharDesc1,
                "CharValue2"=>$Hasil->MstGCM->CharValue2,
                "CharDesc2"=>$CharDesc2,
                "CharValue3"=>$CharValue3,
                "CharDesc3"=>$CharDesc3,
                "CharValue4"=>$CharValue4,
                "CharDesc4"=>$CharDesc4,
                "CharValue5"=>$CharValue5,
                "CharDesc5"=>$CharDesc5,
                "AddedDate"=>$Hasil->MstGCM->AddedDate,
                "UserAdded"=>$Hasil->MstGCM->UserAdded,
                "UpdatedDate"=>$Hasil->MstGCM->UpdatedDate,
                "UserUpdated"=>$Hasil->MstGCM->UserUpdated,
                "IsActive"=>$Hasil->MstGCM->IsActive,
                "TimeStamp1"=>$TimeStamp1,
                "TimeStamp2"=>$TimeStamp2,
                "Id(20)"=>$Hasil->MstDataTertanggungUtama->Id,
                "Nama"=>$Hasil->MstDataTertanggungUtama->Nama,
                "TanggalLahir"=>$Hasil->MstDataTertanggungUtama->TanggalLahir,
                "JenisKelamin"=>$Hasil->MstDataTertanggungUtama->JenisKelamin,
                "Handphone"=>$Handphone,
                "NoKTP"=>$NoKTP,
                "MstPictures"=>$Hasil->MstDataTertanggungUtama->MstPicturesId,
                "AddedDate(27)"=>$Hasil->MstDataTertanggungUtama->AddedDate,
                "UserAdded(28)"=>$Hasil->MstDataTertanggungUtama->UserAdded,
                "UpdatedDate(29)"=>$UpdatedDate,
                "UserUpdated(30)"=>$UserUpdated,
                "MstDataPemegangPolis"=>$MstDataPemegangPolisId,
                "Hubungan"=>$Hasil->MstDataTertanggungUtama->Hubungan
            ]);               
        }
        // dd($data);
        return Excel::download(new DataTertanggungUtamaExport($data), 'ACCSave - Data Tertanggung Utama .xlsx');

    }
}
