<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\LeaseExport;
use Maatwebsite\Excel\Facades\Excel;

class LeaseController extends Controller
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
            'SubMenuId'=>"10" // "10" untuk SubMenu Lease
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

        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/LeaseAPI/GetAllLease?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
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
                'lease',[
                    'Role' => $Hasils->Role,
                    'MstTransaksiList' => $Hasils->Data->MstTransaksiList,
                    'MstTrsansaksi_StatusList'=> $Hasils->Data->MstTrsansaksi_StatusList,
                    'role'=> $Hasilsrole->OUT_DATA, 
                    'session' => $session
            ]);
        }else{
            return redirect('/invalid-permission');
        }  
    }

    public function getByCondition(Request $request)
    {
        $data = json_encode(
            array(
                "Status" => $request->Status,
                "StartDate" => $request->StartDate,
                "EndDate" => $request->EndDate,
            )
        );
        // dd($data);

        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/LeaseAPI/GetAllLeaseByCondition"; 
        $ch = curl_init($url);                   
        curl_setopt($ch, CURLOPT_POST, true);                                  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val = json_decode($result);
        // dd($val);

        return json_encode($val);  
    }

    public function show(Request $request)
    {
        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/LeaseAPI/GetLeaseById?Input=".$request->Id; 
        // dd($url);  
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

    public function delete($id=null, Request $request)
    {
        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/LeaseAPI/DeleteLeaseById?Input=".$id;
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

        return redirect('/lease')->with('success',' Delete Data Successfully!');
    }
    
    public function update(Request $request)
    {
        $data = json_encode(
            array(
                "MstTransaksi_Id" => $request->updateLease_MstTransaksi_Id,
                "MstTransaksi_Notes" => $request->updateLease_MstTransaksi_Notes,
            )
        );
        // dd($data);

        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/LeaseAPI/FollowUpLease"; 
        $ch = curl_init($url);                   
        curl_setopt($ch, CURLOPT_POST, true);                                  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val = json_decode($result);
        // dd($val);

        if(property_exists($val, 'IsSuccess') && ($val->IsSuccess)) {
            return redirect('/lease')->with('success',' Follow Up Data Successfully!');
        } elseif(property_exists($val, 'ErrorMessage')) {
            return redirect('/lease')->with('error', $val->ErrorMessage);
        } else {
            return redirect('/lease')->with('error',' Follow Up Data Failed!');
        }
    }

    public function download($Status=null, $StartDate=null, $EndDate=null, Request $request)
    {
        $tempStatus = $Status;
        $tempStartDate = $StartDate;
        $tempEndDate = $EndDate;
        if ($Status === "null")
            $tempStatus = "";
        if ($StartDate === "null")
            $tempStartDate = "";
        if ($EndDate === "null")
            $tempEndDate = "";
        $data_Input = json_encode(
            array(
                "Status" => $tempStatus,
                "StartDate" => $tempStartDate,
                "EndDate" => $tempEndDate,
            )
        );
        // dd($data_Input);

        //API
        $url = config('global.base_url_outsystems')."/ACCWorldCMS/rest/LeaseAPI/GetAllLeaseByCondition"; 
        $ch = curl_init($url);                   
        curl_setopt($ch, CURLOPT_POST, true);                                  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_Input);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val = json_decode($result);
        // dd($val);

        $data_Output=[];
        $data_Output_fileName='accone Lease Transaction '.date("Y-m-d").'.xls';
        if (property_exists($val, 'MstTransaksiList')) {
            foreach ($val->MstTransaksiList as $MstTransaksi) {

                $tmp_User_Username = "";
                $tmp_User_Name = "";
                $tmp_User_MobilePhone = "";
                $tmp_MstTransaksi_TransactionDate = "";
                $tmp_MstTransaksi_Brand = "";
                $tmp_MstTransaksi_KodeBrand = "";
                $tmp_MstTransaksi_Type = "";
                $tmp_MstTransaksi_KodeType = "";
                $tmp_MstTransaksi_Model = "";
                $tmp_MstTransaksi_KodeModel = "";
                $tmp_MstTransaksi_Tahun = "";
                $tmp_MstTransaksi_Tenors = "0";
                $tmp_MstTransaksi_Tujuan = "";
                $tmp_MstTransaksi_FlagNewUsed = 'FALSE';
                $tmp_MstTransaksi_Status = "";
                $tmp_MstTransaksi_Status_Detail = "";
                $tmp_MstTransaksi_Notes = "";

                if (property_exists($MstTransaksi, 'User')) {
                    if (property_exists($MstTransaksi->User, 'Username')) 
                        $tmp_User_Username = $MstTransaksi->User->Username;
                    if (property_exists($MstTransaksi->User, 'Name')) 
                        $tmp_User_Name = $MstTransaksi->User->Name;
                    if (property_exists($MstTransaksi->User, 'MobilePhone')) 
                        $tmp_User_MobilePhone = $MstTransaksi->User->MobilePhone;
                }
                if (property_exists($MstTransaksi->MstTransaksi, 'TransactionDate')) 
                    $tmp_MstTransaksi_TransactionDate = date('d-m-Y', strtotime($MstTransaksi->MstTransaksi->TransactionDate));
                if (property_exists($MstTransaksi->MstTransaksi, 'Brand')) 
                    $tmp_MstTransaksi_Brand = $MstTransaksi->MstTransaksi->Brand;
                if (property_exists($MstTransaksi->MstTransaksi, 'KodeBrand')) 
                    $tmp_MstTransaksi_KodeBrand = $MstTransaksi->MstTransaksi->KodeBrand;
                if (property_exists($MstTransaksi->MstTransaksi, 'Type')) 
                    $tmp_MstTransaksi_Type = $MstTransaksi->MstTransaksi->Type;
                if (property_exists($MstTransaksi->MstTransaksi, 'KodeType')) 
                    $tmp_MstTransaksi_KodeType = $MstTransaksi->MstTransaksi->KodeType;
                if (property_exists($MstTransaksi->MstTransaksi, 'Model')) 
                    $tmp_MstTransaksi_Model = $MstTransaksi->MstTransaksi->Model;
                if (property_exists($MstTransaksi->MstTransaksi, 'KodeModel')) 
                    $tmp_MstTransaksi_KodeModel = $MstTransaksi->MstTransaksi->KodeModel;
                if (property_exists($MstTransaksi->MstTransaksi, 'Tahun')) 
                    $tmp_MstTransaksi_Tahun = $MstTransaksi->MstTransaksi->Tahun;
                if (property_exists($MstTransaksi->MstTransaksi, 'Tenors'))  
                    if (!($MstTransaksi->MstTransaksi->Tenors == 0) || ($MstTransaksi->MstTransaksi->Tenors == ""))  
                        $tmp_MstTransaksi_Tenors = (double)$MstTransaksi->MstTransaksi->Tenors;
                if (property_exists($MstTransaksi->MstTransaksi, 'Tujuan')) 
                    $tmp_MstTransaksi_Tujuan = $MstTransaksi->MstTransaksi->Tujuan;
                if (property_exists($MstTransaksi->MstTransaksi, 'FlagNewUsed')) {
                    if ($MstTransaksi->MstTransaksi->FlagNewUsed) 
                        $tmp_MstTransaksi_FlagNewUsed = 'TRUE';
                    else 
                        $tmp_MstTransaksi_FlagNewUsed = 'FALSE';
                }
                if (property_exists($MstTransaksi->MstTransaksi, 'Status')) 
                    $tmp_MstTransaksi_Status = $MstTransaksi->MstTransaksi->Status;
                if (property_exists($MstTransaksi->MstTransaksi, 'Status_Detail')) 
                    $tmp_MstTransaksi_Status_Detail = $MstTransaksi->MstTransaksi->Status_Detail;
                if (property_exists($MstTransaksi->MstTransaksi, 'Notes')) 
                    $tmp_MstTransaksi_Notes = $MstTransaksi->MstTransaksi->Notes;
                
                array_push($data_Output,[
                    "Username"=>$tmp_User_Username,
                    "Name"=>$tmp_User_Name,
                    "MobilePhone"=>$tmp_User_MobilePhone,
                    "TransactionDate"=>$tmp_MstTransaksi_TransactionDate,
                    "Brand"=>$tmp_MstTransaksi_Brand,
                    "KodeBrand"=>$tmp_MstTransaksi_KodeBrand,
                    "Type"=>$tmp_MstTransaksi_Type,
                    "KodeType"=>$tmp_MstTransaksi_KodeType,
                    "Model"=>$tmp_MstTransaksi_Model,
                    "KodeModel"=>$tmp_MstTransaksi_KodeModel,
                    "Tahun"=>$tmp_MstTransaksi_Tahun,
                    "Tenors"=>$tmp_MstTransaksi_Tenors,
                    "Tujuan"=>$tmp_MstTransaksi_Tujuan,
                    "FlagNewUsed"=>$tmp_MstTransaksi_FlagNewUsed,
                    "Status"=>$tmp_MstTransaksi_Status,
                    "Status_Detail"=>$tmp_MstTransaksi_Status_Detail,
                    "Notes"=>$tmp_MstTransaksi_Notes,
                ]);
            }
        }
        // dd($data_Output);
        return Excel::download(new LeaseExport($data_Output), $data_Output_fileName);
    }
}
