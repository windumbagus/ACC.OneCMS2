<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterProductController extends Controller
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
         //API GET
         $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterProductAPI/GetAllMasterProduct"; 
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $Hasils= json_decode($result);
        //  dd($Hasils);

        return view('master_product',[
            'Products'=>$Hasils->MstProduct,
            'CharDescs'=>$Hasils->CharDesc,
            'CharValues'=>$Hasils->CharValue,            
            'session' => $session                        
            ]);    
    }

    public function show(Request $request)
    {
         //API GET
         $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterProductAPI/GetMasterProductById?MstProductId=".$request->Id; 
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $val= json_decode($result);
        //  dd($Hasils);

        return json_encode($val);
    }

    public function update(Request $request)
    {

        if ($request->PictureInput==""){
            $content = "";
            $name = "";
            $FileType = "";
        }else{
            $file = $request->PictureInput;
            $getContent = file_get_contents($file);
            $content= base64_encode($getContent);
            $name = $file->getClientOriginalName();
            $type = $file->extension();
            $FileType= "image/".$type;
        }


        $data = json_encode(array(
            "MstProduct" => array(   
                "Id" => $request->Id,
                "MstPictureId" => $request->MstPictureId,
                "ProductCode" =>$request->ProductCode,
                "ProductName" =>$request->ProductName,
                "Description" =>$request->Description,
                "Pernyataan1" =>$request->Pernyataan1,
                "Pernyataan2" =>$request->Pernyataan2,
                "Pernyataan3" =>$request->Pernyataan3,
                "MappingAnswerCharValue" =>$request->MappingAnswerCharValue,
                "MappingAnswerDesc" =>$request->MappingAnswerDesc,
                "UserUpdated"=> $request->session()->get('Id')
            ),
            "MstPicture" => array(
                "Id" => "$request->IdPicture",
                "DataId"=>$request->DataId,
                "Type" => "ACCSAFEPRODUCT",
                "Picture" => $content,
                "FileName" => $name,
                "FileType" =>$FileType
            ),
        )); 
        // dd($data);

        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterProductAPI/CreateOrUpdateMasterProduct"; 
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

        return redirect("master-product")->with('success','Data Master Product Update Successfull !!!');
    }

    public function SyncApiProduct(Request $request )
    {
        //API GET
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterProductAPI/SyncProduct"; 
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $Hasils= json_decode($result);
        // dd($Hasils);  

        return redirect("master-product")->with('success','Data Master Product "Sync API to Product" Successfull !!!');

    }
}
