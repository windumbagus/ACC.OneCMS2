<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterProductAccOneController extends Controller
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
            'SubMenuId'=>"36" // "36" untuk SubMenu MasterProductAccOne

        ]);
         //API GET
         $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterProductAccOneAPI/GetAllProductAccOne?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $Hasils= json_decode($result);
        //  dd($Hasils);

        if((property_exists($Hasils,"Role")) && ($Hasils->Role->IsView == True)){
            return view(
                'master_product_accone',[
                    'Role' => $Hasils->Role,
                    'ProductsAccOne'=>$Hasils->Data,
                    'session' => $session
            ]);
        }else{
            return redirect('/invalid-permission');
        }  
    }

    public function show(Request $request)
    {
        //API GET
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterProductAccOneAPI/GetProductAccOneById?ProductAccOneId=".$request->Id; 
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

    public function deleteAll(Request $request)
    {
        //API GET
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterProductAccOneAPI/DeleteAllProductAccOne"; 
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
        return redirect('/master-product-accone')->with('success','Master Product ACC One Delete Successfull !!!');   
    }

    public function upload(Request $request)
    {
        $request->validate([
            'upload_master_product_accone' => 'required',
        ]);
        $file = $request->upload_master_product_accone;
        $x= file_get_contents($file);
        $y= base64_encode($x);

        // $Base64File= base64_encode($file);
        // $x= base64_decode($Base64File);
        // $xFile = $file->getPathName();
        // $cFile = curl_file_create($file);
        // dd($file);
        // dd($x);
        $name = $file->getClientOriginalName();
        $data = json_encode(array(
            "Filename" => "$name",
            "Content" => $y,
        ));
        // dd($data);  

        $url = "https://acc-dev1.outsystemsenterprise.com//ACCWorldCMS/rest/MasterProductAccOneAPI/UploadProductAccOne"; 
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

        return redirect('/master-product-accone')->with('success',$data->ErrorMessage);
    }

}
