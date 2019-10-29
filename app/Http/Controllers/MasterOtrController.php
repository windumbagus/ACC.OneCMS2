<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MasterOtrExport;
use Illuminate\Http\Request;

class MasterOtrController extends Controller
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
            'SubMenuId'=>"9" // "9" untuk SubMenu MasterOTR

        ]);
         //API GET MstOTR
         $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterOtrAPI/GetAllMasterOtr?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $Hasils= json_decode($result);
        //  dd($Hasils);

         //API GET GetMstGCMBrand
         $url2 = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterOtrAPI/GetMstGcmBrand"; 
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
                'master_otr',[
                    'OTRs' => $Hasils->Data,
                    'GetMstGCMSBrands'=>$Hasils2,
                    'session' => $session
            ]);
        }else{
            return redirect('/invalid-permission');
        }  
    }

    public function show(Request $request)
    {
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterOtrAPI/GetMasterOtrById?MstOtrId=".$request->Id; 
        // dd($url); 
        $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $val= json_decode($result);

         $url2 = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterOtrAPI/GetMstGcmType?Brand=".$request->Brand;
        //  dd($url);
         $ch2 = curl_init($url2); 
         curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch2, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result2 = curl_exec($ch2);
         $err2 = curl_error($ch2);
         curl_close($ch2);
         $val2= json_decode($result2);
        // dd($val2);

        
        $url3 = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterOtrAPI/GetMstGcmModel?Type=".urlencode($request->Type);
        //  dd($url3);
         $ch3 = curl_init($url3); 
         curl_setopt($ch3, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch3, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result3 = curl_exec($ch3);
         $err3 = curl_error($ch3);
         curl_close($ch3);
         $val3= json_decode($result3);
        // dd($result3);

         $data=[
             "GetMstOtrById"=>$val,
             "Type"=>$val2,
             "Model"=>$val3
         ];
        //  dd($result3);
         return json_encode($data);
    }

    public function add(Request $request)
    {
        $request->validate([
            "CD_BRAND_master_otr_add"=>'required',
            "DESC_BRAND_master_otr_add"=>'required',
            "CD_TYPE_master_otr_add"=>'required',
            "DESC_TYPE_master_otr_add"=>'required',
            "CD_MODEL_master_otr_add"=>'required',
            "DESC_MODEL_master_otr_add"=>'required',
            "TAHUN_master_otr_add"=>'required',
            "CD_SP_master_otr_add"=>'required',
            "CD_AREA_master_otr_add"=>'required',
            "OTR_master_otr_add"=>'required',          
        ]);


        if($request->IS_NEW_master_otr_add== "on"){
            $IS_NEW = "N";
        }else{
            $IS_NEW = "U";
        }

        if($request->IS_ACTIVE_master_otr_add== "on"){
            $IS_ACTIVE = "Y";
        }else{
            $IS_ACTIVE = "N";
        }

        $data = json_encode(array(
            // "Id"=> "$request->",
            "CD_BRAND"=> "$request->CD_BRAND_master_otr_add",
            "DESC_BRAND"=> "$request->DESC_BRAND_master_otr_add",
            "CD_TYPE"=> "$request->CD_TYPE_master_otr_add",
            "DESC_TYPE"=> "$request->DESC_TYPE_master_otr_add",
            "CD_MODEL"=> "$request->CD_MODEL_master_otr_add",
            "DESC_MODEL"=> "$request->DESC_MODEL_master_otr_add",
            "TAHUN"=> "$request->TAHUN_master_otr_add",
            "CD_SP"=> "$request->CD_SP_master_otr_add",
            "CD_AREA"=> "$request->CD_AREA_master_otr_add",
            "OTR"=> "$request->OTR_master_otr_add",
            "DEVIASI"=> "$request->DEVIASI_master_otr_add",            
            "FLAG_ACTIVE"=> $IS_ACTIVE,
            "FLAG_NEW_USED"=> $IS_NEW
        )); 
        // dd($data);

        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterOtrAPI/CreateOrUpdateMasterOtr"; 
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

        return redirect('/master-otr')->with('success','Master OTR Successfully Added !!!');
    }

    public function update(Request $request)
    {
        $request->validate([
            "CD_BRAND_master_otr_update"=>'required',
            "DESC_BRAND_master_otr_update"=>'required',
            "CD_TYPE_master_otr_update"=>'required',
            "DESC_TYPE_master_otr_update"=>'required',
            "CD_MODEL_master_otr_update"=>'required',
            "DESC_MODEL_master_otr_update"=>'required',
            "TAHUN_master_otr_update"=>'required',
            "CD_SP_master_otr_update"=>'required',
            "CD_AREA_master_otr_update"=>'required',
            "OTR_master_otr_update"=>'required',          
        ]);


        if($request->IS_NEW_master_otr_update== "on"){
            $IS_NEW = "N";
        }else{
            $IS_NEW = "U";
        }

        if($request->IS_ACTIVE_master_otr_update== "on"){
            $IS_ACTIVE = "Y";
        }else{
            $IS_ACTIVE = "N";
        }

        $data = json_encode(array(
            "Id"=> "$request->Id_master_otr_update",
            "CD_BRAND"=> "$request->CD_BRAND_master_otr_update",
            "DESC_BRAND"=> "$request->DESC_BRAND_master_otr_update",
            "CD_TYPE"=> "$request->CD_TYPE_master_otr_update",
            "DESC_TYPE"=> "$request->DESC_TYPE_master_otr_update",
            "CD_MODEL"=> "$request->CD_MODEL_master_otr_update",
            "DESC_MODEL"=> "$request->DESC_MODEL_master_otr_update",
            "TAHUN"=> "$request->TAHUN_master_otr_update",
            "CD_SP"=> "$request->CD_SP_master_otr_update",
            "CD_AREA"=> "$request->CD_AREA_master_otr_update",
            "OTR"=> "$request->OTR_master_otr_update",
            "DEVIASI"=> "$request->DEVIASI_master_otr_update",            
            "FLAG_ACTIVE"=> $IS_ACTIVE,
            "FLAG_NEW_USED"=> $IS_NEW
        )); 
        // dd($data);

        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterOtrAPI/CreateOrUpdateMasterOtr"; 
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

        return redirect('/master-otr')->with('success','Master OTR Successfully Updated !!!');
    }

    public function delete($id = null,Request $request)
    {
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterOtrAPI/DeleteMasterOtr?Id=".$id;
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

        return redirect('/master-otr')->with('success','Data Master OTR Delete Successfull !!!');
    }

    public function download()
    {// ubah -> memory_limit=256M di php.ini
        //API
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterOtrAPI/GetAllMasterOtr"; 
        $ch = curl_init($url);                                                     
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $Hasils = json_decode($result);
        // dd($Hasils);
        $data=[];
        foreach ($Hasils as $Hasil) {

            if (property_exists($Hasil->MstOtr, 'CD_SP')){
                $CD_SP = $Hasil->MstOtr->CD_SP;
            }else{
                $CD_SP = "";
            }

            if (property_exists($Hasil->MstOtr, 'CD_AREA')){
                $CD_AREA = $Hasil->MstOtr->CD_AREA;
            }else{
                $CD_AREA = "";
            }

            if (property_exists($Hasil->MstOtr, 'OTR')){
                $OTR = $Hasil->MstOtr->OTR;
            }else{
                $OTR = "";
            }

            if (property_exists($Hasil->MstOtr, 'DT_ADDED')){
                $DT_ADDED = $Hasil->MstOtr->DT_ADDED;
            }else{
                $DT_ADDED = "";
            }

            if (property_exists($Hasil->MstOtr, 'DT_UPDATED')){
                $DT_UPDATED = $Hasil->MstOtr->DT_UPDATED;
            }else{
                $DT_UPDATED = "";
            }

            if (property_exists($Hasil->MstOtr, 'DEVIASI')){
                $DEVIASI = $Hasil->MstOtr->DEVIASI;
            }else{
                $DEVIASI = "";
            }

          array_push($data,[
              "Id"=>$Hasil->MstOtr->Id,
              "CD_BRAND"=>$Hasil->MstOtr->CD_BRAND,
              "DESC_BRAND"=>$Hasil->MstOtr->DESC_BRAND,
              "CD_TYPE"=>$Hasil->MstOtr->CD_TYPE,
              "DESC_TYPE"=>$Hasil->MstOtr->DESC_TYPE,
              "CD_MODEL"=>$Hasil->MstOtr->CD_MODEL,
              "DESC_MODEL"=>$Hasil->MstOtr->DESC_MODEL,
              "TAHUN"=>$Hasil->MstOtr->TAHUN,
              "CD_SP"=>$CD_SP,
              "CD_AREA"=>$CD_AREA,
              "OTR"=>$OTR,
              "DEVIASI"=>$DEVIASI,
              "FLAG_ACTIVE"=>$Hasil->MstOtr->FLAG_ACTIVE,
              "DT_ADDED"=>$DT_ADDED,
              "DT_UPDATED"=>$DT_UPDATED,
              "FLAG_NEW_USED"=>$Hasil->MstOtr->FLAG_NEW_USED,
          ]);
        }
        // dd($data);
      
        return Excel::download(new MasterOtrExport($data), 'Master OTR '. date("Y-m-d") .'.xlsx');
    }

    public function GetMstGcmType($Brand = null ,Request $request)
    {
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterOtrAPI/GetMstGcmType?Brand=".$Brand;
        // dd($url);
        $ch = curl_init($url); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $data= json_decode($result);
        // dd($data);

        return json_encode($data);
    }

    public function GetMstGcmModel($Type = null ,Request $request)
    {
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterOtrAPI/GetMstGcmModel?Type=".$Type;
        // dd($url);
        $ch = curl_init($url); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $data= json_decode($result);
        // dd($data);

        return json_encode($data);
    }
}
