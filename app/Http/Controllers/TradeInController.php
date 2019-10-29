<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TradeInExport;

class TradeInController extends Controller
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
            'SubMenuId'=>"12" // "12" untuk SubMenu TradeIn

        ]);

         //API GET
         $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/TradeInListAPI/GetAllTradeInList?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
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
         $url2 = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/TradeInListAPI/GetTransactionStatus"; 
         $ch2 = curl_init($url2);                                                     
         curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch2, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result2 = curl_exec($ch2);
         $err2 = curl_error($ch2);
         curl_close($ch2);
         $Hasils2= json_decode($result2);
        //  dd($Hasils2);
        
        if(property_exists($Hasils,"IsSuccess")){
            return view(
                'trade_in',[
                    'TradeIns'=>$Hasils->Data,
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

        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/TradeInListAPI/GetAllTradeInListByCondition"; 
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
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/TradeInListAPI/GetTradeInById?MappingTransaksiId=".$request->Id; 
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

    public function delete($id = null,Request $request)
    {
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/TradeInListAPI/DeleteTradeIn/?MappingTransaksiId=".$id;
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
            return redirect('/trade-in')->with('success',$val->Message);
        }else{
            return redirect('/trade-in')->with('error',$val->Message);
        }
    }

    public function approve(Request $request)
    {
        //API GET
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/TradeInListAPI/Approved?MappingTransaksiId=".$request->MappingTransaksiId; 
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
            return redirect('/trade-in')->with('success','Data Approved Successfull !!!');
        }else{
            return redirect('/trade-in')->with('error',$val->Message);
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

        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/TradeInListAPI/GetAllTradeInListByCondition"; 
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


            if (property_exists($Hasil->MstTransaksiPribadi, 'TransactionDate')){
                $TransactionDatePribadi = $Hasil->MstTransaksiPribadi->TransactionDate;
            }else{
                $TransactionDatePribadi = "";
            }
            if (property_exists($Hasil->MstTransaksiPribadi, 'Brand')){
                $BrandPribadi = $Hasil->MstTransaksiPribadi->Brand;
            }else{
                $BrandPribadi = "";
            }
            if (property_exists($Hasil->MstTransaksiPribadi, 'KodeBrand')){
                $KodeBrandPribadi = $Hasil->MstTransaksiPribadi->KodeBrand;
            }else{
                $KodeBrandPribadi = "";
            }
            if (property_exists($Hasil->MstTransaksiPribadi, 'Type')){
                $TypePribadi = $Hasil->MstTransaksiPribadi->Type;
            }else{
                $TypePribadi = "";
            }
            if (property_exists($Hasil->MstTransaksiPribadi, 'KodeType')){
                $KodeTypePribadi = $Hasil->MstTransaksiPribadi->KodeType;
            }else{
                $KodeTypePribadi = "";
            }
            if (property_exists($Hasil->MstTransaksiPribadi, 'Model')){
                $ModelPribadi = $Hasil->MstTransaksiPribadi->Model;
            }else{
                $ModelPribadi = "";
            }
            if (property_exists($Hasil->MstTransaksiPribadi, 'KodeModel')){
                $KodeModelPribadi = $Hasil->MstTransaksiPribadi->KodeModel;
            }else{
                $KodeModelPribadi = "";
            }
            if (property_exists($Hasil->MstTransaksiPribadi, 'Tahun')){
                $TahunPribadi = $Hasil->MstTransaksiPribadi->Tahun;
            }else{
                $TahunPribadi = "";
            }
            if (property_exists($Hasil->MstTransaksiPribadi, 'MRP')){
                $MRPPribadi = $Hasil->MstTransaksiPribadi->MRP;
            }else{
                $MRPPribadi = "";
            }
            if (property_exists($Hasil->MstTransaksiPribadi, 'Lokasi')){
                $LokasiPribadi = $Hasil->MstTransaksiPribadi->Lokasi;
            }else{
                $LokasiPribadi = "";
            }
            if (property_exists($Hasil->MstTransaksiPribadi, 'UnitId')){
                $UnitIdPribadi = $Hasil->MstTransaksiPribadi->UnitId;
            }else{
                $UnitIdPribadi = "0";
            }
            if (property_exists($Hasil->MstTransaksiPribadi, 'FlagNewExist')){
                $FlagNewExistPribadi = $Hasil->MstTransaksiPribadi->FlagNewExist;
            }else{
                $FlagNewExistPribadi = "FALSE";
            }
            if (property_exists($Hasil->MstTransaksiPribadi, 'FlagBPKB')){
                $FlagBPKBPribadi = $Hasil->MstTransaksiPribadi->FlagBPKB;
            }else{
                $FlagBPKBPribadi = "N";
            }
            
            
            if (property_exists($Hasil->MstTransaksiMasaDepan, 'TransactionDate')){
                $TransactionDateMasaDepan = $Hasil->MstTransaksiMasaDepan->TransactionDate;
            }else{
                $TransactionDateMasaDepan = "";
            }
            if (property_exists($Hasil->MstTransaksiMasaDepan, 'Brand')){
                $BrandMasaDepan = $Hasil->MstTransaksiMasaDepan->Brand;
            }else{
                $BrandMasaDepan = "";
            }
            if (property_exists($Hasil->MstTransaksiMasaDepan, 'KodeBrand')){
                $KodeBrandMasaDepan = $Hasil->MstTransaksiMasaDepan->KodeBrand;
            }else{
                $KodeBrandMasaDepan = "";
            }
            if (property_exists($Hasil->MstTransaksiMasaDepan, 'Type')){
                $TypeMasaDepan = $Hasil->MstTransaksiMasaDepan->Type;
            }else{
                $TypeMasaDepan = "";
            }
            if (property_exists($Hasil->MstTransaksiMasaDepan, 'KodeType')){
                $KodeTypeMasaDepan = $Hasil->MstTransaksiMasaDepan->KodeType;
            }else{
                $KodeTypeMasaDepan = "";
            }
            if (property_exists($Hasil->MstTransaksiMasaDepan, 'Model')){
                $ModelMasaDepan = $Hasil->MstTransaksiMasaDepan->Model;
            }else{
                $ModelMasaDepan = "";
            }
            if (property_exists($Hasil->MstTransaksiMasaDepan, 'KodeModel')){
                $KodeModelMasaDepan = $Hasil->MstTransaksiMasaDepan->KodeModel;
            }else{
                $KodeModelMasaDepan = "";
            }
            if (property_exists($Hasil->MstTransaksiMasaDepan, 'Tahun')){
                $TahunMasaDepan = $Hasil->MstTransaksiMasaDepan->Tahun;
            }else{
                $TahunMasaDepan = "";
            }
            if (property_exists($Hasil->MstTransaksiMasaDepan, 'MRP')){
                $MRPMasaDepan = $Hasil->MstTransaksiMasaDepan->MRP;
            }else{
                $MRPMasaDepan = "";
            }
            if (property_exists($Hasil->MstTransaksiMasaDepan, 'Lokasi')){
                $LokasiMasaDepan = $Hasil->MstTransaksiMasaDepan->Lokasi;
            }else{
                $LokasiMasaDepan = "";
            }
            array_push($data,[
                "Username"=>$Name,
                "TransactionDate"=>$TransactionDatePribadi,
                "Brand"=>$BrandPribadi,
                "KodeBrand"=>$KodeBrandPribadi,
                "Type"=>$TypePribadi,
                "KodeType"=>$KodeTypePribadi,
                "Model"=>$ModelPribadi,
                "KodeModel"=>$KodeModelPribadi,
                "Tahun"=>$TahunPribadi,
                "MRP"=>$MRPPribadi,
                "Lokasi"=>$LokasiPribadi,
                "UnitId"=>$UnitIdPribadi,
                "FlagNewExist"=>$FlagNewExistPribadi,
                "FlagBPKB"=>$FlagBPKBPribadi,
                "TransactionDateMasaDepan"=>$TransactionDateMasaDepan,
                "BrandMasaDepan"=>$BrandMasaDepan,
                "KodeBrandMasaDepan"=>$KodeBrandMasaDepan,
                "TypeMasaDepan"=>$TypeMasaDepan,
                "KodeTypeMasaDepan"=>$KodeTypeMasaDepan,
                "ModelMasaDepan"=>$ModelMasaDepan,
                "KodeModelMasaDepan"=>$KodeModelMasaDepan,
                "TahunMasaDepan"=>$TahunMasaDepan,
                "MRPMasaDepan"=>$MRPMasaDepan,
                "LokasiMasaDepan"=>$LokasiMasaDepan,
            ]);
        }
        // dd($data);
        return Excel::download(new TradeInExport($data), 'ACCOne Trade In '. date("Y-m-d") .'.xlsx');
    }
}
