<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
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
            'SubMenuId'=>"40" // "40" untuk SubMenu MasterLandingPage

        ]);
        
        $role = json_encode(array(  
            // "Id"=> $request->Id_add,
            "ROLEID"=>$request->session()->get('RoleId'),
        
        ));

        $urlrole = config('global.base_url_outsystems').'/ACCWorldCMS/rest/CheckRoleAPI/CheckRole';

        $chrole = curl_init($urlrole);                   
        curl_setopt($chrole, CURLOPT_POST, true);                                  
        curl_setopt($chrole, CURLOPT_POSTFIELDS, $role);
        curl_setopt($chrole, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($chrole, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($chrole, CURLOPT_RETURNTRANSFER, true);                                                                  
        $resultrole = curl_exec($chrole);
        $errrole = curl_error($chrole);
        curl_close($chrole);
        $Hasilsrole= json_decode($resultrole);
        //dd($Hasilsrole);

        $datacount = json_encode(array(
            "doTransactionApply" => array(   
                // "Id"=> $request->Id_add,
                "P_GUID"=>"",
                "TRANSACTION_CODE"=>"GET_APPLY",
                "P_STATUS"=>"PENDING",
            ),
        ));

        $urlcount = config('global.base_url_sofia').'/restV2/acccash/getdata/transactionapply';

        $chcount = curl_init($urlcount);                   
        curl_setopt($chcount, CURLOPT_POST, true);                                  
        curl_setopt($chcount, CURLOPT_POSTFIELDS, $datacount);
        curl_setopt($chcount, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($chcount, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($chcount, CURLOPT_RETURNTRANSFER, true);                                                                  
        $resultcount = curl_exec($chcount);
        $errcount = curl_error($chcount);
        curl_close($chcount);
        $Hasilscount= json_decode($resultcount); 

        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/LandingPageAPI/GetAllLandingPage?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
    //    dd($url);
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $Hasils = json_decode($result);
        // dd($Hasils);

        if((property_exists($Hasils,"Role")) && ($Hasils->Role->IsView == True)){
            return view(
                'landing_page',[
                    'Role' => $Hasils->Role,
                    'MstLandingPageList' => $Hasils->Data->MstLandingPageList,
                    'LandingPageCategoryList'=> $Hasils->Data->LandingPageCategoryList,  
                    'LandingPageSubCategoryList'=> array(null),
                    'role'=> $Hasilsrole->OUT_DATA, 
                    'countpendingacccash'=>count($Hasilscount->OUT_DATA[0]->dataApply),
                    'session' => $session
            ]);
        }else{
            return redirect('/invalid-permission');
        }  
    }

    public function show(Request $request)
    {
        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/LandingPageAPI/GetLandingPageById?Input=".$request->Id; 
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

    public function getSubCategory(Request $request)
    {
        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/LandingPageAPI/GetLandingPageSubCategoryByCategory?Input=".$request->Category; 
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
        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/LandingPageAPI/DeleteLandingPageById?Input=".$id;
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

        return redirect('/landing-page')->with('success',' Delete Data Successfully!');
    }

    public function create(Request $request)
    {
        // dd($request);
        $file = $request->addLandingPage_MstPicture;
        $getContent = file_get_contents($file);
        $content= base64_encode($getContent);
        $name = $file->getClientOriginalName();
        $type = $file->extension();
        $MstPicture = array(
            // "Id" => $request->updateMasterContent_MstPicture_Id,
            // "DataId" => $request->updateMasterContent_MstPicture_DataId,
            "Type" => "LandingPage",
            "Picture" => $content,
            "FileName" => $name,
            "FileType" => "image/".$type,
        );
        date_default_timezone_set('Asia/Jakarta');
        $currDate = date('Y/m/d', time());
        $tempCategory = $request->addLandingPage_MstLandingPage_Category."/".$request->addLandingPage_MstLandingPage_SubCategory;
        $data = json_encode(
            array(
                "MstLandingPage" => array(   
                    // "Id" => $request->addLandingPage_MstLandingPage_Id,
                    "Category" => $tempCategory,
                    "Description" => $request->addLandingPage_MstLandingPage_Description,
                    // "Type" => $request->addLandingPage_MstLandingPage_Type,
                    "DtAdded" => $currDate,
                    // "DtUpdated" => $currDate,
                ),
                "MstPicture" => $MstPicture,
            )
        );
        // dd($data);

        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/LandingPageAPI/CreateOrUpdateLandingPage"; 
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
            return redirect('/landing-page')->with('success',' Add Data Successfully!');
        } elseif(property_exists($val, 'Error')) {
            return redirect('/landing-page')->with('error', $val->Error);
        } elseif(property_exists($val, 'Errors')) {
            return redirect('/landing-page')->with('error', $val->Errors);
        } else {
            return redirect('/landing-page')->with('error',' Add Data Failed!');
        }
    }

    public function update(Request $request)
    {
        // dd($request);
        if($request->updateLandingPage_IsUpdatePicture=="true") {
            $file = $request->updateLandingPage_MstPicture;
            $getContent = file_get_contents($file);
            $content= base64_encode($getContent);
            $name = $file->getClientOriginalName();
            $type = $file->extension();
            $tempMstPicture = array(
                "Id" => $request->updateMasterContent_MstPicture_Id,
                "DataId" => $request->updateMasterContent_MstPicture_DataId,
                "Type" => "LandingPage",
                "Picture" => $content,
                "FileName" => $name,
                "FileType" => "image/".$type,
            );
        } else {
            $tempMstPicture = null;
        }
        date_default_timezone_set('Asia/Jakarta');
        $currDate = date('Y/m/d', time());
        $tempCategory = $request->updateLandingPage_MstLandingPage_Category."/".$request->updateLandingPage_MstLandingPage_SubCategory;
        $data = json_encode(
            array(
                "MstLandingPage" => array(   
                    "Id" => $request->updateLandingPage_MstLandingPage_Id,
                    "Category" => $tempCategory,
                    "Description" => $request->updateLandingPage_MstLandingPage_Description,
                    "Type" => $request->updateLandingPage_MstLandingPage_Type,
                    "DtAdded" => $request->updateLandingPage_MstLandingPage_DtAdded,
                    "DtUpdated" => $currDate,
                ),
                "MstPicture" => $tempMstPicture,
            )
        );
        // dd($data);

        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/LandingPageAPI/CreateOrUpdateLandingPage"; 
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
            return redirect('/landing-page')->with('success',' Update Data Successfully!');
        } elseif(property_exists($val, 'Error')) {
            return redirect('/landing-page')->with('error', $val->Error);
        } elseif(property_exists($val, 'Errors')) {
            return redirect('/landing-page')->with('error', $val->Errors);
        } else {
            return redirect('/landing-page')->with('error',' Update Data Failed!');
        }
    }

    public function checkCategory(Request $request)
    {
        $data = json_encode(
            array(
                "MstLandingPage_Id" => "$request->MstLandingPage_Id",
                "MstLandingPage_Category" => "$request->MstLandingPage_Category",
            )
        ); 
        // dd($data);
        
        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/LandingPageAPI/CheckLandingPageCategory"; 
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
