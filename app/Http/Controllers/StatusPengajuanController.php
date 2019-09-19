<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StatusPengajuanExport;

class StatusPengajuanController extends Controller
{
    public function index()
    {
        //API GET
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/StatusPengajuanAPI/GetAllStatusPengajuan"; 
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $Hasils = json_decode($result);
        //  dd($Hasils);

        return view('status_pengajuan',['Status_pengajuans'=>$Hasils]);  
    }

    public function show(Request $request)
    {
        // API
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/StatusPengajuanAPI//GetStatusPengajuanById?MstStatusPengajuan_Id=".$request->Id; 
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
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/StatusPengajuanAPI//DeleteStatusPengajuanById?MstStatusPengajuan_Id=".$id;
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
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/StatusPengajuanAPI/GetAllStatusDataByStatusPengajuanId?MstStatusPengajuan_Id=".$request->Id; 
        $ch = curl_init($url);                                                     
        //  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $Hasil = json_decode($result);
        // dd($Status_Data);
        $val = [
            "Status_data"=> $Hasil,
        ];

        return  $val;
    }

    public function download()
    {
         //API
         $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/StatusPengajuanAPI/GetAllStatusPengajuan"; 
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
         foreach ($Hasils as $Hasil) {

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
        return Excel::download(new StatusPengajuanExport($data), 'StatusPengajuanAplikasi '. date("Y-m-d His") .'.xlsx');
    }
}
