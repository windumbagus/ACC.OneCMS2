<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterContentController extends Controller
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
        
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterContentAPI/GetMasterContentByContentType"; 
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val = json_decode($result);
        // dd($val);

        return view('master_content',[
            'MstGCM_ContentTypeList'=> $val->MstGCM->ContentType,
            'MstGCM_StatusList'=> $val->MstGCM->ContentStatus,
            'MstGCM_CategoryList'=> $val->MstGCM->NewsCategory,
            'session'=> $session            
        ]);  
    }
    
    public function getByContentType(Request $request)
    {
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterContentAPI/GetMasterContentByContentType?MstGCM_ContentType=".urlencode($request->ContentType); 
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
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
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterContentAPI/ViewMasterContentById?MstContent_Id=".$request->Id; 
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

    public function delete(Request $request)
    {
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterContentAPI/DeleteMasterContentById?MstContent_Id=".$request->Id;
        // dd($url);        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val = json_decode($result);
        // dd($val);

        return json_encode($val);
    }

    public function create(Request $request)
    {
        // dd($request);
        if($request->addMasterContent_IsUpdatePicture=="true") {
            $file = $request->addMasterContent_MstPicture;
            $getContent = file_get_contents($file);
            $content= base64_encode($getContent);
            $name = $file->getClientOriginalName();
            $type = $file->extension();
            $MstPictureTemp = array(
                // "Id" => "$request->updateMasterContent_MstPicture_Id",
                // "DataId" => "$request->updateMasterContent_MstPicture_DataId",
                "Type" => "ContentManagement",
                "Picture" => $content,
                "FileName" => $name,
                "FileType" => "image/".$type,
            );
        } else {
            $MstPictureTemp = null;
        }
        
        $data = json_encode(
            array(
                "MstContent" => array(   
                    // "Id" => $request->addMasterContent_MstContent_Id,
                    "ContentType" => $request->addMasterContent_MstContent_ContentType,
                    "Order" => $request->addMasterContent_MstContent_Order,
                    "Title" => $request->addMasterContent_MstContent_Title,
                    "Snippet" => $request->addMasterContent_MstContent_Snippet,
                    "Detail" => $request->addMasterContent_MstContent_Description,
                    "Category" => $request->addMasterContent_MstContent_Category,
                    // "Picture" => $request->addMasterContent_MstContent_Picture,
                    // "FileName" => $request->addMasterContent_MstContent_FileName,
                    // "FileType" => $request->addMasterContent_MstContent_FileType,
                    "Status" => $request->addMasterContent_MstContent_Status,
                    // "AddedDate" => $request->addMasterContent_MstContent_AddedDate,
                    "UserAdded" => $request->addMasterContent_MstContent_UserAdded,
                    // "UpdatedDate" => $request->addMasterContent_MstContent_UpdatedDate,
                    // "UserUpdated" => $request->addMasterContent_MstContent_UserUpdated,
                    "ProductOwner" => $request->addMasterContent_MstContent_ProductOwner,
                ),
                "MstPicture" => $MstPictureTemp,
            )
        );
        // dd($data);

        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterContentAPI/CreateOrUpdateMasterContent"; 
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

        if(property_exists($val, 'Success') && ($val->Success)) {
            return redirect('/master-content')->with('success',' Add Data Successfully!');
        } elseif(property_exists($val, 'Error')) {
            return redirect('/master-content')->with('error', $val->Error);
        } elseif(property_exists($val, 'Errors')) {
            return redirect('/master-content')->with('error', $val->Errors);
        } else {
            return redirect('/master-content')->with('error',' Add Data Failed!');
        }
    }

    public function update(Request $request)
    {
        // dd($request);
        if($request->updateMasterContent_IsUpdatePicture=="true") {
            $file = $request->updateMasterContent_MstPicture;
            $getContent = file_get_contents($file);
            $content= base64_encode($getContent);
            $name = $file->getClientOriginalName();
            $type = $file->extension();
            $MstPictureTemp = array(
                "Id" => $request->updateMasterContent_MstPicture_Id,
                "DataId" => $request->updateMasterContent_MstPicture_DataId,
                "Type" => "ContentManagement",
                "Picture" => $content,
                "FileName" => $name,
                "FileType" => "image/".$type,
            );
        } else {
            $MstPictureTemp = null;
        }
        
        $data = json_encode(
            array(
                "MstContent" => array(   
                    "Id" => $request->updateMasterContent_MstContent_Id,
                    "ContentType" => $request->updateMasterContent_MstContent_ContentType,
                    "Order" => $request->updateMasterContent_MstContent_Order,
                    "Title" => $request->updateMasterContent_MstContent_Title,
                    "Snippet" => $request->updateMasterContent_MstContent_Snippet,
                    "Detail" => $request->updateMasterContent_MstContent_Description,
                    "Category" => $request->updateMasterContent_MstContent_Category,
                    // "Picture" => $request->updateMasterContent_MstContent_Picture,
                    // "FileName" => $request->updateMasterContent_MstContent_FileName,
                    // "FileType" => $request->updateMasterContent_MstContent_FileType,
                    "Status" => $request->updateMasterContent_MstContent_Status,
                    "AddedDate" => $request->updateMasterContent_MstContent_AddedDate,
                    "UserAdded" => $request->updateMasterContent_MstContent_UserAdded,
                    // "UpdatedDate" => $request->updateMasterContent_MstContent_UpdatedDate,
                    "UserUpdated" => $request->updateMasterContent_MstContent_UserUpdated,
                    "ProductOwner" => $request->updateMasterContent_MstContent_ProductOwner,
                ),
                "MstPicture" => $MstPictureTemp,
            )
        );
        // dd($data);

        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterContentAPI/CreateOrUpdateMasterContent"; 
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

        if(property_exists($val, 'Success') && ($val->Success)) {
            return redirect('/master-content')->with('success',' Update Data Successfully!');
        } elseif(property_exists($val, 'Error')) {
            return redirect('/master-content')->with('error', $val->Error);
        } elseif(property_exists($val, 'Errors')) {
            return redirect('/master-content')->with('error', $val->Errors);
        } else {
            return redirect('/master-content')->with('error',' Update Data Failed!');
        }
    }

    public function checkContentOrder(Request $request)
    {
        $data = json_encode(
            array(
                "MstContent_Order" => "$request->MstContent_Order",
                "MstContent_ContentType" => "$request->MstContent_ContentType",
            )
        ); 
        // dd($data);
        
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterContentAPI/CheckMasterContentOrder"; 
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

    public function checkContentTitle(Request $request)
    {
        $data = json_encode(
            array(
                "MstContent_Title" => "$request->MstContent_Title",
                "MstContent_ContentType" => "$request->MstContent_ContentType",
            )
        ); 
        // dd($data);
        
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterContentAPI/CheckMasterContentTitle"; 
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

    public function checkContentStatus(Request $request)
    {
        $data = json_encode(
            array(
                "MstContent_Status" => "$request->MstContent_Status",
                "MstContent_ContentType" => "$request->MstContent_ContentType",
            )
        ); 
        // dd($data);
        
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterContentAPI/CheckMasterContentStatus"; 
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
}
