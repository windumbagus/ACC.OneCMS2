<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterKotaController extends Controller
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
            'SubMenuId'=>"7" // "7" untuk SubMenu MasterKota

        ]);
         //API GET
         $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterKotaAPI/GetAllMasterKota?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $Hasils= json_decode($result);
        //  dd($Hasils);

        if(property_exists($Hasils,"IsSuccess")){
            return view(
                'master_kota',[
                    'Kotas' => $Hasils->Data,
                    'session' => $session
            ]);
        }else{
            return redirect('/invalid-permission');
        }  
    }

    public function show(Request $request)
    {
        //API GET
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterKotaAPI/GetMasterKotaById?MstCityId=".$request->Id; 
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

    public function add(Request $request)
    {
        $request->validate([
            'CITY_master_kota_add' => 'required',
            'CD_CITY_master_kota_add' => 'required|min:0',
            'CD_SP_master_kota_add' => 'required|min:0',
            'AREA_CODE_master_kota_add' => 'required|min:0',
            'CD_SP_COLL_master_kota_add' => 'required|min:0',
            'CD_PROVINSI_master_kota_add' => 'required|min:0',
            'DT_UPLOADED_master_kota_add' => 'required|date|after:yesterday',
            'DT_TRANSFER_master_kota_add' => 'required',            
            'CD_PROVINSI_master_kota_add' => 'required',
        ]);
        
        if($request->FLAG_ACTIVE_master_kota_add== "on"){
            $FLAG_ACTIVE = "Y";
        }else{
            $FLAG_ACTIVE = "N";
        }

        if($request->FLAG_TRANSFER_master_kota_add== "on"){
            $FLAG_TRANSFER = "Y";
        }else{
            $FLAG_TRANSFER = "N";
        }

        if($request->FLAG_SUB_AREA_CODE_master_kota_add== "on"){
            $FLAG_SUB_AREA_CODE = "Y";
        }else{
            $FLAG_SUB_AREA_CODE = "N";
        }

        $data = json_encode(array(
            "CD_CITY"=> $request->CD_CITY_master_kota_add,
            "CITY"=> $request->CITY_master_kota_add,
            "DT_ADDED"=> date("Y-m-d"),
            "ID_USER_ADDED"=> $request->session()->get('Id'),
            "FLAG_ACTIVE"=> $FLAG_ACTIVE,
            "FLAG_TRANSFER"=> $FLAG_TRANSFER,
            "DT_TRANSFER"=> $request->DT_TRANSFER_master_kota_add,
            "DT_UPLOADED"=> $request->DT_UPLOADED_master_kota_add,
            "CD_SP"=> $request->CD_SP_master_kota_add,
            "CD_SP_COLL"=> $request->CD_SP_COLL_master_kota_add,
            "AREA_CODE"=> $request->AREA_CODE_master_kota_add,
            "FLAG_SUB_AREA_CODE"=> $FLAG_SUB_AREA_CODE,
            "CD_PROVINSI"=> $request->CD_PROVINSI_master_kota_add
        )); 
        // dd($data);

        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterKotaAPI/CreateOrUpdateMasterKota"; 
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

        return redirect('/master-kota')->with('success','Master Kota Successfully Added !!!');;

    }

    public function update(Request $request)
    {
        $request->validate([
            'Id_master_kota_update'=>'required',
            'CITY_master_kota_update' => 'required',
            'CD_CITY_master_kota_update' => 'required|min:0',
            'CD_SP_master_kota_update' => 'required|min:0',
            'AREA_CODE_master_kota_update' => 'required|min:0',
            'CD_SP_COLL_master_kota_update' => 'required|min:0',
            'CD_PROVINSI_master_kota_update' => 'required|min:0',
            'DT_UPLOADED_master_kota_update' => 'required|date|after:yesterday',
            'DT_TRANSFER_master_kota_update' => 'required',            
            'CD_PROVINSI_master_kota_update' => 'required',
        ]);
        
        if($request->FLAG_ACTIVE_master_kota_update== "on"){
            $FLAG_ACTIVE = "Y";
        }else{
            $FLAG_ACTIVE = "N";
        }

        if($request->FLAG_TRANSFER_master_kota_update== "on"){
            $FLAG_TRANSFER = "Y";
        }else{
            $FLAG_TRANSFER = "N";
        }

        if($request->FLAG_SUB_AREA_CODE_master_kota_update== "on"){
            $FLAG_SUB_AREA_CODE = "Y";
        }else{
            $FLAG_SUB_AREA_CODE = "N";
        }

        $data = json_encode(array(
            "Id"=>$request->Id_master_kota_update,
            "CD_CITY"=> $request->CD_CITY_master_kota_update,
            "CITY"=> $request->CITY_master_kota_update,
            "DT_ADDED"=> date("Y-m-d"),
            "ID_USER_ADDED"=> $request->session()->get('Id'),
            "FLAG_ACTIVE"=> $FLAG_ACTIVE,
            "FLAG_TRANSFER"=> $FLAG_TRANSFER,
            "DT_TRANSFER"=> $request->DT_TRANSFER_master_kota_update,
            "DT_UPLOADED"=> $request->DT_UPLOADED_master_kota_update,
            "CD_SP"=> $request->CD_SP_master_kota_update,
            "CD_SP_COLL"=> $request->CD_SP_COLL_master_kota_update,
            "AREA_CODE"=> $request->AREA_CODE_master_kota_update,
            "FLAG_SUB_AREA_CODE"=> $FLAG_SUB_AREA_CODE,
            "CD_PROVINSI"=> $request->CD_PROVINSI_master_kota_update
        )); 
        // dd($data);

        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterKotaAPI/CreateOrUpdateMasterKota"; 
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

        return redirect('/master-kota')->with('success','Master Kota Successfully Updated !!!');;

    }

    public function delete($id = null,Request $request)
    {
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterKotaAPI/DeleteMasterKota?MstCityId=".$id;
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

        return redirect('/master-kota')->with('success','Data Master Kota Delete Successfull !!!');
    }

    public function Upload(Request $request)
    {
        $request->validate([
            'upload_master_kota' => 'required',
        ]);

        $file = $request->upload_master_kota;
        $x= file_get_contents($file);
        $y= base64_encode($x);

        $name = $file->getClientOriginalName();
        $data = json_encode(array(
            "Filename" => "$name",
            "Content" => $y,
        ));
        // dd($data);  

        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterKotaAPI/UploadMasterKota"; 
        $ch = curl_init($url);                   
        curl_setopt($ch, CURLOPT_POST, true);                                  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $data = json_decode($result);
        // dd($result);

        return redirect('/master-kota')->with('success','Data Master Kota Upload Successfull !!!');
    }
}
