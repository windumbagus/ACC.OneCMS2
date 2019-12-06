<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PromoController extends Controller
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
            'SubMenuId'=>"1"
        ]);
        
        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/PromoAPI/GetAllPromo?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"];    
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $Hasils = json_decode($result);
        //  dd($Hasil);

        if((property_exists($Hasils,"Role")) && ($Hasils->Role->IsView == True)){
            return view('promo',[
                'Role' => $Hasils->Role,
                'Promos'=> $Hasils->Data->MstPromo,
                'PromoTypes'=> $Hasils->Data->PromoTypes,
                'session'=> $session            
            ]);        
        }else{
            return redirect('/invalid-permission');
        }  
    }

    public function show(Request $request)
    {
        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/PromoAPI/ViewPromoById?MstPromo_Id=".$request->Id; 
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
        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/PromoAPI/DeletePromoById?MstPromo_Id=".$id;
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

        return redirect('/promo')->with('success',' Delete Data Successfully!');
    }

    public function create(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'addPromo_MstPicture' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect('/promo')->with('error',' Upload Picture Failed!');
        }
        $file = $request->addPromo_MstPicture;
        $getContent = file_get_contents($file);
        $content= base64_encode($getContent);
        $name = $file->getClientOriginalName();
        $type = $file->extension();

        if ($request->addPromo_MstPromo_IsActivePromo == "") {
            $request->addPromo_MstPromo_IsActivePromo = "false";
        } else {
            $request->addPromo_MstPromo_IsActivePromo = "true";
        };
        if ($request->addPromo_MstPromo_IsActiveBanner == "") {
            $request->addPromo_MstPromo_IsActiveBanner = "false";
        } else {
            $request->addPromo_MstPromo_IsActiveBanner = "true";
        };
        if ($request->addPromo_MstPromo_TampilPeriodePromo == "") {
            $request->addPromo_MstPromo_TampilPeriodePromo = "false";
        } else {
            $request->addPromo_MstPromo_TampilPeriodePromo = "true";
        };
        
        $data = json_encode(array(
            "MstPromo" => array(   
                // "Id" => "$request->updatePromo_MstPromo_Id",    
                "Name" => "$request->addPromo_MstPromo_Name",
                "PromoCode" => "$request->addPromo_MstPromo_PromoCode",
                "Description" => "$request->addPromo_MstPromo_Description",
                "IsActivePromo" => "$request->addPromo_MstPromo_IsActivePromo",
                "IsActiveBanner" => "$request->addPromo_MstPromo_IsActiveBanner",
                "TampilPeriodePromo" => "$request->addPromo_MstPromo_TampilPeriodePromo", 
                // "OrderName" => "$request->addPromo_MstPromo_OrderName", 
                "PromoType" => "$request->addPromo_MstPromo_PromoType",          
                "JenisPromo" => "$request->addPromo_MstPromo_JenisPromo",
                "PromoAmount" => "$request->addPromo_MstPromo_PromoAmount", 
                "SyaratDanKetentuan" => "$request->addPromo_MstPromo_SyaratDanKetentuan",   
                "URL" => "$request->addPromo_MstPromo_URL",           
                // "AddedDate" => "$request->addPromo_MstPromo_AddedDate",
                "UserAdded" => "$request->addPromo_MstPromo_UserAdded",
                // "UpdatedDate" => "$request->addPromo_MstPromo_UpdatedDate",
                // "UserUpdated" => "$request->addPromo_MstPromo_UserUpdated",
                "ProductOwner" => "$request->addPromo_MstPromo_ProductOwner",
            ),
            "MstPicture" => array(
                // "Id" => "$request->updatePromo_MstPicture_Id",
                // "DataId" => "$request->updatePromo_MstPicture_DataId",
                "Type" => "Promo",
                "Picture" => $content,
                "FileName" => $name,
                "FileType" => "image/".$type,
            ),
            "MstPromo_StartDate" => $request->addPromo_MstPromo_StartDate,
            "MstPromo_EndDate" => $request->addPromo_MstPromo_EndDate,
        )); 
        // dd($data);

        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/PromoAPI/CreateOrUpdatePromo"; 
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

        if(property_exists($Hasils, 'Success') && ($Hasils->Success)) {
            return redirect('/promo')->with('success',' Add Data Successfully!');
        } elseif(property_exists($Hasils, 'Error')) {
            return redirect('/promo')->with('error', $Hasils->Error);
        } elseif(property_exists($Hasils, 'Errors')) {
            return redirect('/promo')->with('error', $Hasils->Errors);
        } else {
            return redirect('/promo')->with('error',' Add Data Failed!');
        }
    }

    public function update(Request $request)
    {
        // dd($request);
        if ($request->updatePromo_IsUpdatePicture=="true") {
            $validator = Validator::make($request->all(), [
                'updatePromo_MstPicture' => 'required'
            ]);
            if ($validator->fails()) {
                return redirect('/promo')->with('error',' Upload Picture Failed!');
            }
            $file = $request->updatePromo_MstPicture;
            $getContent = file_get_contents($file);
            $content= base64_encode($getContent);
            $name = $file->getClientOriginalName();
            $type = $file->extension();

            $TempMstPicture = array(
                "Id" => "$request->updatePromo_MstPicture_Id",
                "DataId" => "$request->updatePromo_MstPicture_DataId",
                "Type" => "$request->updatePromo_MstPicture_Type",
                "Picture" => $content,
                "FileName" => $name,
                "FileType" => "image/".$type,
            );
        } else {
            $TempMstPicture = array(
                "FileName" => "",
                "FileType" => "",
            );
        }

        if ($request->updatePromo_MstPromo_IsActivePromo == "") {
            $request->updatePromo_MstPromo_IsActivePromo = "false";
        } else {
            $request->updatePromo_MstPromo_IsActivePromo = "true";
        };
        if ($request->updatePromo_MstPromo_IsActiveBanner == "") {
            $request->updatePromo_MstPromo_IsActiveBanner = "false";
        } else {
            $request->updatePromo_MstPromo_IsActiveBanner = "true";
        };
        if ($request->updatePromo_MstPromo_TampilPeriodePromo == "") {
            $request->updatePromo_MstPromo_TampilPeriodePromo = "false";
        } else {
            $request->updatePromo_MstPromo_TampilPeriodePromo = "true";
        };

        $data = json_encode(array(
            "MstPromo" => array(         
                "Id" => "$request->updatePromo_MstPromo_Id",
                "Name" => "$request->updatePromo_MstPromo_Name",
                "PromoCode" => "$request->updatePromo_MstPromo_PromoCode",
                "Description" => "$request->updatePromo_MstPromo_Description",
                "IsActivePromo" => "$request->updatePromo_MstPromo_IsActivePromo",
                "IsActiveBanner" => "$request->updatePromo_MstPromo_IsActiveBanner",
                "TampilPeriodePromo" => "$request->updatePromo_MstPromo_TampilPeriodePromo", 
                "OrderName" => "$request->updatePromo_MstPromo_OrderName", 
                "PromoType" => "$request->updatePromo_MstPromo_PromoType",          
                "JenisPromo" => "$request->updatePromo_MstPromo_JenisPromo",
                "PromoAmount" => "$request->updatePromo_MstPromo_PromoAmount", 
                "SyaratDanKetentuan" => "$request->updatePromo_MstPromo_SyaratDanKetentuan",   
                "URL" => "$request->updatePromo_MstPromo_URL",           
                "AddedDate" => "$request->updatePromo_MstPromo_AddedDate",
                "UserAdded" => "$request->updatePromo_MstPromo_UserAdded",
                // "UpdatedDate" => "$request->updatePromo_MstPromo_UpdatedDate",
                "UserUpdated" => "$request->updatePromo_MstPromo_UserUpdated",
                "ProductOwner" => "$request->updatePromo_MstPromo_ProductOwner",
            ),
            "MstPicture" => $TempMstPicture,
            "MstPromo_StartDate" => $request->updatePromo_MstPromo_StartDate,
            "MstPromo_EndDate" => $request->updatePromo_MstPromo_EndDate,
        )); 
        // dd($data);

        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/PromoAPI/CreateOrUpdatePromo"; 
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

        if(property_exists($Hasils, 'Success') && ($Hasils->Success)) {
            return redirect('/promo')->with('success',' Update Data Successfully!');
        } elseif(property_exists($Hasils, 'Error')) {
            return redirect('/promo')->with('error', $Hasils->Error);
        } elseif(property_exists($Hasils, 'Errors')) {
            return redirect('/promo')->with('error', $Hasils->Errors);
        } else {
            return redirect('/promo')->with('error',' Update Data Failed!');
        }
    }

    public function UpdateOrder(Request $request)
    {
        $data = json_encode(array(
            "MstPromoId" => "$request->MstPromoId",
            "SelectedOrderName" => "$request->SelectedOrderName",
        )); 
        // dd($data);

        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/PromoAPI/UpdatePromoOrderById"; 
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
        // dd($result);

        return $result;
    }
}
