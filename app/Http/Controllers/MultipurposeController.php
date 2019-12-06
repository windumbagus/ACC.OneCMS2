<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MultiPurposeExport;

class MultipurposeController extends Controller
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
            'SubMenuId'=>"11" // "11" untuk SubMenu Multipurpose,
        ]);

         //API GET
         $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/MultipurposeAPI/GetAllMultipurpose?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $Hasils= json_decode($result);
        //  dd($Hasils);

         //API GET Dropdown
         $url2 = config("global.base_url_outsystems")."/ACCWorldCMS/rest/MultipurposeAPI/GetTransactionStatus"; 
         $ch2 = curl_init($url2);                                                     
         curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch2, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result2 = curl_exec($ch2);
         $err2 = curl_error($ch2);
         curl_close($ch2);
         $Hasils2= json_decode($result2);
        //  dd($Hasils2);

        if((property_exists($Hasils,"Role")) && ($Hasils->Role->IsView == True)){
            return view('multipurpose',[
                'Role' => $Hasils->Role,
                'Multipurposes'=>$Hasils->Data,
                'Statuss'=>$Hasils2,
                'session' => $session            
            ]);
        }else{
            return redirect('/invalid-permission');
        }      
    }

    public function getByCondition(Request $request)
    {
        $data = json_encode(array(
            "Status"=> "$request->Status",
            "StartDate"=> "$request->StartDate",
            "EndDate"=> "$request->EndDate"
        ));
        // dd($data);

        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/MultipurposeAPI/GetMultipurposeByCondition"; 
        $ch = curl_init($url);                   
        curl_setopt($ch, CURLOPT_POST, true);                                  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $output = json_decode($result);
        // dd($result);
        return json_encode($output);
    }

    public function show(Request $request)
    {
        //API GET
        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/MultipurposeAPI/GetMultipurposeById?MstTransaksiId=".$request->Id; 
        // dd($url);
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

    public function delete($Id = null,Request $request)
    {
        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/MultipurposeAPI/Delete/?MstTransaksiId=".$Id;
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

        if(property_exists($val, 'Success')){
            return redirect('/multipurpose')->with('success',$val->Message);
        }else{
            return redirect('/multipurpose')->with('error',$val->Message);
        }
    }

    public function FollowUp(Request $request)
    {
        //API GET
        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/MultipurposeAPI/FollowedUp?MstTransaksiId=".$request->MstTransaksiId; 
        // dd($url);
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val= json_decode($result);
        // dd($val);
        if(property_exists($val, 'Success')){
            return redirect('/multipurpose')->with('success',$val->Message);
        }else{
            return redirect('/multipurpose')->with('error',$val->Message);
        }
    }

    public function download($Status=null,$StartDate=null,$EndDate=null, Request $request)
    {
        if ($Status === "null"){
            $Status = "";
        }
        if ($StartDate === "null"){
            $StartDate = "";            
        }
        if ($EndDate === "null"){
            $EndDate = "";
        }

        $data = json_encode(array(
            "Status"=> "$Status",
            "StartDate"=> "$StartDate",
            "EndDate"=> "$EndDate"
        ));
        // dd($data);

        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/MultipurposeAPI/GetMultipurposeByCondition"; 
        // dd($url);
        $ch = curl_init($url);                   
        curl_setopt($ch, CURLOPT_POST, true);                                  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $Hasils = json_decode($result);
        // dd($Hasils);

        $data=[];
        foreach ($Hasils as $Hasil) {
         
            if (property_exists($Hasil->User, 'Name')){
                $Name = $Hasil->User->Name;
            }else{
                $Name = "";
            }
            if (property_exists($Hasil->MstTransaksi, 'TransactionDate')){
                $TransactionDate = $Hasil->MstTransaksi->TransactionDate;
            }else{
                $TransactionDate = "";
            }
            if (property_exists($Hasil->MstTransaksi, 'Brand')){
                $Brand = $Hasil->MstTransaksi->Brand;
            }else{
                $Brand = "";
            }
            if (property_exists($Hasil->MstTransaksi, 'KodeBrand')){
                $KodeBrand = $Hasil->MstTransaksi->KodeBrand;
            }else{
                $KodeBrand = "";
            }
            if (property_exists($Hasil->MstTransaksi, 'Type')){
                $Type = $Hasil->MstTransaksi->Type;
            }else{
                $Type = "";
            }
            if (property_exists($Hasil->MstTransaksi, 'KodeType')){
                $KodeType = $Hasil->MstTransaksi->KodeType;
            }else{
                $KodeType = "";
            }
            if (property_exists($Hasil->MstTransaksi, 'Model')){
                $Model = $Hasil->MstTransaksi->Model;
            }else{
                $Model = "";
            }
            if (property_exists($Hasil->MstTransaksi, 'KodeModel')){
                $KodeModel = $Hasil->MstTransaksi->KodeModel;
            }else{
                $KodeModel = "";
            }
            if (property_exists($Hasil->MstTransaksi, 'Tahun')){
                $Tahun = $Hasil->MstTransaksi->Tahun;
            }else{
                $Tahun = "";
            }
            if (property_exists($Hasil->MstTransaksi, 'Tenors')){
                $Tenors = $Hasil->MstTransaksi->Tenors;
            }else{
                $Tenors = "";
            }
            if (property_exists($Hasil->MstTransaksi, 'Installment')){
                $Installment = $Hasil->MstTransaksi->Installment;
            }else{
                $Installment = "";
            }
            if (property_exists($Hasil->MstTransaksi, 'MRP')){
                $MRP = $Hasil->MstTransaksi->MRP;
            }else{
                $MRP = "";
            }
            if (property_exists($Hasil->MstTransaksi, 'Dana')){
                $Dana = $Hasil->MstTransaksi->Dana;
            }else{
                $Dana = "";
            }
            if (property_exists($Hasil->MstTransaksi, 'Tujuan')){
                $Tujuan = $Hasil->MstTransaksi->Tujuan;
            }else{
                $Tujuan = "";
            }
            if (property_exists($Hasil->MstTransaksi, 'Lokasi')){
                $Lokasi = $Hasil->MstTransaksi->Lokasi;
            }else{
                $Lokasi = "";
            }
            if (property_exists($Hasil->MstTransaksi, 'UnitId')){
                $UnitId = $Hasil->MstTransaksi->UnitId;
            }else{
                $UnitId = "0";
            }
            if (property_exists($Hasil->MstTransaksi, 'FlagNewExist')){
                $FlagNewExist = $Hasil->MstTransaksi->FlagNewExist;
            }else{
                $FlagNewExist = "FALSE";
            }
            if (property_exists($Hasil->MstTransaksi, 'Status')){
                $Status = $Hasil->MstTransaksi->Status;
            }else{
                $Status = "";
            }
            if (property_exists($Hasil->MstTransaksi, 'Status_Detail')){
                $Status_Detail = $Hasil->MstTransaksi->Status_Detail;
            }else{
                $Status_Detail = "";
            }
            if (property_exists($Hasil->MstTransaksi, 'FlagBPKB')){
                $FlagBPKB = $Hasil->MstTransaksi->FlagBPKB;
            }else{
                $FlagBPKB = "N";
            }
            if (property_exists($Hasil->MstTransaksi, 'Notes')){
                $Notes = $Hasil->MstTransaksi->Notes;
            }else{
                $Notes = "";
            }
            array_push($data,[
                "Username"=>$Name,
                "TransactionDate"=>$TransactionDate,
                "Brand"=>$Brand,
                "KodeBrand"=>$KodeBrand,
                "Type"=>$Type,
                "KodeType"=>$KodeType,
                "Model"=>$Model,
                "KodeModel"=>$KodeModel,
                "Tahun"=>$Tahun,
                "Tenors"=>$Tenors,
                "Installment"=>$Tenors,
                "MRP"=>$MRP,
                "Dana"=>$Dana,
                "Tujuan"=>$Tujuan,
                "Lokasi"=>$Lokasi,
                "UnitId"=>$UnitId,
                "FlagNewExist"=>$FlagNewExist,
                "Status"=>$Status,
                "Status_Detail"=>$Status_Detail,
                "FlagBPKB"=>$FlagBPKB,
                "Notes"=>$Notes,
            ]);
        }
        // dd($data);
        return Excel::download(new MultiPurposeExport($data), 'ACCOne Multipurpose Transaction '. date("Y-m-d") .'.xlsx');
    }
}
