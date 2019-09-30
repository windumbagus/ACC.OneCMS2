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
            'RoleId'=>$request->session()->get('RoleId')
        ]);
        
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/PromoAPI/GetAllPromo"; 
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $Hasil = json_decode($result);
        //  dd($Hasils);

        return view('promo',[
            'Promos'=> $Hasil->MstPromo,
            'PromoTypes'=> $Hasil->PromoTypes,
            'session'=> $session            
        ]);  
    }

    public function show(Request $request)
    {
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/PromoAPI/ViewPromoById?MstPromo_Id=".$request->Id; 
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
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/PromoAPI/DeletePromoById?MstPromo_Id=".$id;
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

    public function CreateOrUpdate(Request $request)
    {
        // dd($request);
        
        $validator = Validator::make($request->all(), [
            'promo_MstPicture' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect('/promo')->with('error',' Create/Update Picture Failed!');
        }

        $file = $request->promo_MstPicture;
        $getContent = file_get_contents($file);
        $content= base64_encode($getContent);
        $name = $file->getClientOriginalName();
        $type = $file->extension();

        $MstPicture = array(
            "Picture" => $content,
            "FileName" => $name,
            "FileType" => "image/".$type,
        );
        // dd($MstPicture);
        
        $data = json_encode(array(
            "MstPromo" => array(
                "Id" => "$request->promo_MstPromo_Id",
                "Name" => "$request->promo_MstPromo_Name",
                "PromoCode" => "$request->promo_MstPromo_PromoCode",
                "Description" => "$request->promo_MstPromo_Description",
                "IsActivePromo" => "$request->promo_MstPromo_IsActivePromo",             
                "AddedDate" => "$request->promo_MstPromo_AddedDate",
                "UserAdded" => "$request->promo_MstPromo_UserAdded",
                "UpdatedDate" => "$request->promo_MstPromo_UpdatedDate",
                "UserUpdated" => "$request->promo_MstPromo_UserUpdated",
                "StartDate" => "$request->promo_MstPromo_StartDate",
                "EndDate" => "$request->promo_MstPromo_EndDate",
                "SyaratDanKetentuan" => "$request->promo_MstPromo_SyaratDanKetentuan",
                "PromoType" => "$request->promo_MstPromo_PromoType",
                "PromoAmount" => "$request->promo_MstPromo_PromoAmount",
                "ProductOwner" => "$request->promo_MstPromo_ProductOwner",
                "OrderName" => "$request->promo_MstPromo_OrderName",          
                "JenisPromo" => "$request->promo_MstPromo_JenisPromo",
                "TampilPeriodePromo" => "$request->promo_MstPromo_TampilPeriodePromo",             
                "URL" => "$request->promo_MstPromo_URL",
                "IsActiveBanner" => "$request->promo_MstPromo_IsActiveBanner"
            ),
            "MstPicture" => $MstPicture,
            "User_Id" => $request->promo_User_Id,
        )); 
        dd($data);

        // $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/PromoAPI/CreateOrUpdatePromo"; 
        // $ch = curl_init($url);                   
        // curl_setopt($ch, CURLOPT_POST, true);                                  
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        // $result = curl_exec($ch);
        // $err = curl_error($ch);
        // curl_close($ch);
        // $hasils = json_decode($result);
        // // dd($result);

        // return redirect('/promo')->with('success',' Add/Update Data Successfully!');
    }

    public function UpdateOrder(Request $request)
    {
        $data = json_encode(array(
            "MstPromoId" => "$request->MstPromoId",
            "SelectedOrderName" => "$request->SelectedOrderName",
        )); 
        // dd($data);

        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/PromoAPI/UpdatePromoOrderById"; 
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

        return $result;
    }

    public function CreateOrUpdatePicture(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'promo_MstPicture' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect('/promo')->with('error',' Create/Update Picture Failed!');
        }

        $file = $request->promo_MstPicture;
        $content= base64_encode(file_get_contents($file));
        $name = $file->getClientOriginalName();
        $type = $file->extension();

        $MstPicture = json_encode(array(
            "Picture" => $content,
            "FileName" => $name,
            "FileType" => "image/".$type,
        ));
        dd($MstPicture);  

        // $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/PromoAPI/CreateOrUpdatePicture"; 
        // $ch = curl_init($url);                   
        // curl_setopt($ch, CURLOPT_POST, true);                                  
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $MstPicture);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        // $result = curl_exec($ch);
        // $err = curl_error($ch);
        // curl_close($ch);
        // $hasils = json_decode($result);
        // dd($result);

        return redirect('/promo')->with('success',' Create/Update Picture Successfully!');
    }
}
