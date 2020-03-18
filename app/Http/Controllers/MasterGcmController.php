<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MasterGcmExport;
use Illuminate\Http\Request;

class MasterGcmController extends Controller
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
            'SubMenuId'=>"3" // "3" untuk SubMenu MasterContent
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

        $url = config('global.base_url_outsystems')."/ACCWorldCMS/rest/MasterGcmAPI/GetAllMasterGcmByCondition?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
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
                'master_gcm',[
                    'Role' => $Hasils->Role,
                    'Conditions'=> $Hasils->Data->Condition,
                    'role'=> $Hasilsrole->OUT_DATA, 
                    'countpendingacccash'=>count($Hasilscount->OUT_DATA[0]->dataApply),
                    'session' => $session
            ]);
        }else{
            return redirect('/invalid-permission');
        }
    }

    public function getByCondition(Request $request)
    {
        $url = config('global.base_url_outsystems')."/ACCWorldCMS/rest/MasterGcmAPI/GetAllMasterGcmByCondition?Condition=".urlencode($request->Condition); 
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val = json_decode($result);
        // dd($val->Data);

        return json_encode($val->Data); 
    }

    public function delete(Request $request)
    {
        $url = config('global.base_url_outsystems')."/ACCWorldCMS/rest/MasterGcmAPI/DeleteMasterGcmById?MstGCMId=".$request->Id;
        // dd($url);        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val = json_decode($result);
        // dd($result);
        return json_encode($val);
    }

    public function show(Request $request)
    {
        $url = config('global.base_url_outsystems')."/ACCWorldCMS/rest/MasterGcmAPI/GetMasterGcmById?MstGCMId=".$request->Id; 
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

    public function add(Request $request)
    {
        // $request->validate([
        //     "CD_BRAND_master_otr_add"=>'required',         
        // ]);

        if ($request->Input_Picture_Add != null){
            $file = $request->Input_Picture_Add;
            $getContent = file_get_contents($file);
            $content= base64_encode($getContent);
            $name = $file->getClientOriginalName();
            $filetype = $file->extension();

            $filetype = "image/".$filetype;
            $type = "MasterGCM";
        }else{
            $content ="";
            $name="";
            $type="";
            $filetype="";
        }
        
        if($request->IsActive_Add== "on"){
            $IsActive_Add = "Y";
        }else{
            $IsActive_Add = "N";
        }

        $data = json_encode(array(
            "MstPicture" => array(   
                // "Id" => ,
                // "DataId" => $request->Id,
                "Picture" => $content,
                "FileName" => $name,
                "FileType" => $filetype,
                "Type" => $type,
            ),
            "MstGCM" => array(
                // "Id" => ,
                "Condition" => $request->Condition_Add,
                "CharValue1" => $request->CharValue1_Add,
                "CharDesc1" => $request->CharDesc1_Add,
                "CharValue2" => $request->CharValue2_Add,
                "CharDesc2" => $request->CharDesc2_Add,
                "CharValue3" => $request->CharValue3_Add,
                "CharDesc3" => $request->CharDesc3_Add,
                "CharValue4" => $request->CharValue4_Add,
                "CharDesc4" => $request->CharDesc4_Add,
                "CharValue5" => $request->CharValue5_Add,
                "CharDesc5" => $request->CharDesc5_Add,
                "AddedDate" => now(),
                "UserAdded" => $request->session()->get('Id'),
                // "UpdatedDate" => $request->,
                // "UserUpdated" => $request->,
                "IsActive" => $IsActive_Add,
                // "TimeStamp1" => $request->TimeStamp1_Add,
                // "TimeStamp2" => $request->TimeStamp2_Add,
            ),
            "User_Username" =>  $request->session()->get('Id'),
            "MstGCM_TimeStamp1" => $request->TimeStamp1_Add,
            "MstGCM_TimeStamp2" => $request->TimeStamp2_Add,

        ));
        // dd($data);

        $url = config('global.base_url_outsystems')."/ACCWorldCMS/rest/MasterGcmAPI/CreateOrUpdateMasterGcm"; 
        $ch = curl_init($url);                   
        curl_setopt($ch, CURLOPT_POST, true);                                  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $hasils = json_decode($result);
        // dd($result);

        return redirect('/master-gcm')->with('success','Master GCM Successfully Added !!!');
    }

    public function update(Request $request)
    {
        // dd($request->Input_Picture_Update);
        if ($request->Input_Picture_Update != null){
            $file = $request->Input_Picture_Update;
            // dd($file);
            $getContent = file_get_contents($file);
            $content= base64_encode($getContent);
            $name = $file->getClientOriginalName();
            $filetype = $file->extension();

            $filetype = "image/".$filetype;
            $type = "MasterGCM";
        }else{
            $content = $request->Picture;
            $name = $request->Picture_FileName;
            $type = $request->Picture_Type;
            $filetype = $request->Picture_FileType;
        }
        
        if($request->IsActive_Update== "on"){
            $IsActive_Update = "Y";
        }else{
            $IsActive_Update = "N";
        }

        $data = json_encode(array(
            "MstPicture" => array(   
                "Id" => $request->Picture_Id,
                "DataId" => $request->Picture_DataId,
                "Picture" => $content,
                "FileName" => $name,
                "FileType" => $filetype,
                "Type" => $type,
            ),
            "MstGCM" => array(
                "Id" => $request->Id,
                "Condition" => $request->Condition_Update,
                "CharValue1" => $request->CharValue1_Update,
                "CharDesc1" => $request->CharDesc1_Update,
                "CharValue2" => $request->CharValue2_Update,
                "CharDesc2" => $request->CharDesc2_Update,
                "CharValue3" => $request->CharValue3_Update,
                "CharDesc3" => $request->CharDesc3_Update,
                "CharValue4" => $request->CharValue4_Update,
                "CharDesc4" => $request->CharDesc4_Update,
                "CharValue5" => $request->CharValue5_Update,
                "CharDesc5" => $request->CharDesc5_Update,
                // "AddedDate" => now(),
                // "UserAdded" => $request->session()->get('Id'),
                "UpdatedDate" => now(),
                "UserUpdated" => $request->session()->get('Id'),
                "IsActive" => $IsActive_Update,
                // "TimeStamp1" => $request->TimeStamp1_Update,
                // "TimeStamp2" => $request->TimeStamp2_Update,
            ),
            "User_Username" =>  $request->session()->get('Id'),
            "MstGCM_TimeStamp1" => $request->TimeStamp1_Update,
            "MstGCM_TimeStamp2" => $request->TimeStamp2_Update,

        ));
        // dd($data);

        $url = config('global.base_url_outsystems')."/ACCWorldCMS/rest/MasterGcmAPI/CreateOrUpdateMasterGcm"; 
        $ch = curl_init($url);                   
        curl_setopt($ch, CURLOPT_POST, true);                                  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $hasils = json_decode($result);
        // dd($result);

        return redirect('/master-gcm')->with('success','Master GCM Successfully Updated !!!');
    }

    public function download($Condition=null, Request $request)
    {
        // API
        $url = config('global.base_url_outsystems')."/ACCWorldCMS/rest/MasterGcmAPI/GetAllMasterGcmByCondition?Condition=".urlencode($Condition); 
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $Hasils = json_decode($result);
        // dd($Hasils);
        
        $data=[];
        if(property_exists($Hasils->Data,'MstGCM')){
            foreach ($Hasils->Data->MstGCM as $Hasil) {

                if (property_exists($Hasil, 'Id')){
                    $Id = $Hasil->Id;
                }else{
                    $Id = "";
                }
                if (property_exists($Hasil, 'Condition')){
                    $Condition = $Hasil->Condition;
                }else{
                    $Condition = "";
                }
                if (property_exists($Hasil, 'CharValue1')){
                    $CharValue1 = $Hasil->CharValue1;
                }else{
                    $CharValue1 = "";
                }
                if (property_exists($Hasil, 'CharDesc1')){
                    $CharDesc1 = $Hasil->CharDesc1;
                }else{
                    $CharDesc1 = "";
                }
                if (property_exists($Hasil, 'CharValue2')){
                    $CharValue2 = $Hasil->CharValue2;
                }else{
                    $CharValue2 = "";
                }
                if (property_exists($Hasil, 'CharDesc2')){
                    $CharDesc2 = $Hasil->CharDesc2;
                }else{
                    $CharDesc2 = "";
                }
                if (property_exists($Hasil, 'CharValue3')){
                    $CharValue3 = $Hasil->CharValue3;
                }else{
                    $CharValue3 = "";
                }
                if (property_exists($Hasil, 'CharDesc3')){
                    $CharDesc3 = $Hasil->CharDesc3;
                }else{
                    $CharDesc3 = "";
                }
                if (property_exists($Hasil, 'CharValue4')){
                    $CharValue4 = $Hasil->CharValue4;
                }else{
                    $CharValue4 = "";
                }
                if (property_exists($Hasil, 'CharDesc4')){
                    $CharDesc4 = $Hasil->CharDesc4;
                }else{
                    $CharDesc4 = "";
                }
                if (property_exists($Hasil, 'CharValue5')){
                    $CharValue5 = $Hasil->CharValue5;
                }else{
                    $CharValue5 = "";
                }
                if (property_exists($Hasil, 'CharDesc5')){
                    $CharDesc5 = $Hasil->CharDesc5;
                }else{
                    $CharDesc5 = "";
                }
                if (property_exists($Hasil, 'AddedDate')){
                    $AddedDate = $Hasil->AddedDate;
                }else{
                    $AddedDate = "";
                }
                if (property_exists($Hasil, 'UserAdded')){
                    $UserAdded = $Hasil->UserAdded;
                }else{
                    $UserAdded = "";
                }
                if (property_exists($Hasil, 'UpdatedDate')){
                    $UpdatedDate = $Hasil->UpdatedDate;
                }else{
                    $UpdatedDate = "";
                }
                if (property_exists($Hasil, 'UserUpdated')){
                    $UserUpdated = $Hasil->UserUpdated;
                }else{
                    $UserUpdated = "";
                }
                if (property_exists($Hasil, 'IsActive')){
                    $IsActive = $Hasil->IsActive;
                }else{
                    $IsActive = "";
                }
                if (property_exists($Hasil, 'TimeStamp1')){
                    $TimeStamp1 = $Hasil->TimeStamp1;
                }else{
                    $TimeStamp1 = "";
                }
                if (property_exists($Hasil, 'TimeStamp2')){
                    $TimeStamp2 = $Hasil->TimeStamp2;
                }else{
                    $TimeStamp2 = "";
                }

                array_push($data,[
                    "Id"=>$Id,
                    "Condition"=>$Condition,
                    "CharValue1"=>$CharValue1,
                    "CharDesc1"=>$CharDesc1,
                    "CharValue2"=>$CharValue2,
                    "CharDesc2"=>$CharDesc2,
                    "CharValue3"=>$CharValue3,
                    "CharDesc3"=>$CharDesc3,
                    "CharValue4"=>$CharValue4,
                    "CharDesc4"=>$CharDesc4,
                    "CharValue5"=>$CharValue5,
                    "CharDesc5"=>$CharDesc5,
                    "AddedDate"=>$AddedDate,
                    "UserAdded"=>$UserAdded,
                    "UpdatedDate"=>$UpdatedDate,
                    "UserUpdated"=>$UserUpdated,
                    "IsActive"=>$IsActive,
                    "TimeStamp1"=>$TimeStamp1,
                    "TimeStamp2"=>$TimeStamp2,
            ]);
            }
        }
        // dd($data2);
        return Excel::download(new MasterGcmExport($data), 'ACC One GCM '.  date("Y-m-d") .'.xlsx');
    }
}
