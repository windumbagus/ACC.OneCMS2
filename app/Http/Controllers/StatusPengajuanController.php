<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StatusPengajuanExport;
use App\Exports\StatusDataExport;

class StatusPengajuanController extends Controller
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
            'SubMenuId'=>"28"
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

        //API GET
        $url = config('global.base_url_outsystems')."/ACCWorldCMS/rest/StatusPengajuanAPI/GetAllStatusPengajuan?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $Hasils = json_decode($result);
        //  dd($Hasils);

        if((property_exists($Hasils,"Role")) && ($Hasils->Role->IsView == True)){
            return view('status_pengajuan',[
                'Role' => $Hasils->Role,
                'Status_pengajuans'=>$Hasils->Data,
                'role'=> $Hasilsrole->OUT_DATA, 
                'session' => $session            
            ]);          
        }else{
            return redirect('/invalid-permission');
        }   
    }

    public function show(Request $request)
    {
        // API
        $url = config('global.base_url_outsystems')."/ACCWorldCMS/rest/StatusPengajuanAPI//GetStatusPengajuanById?MstStatusPengajuan_Id=".$request->Id; 
        $ch = curl_init($url);                                                     
        //  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val= json_decode($result);
        // dd($val);

        return json_encode($val);
    }

    public function delete($id=null,Request $request)
    {
        $url = config('global.base_url_outsystems')."/ACCWorldCMS/rest/StatusPengajuanAPI//DeleteStatusPengajuanById?MstStatusPengajuan_Id=".$id;
        // dd($url);        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $data = json_decode($result);
        // dd($result);

        return redirect('/status-pengajuan-aplikasi')->with('success',' Delete Data Successfully!');
    }
    
    public function StatusData(Request $request)
    {
        // API
        $url = config('global.base_url_outsystems')."/ACCWorldCMS/rest/StatusPengajuanAPI/GetAllStatusDataByStatusPengajuanId?MstStatusPengajuan_Id=".$request->Id; 
        $ch = curl_init($url);                                                     
        //  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $Hasils = json_decode($result);
        // dd($Hasils);
        $val = [
            "Data"=> $Hasils,
            "MstStatusPengajuan_Id"=>$request->Id,
        ];

        return  $val;
    }

    public function DownloadStatusPengajuan(Request $request)
    {
        $session=[];
        array_push($session,[
            'LoginSession'=>$request->session()->get('LoginSession'),
            'Email'=>$request->session()->get('Email'),
            'Name'=>$request->session()->get('Name'),
            'Id'=>$request->session()->get('Id'),
            'RoleId'=>$request->session()->get('RoleId'),
            'SubMenuId'=>"28"
        ]);
        //API GET
        $url = config('global.base_url_outsystems')."/ACCWorldCMS/rest/StatusPengajuanAPI/GetAllStatusPengajuan?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $Hasils= json_decode($result);
        //  dd($Hasils);

        $data=[];
        foreach ($Hasils->Data as $Hasil) {

            if (property_exists($Hasil->MstStatusPengajuan, 'Id')){
                $Id = $Hasil->MstStatusPengajuan->Id;
            }else{
                $Id = "";
            }

            if (property_exists($Hasil->MstStatusPengajuan, 'RegistrationNo')){
                $RegistrationNo = $Hasil->MstStatusPengajuan->RegistrationNo;
            }else{
                $RegistrationNo = "";
            }

            if (property_exists($Hasil->MstStatusPengajuan, 'Name')){
                $RegistrationName = $Hasil->MstStatusPengajuan->Name;
            }else{
                $RegistrationName = "";
            }

            if (property_exists($Hasil->MstStatusPengajuan, 'Brand')){
                $Brand = $Hasil->MstStatusPengajuan->Brand;
            }else{
                $Brand = "";
            }

            if (property_exists($Hasil->MstStatusPengajuan, 'Type')){
                $Type = $Hasil->MstStatusPengajuan->Type;
            }else{
                $Type = "";
            }

            if (property_exists($Hasil->MstStatusPengajuan, 'Model')){
                $Model = $Hasil->MstStatusPengajuan->Model;
            }else{
                $Model = "";
            }

            if (property_exists($Hasil->MstStatusPengajuan, 'Kind')){
                $Kind = $Hasil->MstStatusPengajuan->Kind;
            }else{
                $Kind = "";
            }

            if (property_exists($Hasil->MstStatusPengajuan, 'BranchName')){
                $BranchName = $Hasil->MstStatusPengajuan->BranchName;
            }else{
                $BranchName = "";
            }

            if (property_exists($Hasil->MstStatusPengajuan, 'SoName')){
                $SoName = $Hasil->MstStatusPengajuan->SoName;
            }else{
                $SoName = "";
            }

            if (property_exists($Hasil->MstStatusPengajuan, 'SoPhoneNo')){
                $SoPhoneNo = $Hasil->MstStatusPengajuan->SoPhoneNo;
            }else{
                $SoPhoneNo = "";
            }

            if (property_exists($Hasil->MstStatusPengajuan, 'Tenor')){
                $Tenor = $Hasil->MstStatusPengajuan->Tenor;
            }else{
                $Tenor = "";
            }

            if (property_exists($Hasil->MstStatusPengajuan, 'AmountInstallment')){
                $AmountInstallment = $Hasil->MstStatusPengajuan->AmountInstallment;
            }else{
                $AmountInstallment = "";
            }

            if (property_exists($Hasil->MstStatusPengajuan, 'ProspectID')){
                $ProspectID = $Hasil->MstStatusPengajuan->ProspectID;
            }else{
                $ProspectID = "";
            }

            if (property_exists($Hasil->MstStatusPengajuan, 'UserId')){
                $User_Id = $Hasil->MstStatusPengajuan->UserId;
            }else{
                $User_Id = "";
            }

            if (property_exists($Hasil, 'User_Name')){
                $User_Name = $Hasil->User_Name;
            }else{
                $User_Name = "";
            }

            array_push($data,[
                "User_Name"=>$User_Name,
                "Id"=>$Id,
                "RegistrationNo"=>$RegistrationNo,
                "RegistrationName"=>$RegistrationName,
                "Brand"=>$Brand,
                "Type"=>$Type,
                "Model"=>$Model,
                "Kind"=>$Kind,
                "BranchName"=>$BranchName,
                "SoName"=>$SoName,
                "SoPhoneNo"=>$SoPhoneNo,
                "Tenor"=>$Tenor,
                "AmountInstallment"=>$AmountInstallment,
                "ProspectID"=>$ProspectID,
                "User_Id"=>$User_Id,
           ]);
        }
        // dd($data);
        return Excel::download(new StatusPengajuanExport($data), 'Status Pengajuan Aplikasi '. date("Y-m-d His") .'.xlsx');
    }

    public function DownloadStatusData(Request $request)
    {
        // API
        $url = config('global.base_url_outsystems')."/ACCWorldCMS/rest/StatusPengajuanAPI/GetAllStatusDataByStatusPengajuanId?MstStatusPengajuan_Id=".$request->MstStatusPengajuan_Id; 
        $ch = curl_init($url);                                            
        //  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $Hasils = json_decode($result);
        // dd($Hasils);
        
        $data2=[];
        $User_Name = "";
        foreach ($Hasils as $Hasil) {

            if (property_exists($Hasil, 'User_Name')){
                $User_Name = $Hasil->User_Name;
            }else{
                $User_Name = "";
            }
            
            if (property_exists($Hasil, 'MstStatusPengajuan_RegistrationNo')){
                $MstStatusPengajuan_RegistrationNo = $Hasil->MstStatusPengajuan_RegistrationNo;
            }else{
                $MstStatusPengajuan_RegistrationNo = "";
            }

            if (property_exists($Hasil->MstStatusData, 'Id')){
                $Id = $Hasil->MstStatusData->Id;
            }else{
                $Id = "";
            }

            if (property_exists($Hasil->MstStatusData, 'Status')){
                $Status = $Hasil->MstStatusData->Status;
            }else{
                $Status = "";
            }

            if (property_exists($Hasil->MstStatusData, 'Date')){
                $Date = $Hasil->MstStatusData->Date;
            }else{
                $Date = "";
            }

            array_push($data2,[
                "Name"=>$User_Name,
                "RegistrationNo"=>$MstStatusPengajuan_RegistrationNo,
                "Id"=>$Id,
                "Status"=>$Status,
                "Date"=>$Date,
           ]);
        }
        // dd($data2);
        return Excel::download(new StatusDataExport($data2), 'Status Data '. $User_Name .'.xlsx');
    }
}
