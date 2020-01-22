<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterSearchingController extends Controller
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
            'SubMenuId'=>"14" // "14" untuk SubMenu MasterSearching,
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

         //API GET
         $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/MasterSearchingAPI/GetAllMasterSearching?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"];
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
            return view('master_searching',[
                'Role' => $Hasils->Role,
                'Searching'=>$Hasils->Data->MstSearch,
                'MenuItems'=>$Hasils->Data->MenuItem,
                'Screens'=>$Hasils->Data->Screen,
                'role'=> $Hasilsrole->OUT_DATA, 
                'session' => $session                        
                ]);
            }else{
                return redirect('/invalid-permission');
            }      
    }

    public function show(Request $request)
    {
        //API GET
        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/MasterSearchingAPI/GetMasterSearchingById?MstSearchId=".$request->Id; 
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val= json_decode($result);
        // dd($Hasils);
        return json_encode($val);
    
    }

    public function add(Request $request)
    {
        $data = json_encode(
            array("UserId"=> $request->session()->get('Id'),
                "MstSearch"=>array(
                    // "Id"=> $request->id_update,
                    "Input_Keyword"=> $request->input_keyword_add,
                    "Search_Suggestions"=> $request->search_suggestion_add,
                    "Destination"=> $request->destination_add ,
                    "RedirectToScreen"=> $request->redirect_to_screen_add        
                )
            )
        );

        // dd($data);

        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/MasterSearchingAPI/CreateOrUpdateMasterSearching"; 
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

        return redirect('/master-searching')->with('success',' Data Master Searching Added Successfull !!!');
    }

    public function update(Request $request)
    {
        $data = json_encode(
            array("UserId"=> $request->session()->get('Id'),
                "MstSearch"=>array(
                    "Id"=> $request->id_update,
                    "Input_Keyword"=> $request->input_keyword_update,
                    "Search_Suggestions"=> $request->search_suggestion_update,
                    "Destination"=> $request->destination_update ,
                    "RedirectToScreen"=> $request->redirect_to_screen_update        
                )
            )
        );

        // dd($data);

        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/MasterSearchingAPI/CreateOrUpdateMasterSearching"; 
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

        return redirect('/master-searching')->with('success',' Data Master Searching Update Successfull !!!');
    }


    public function delete($id = null,Request $request)
    {
        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/MasterSearchingAPI/DeleteMasterSearching?MstSearchId=".$id;
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

        return redirect('/master-searching')->with('success','Data Master Searching Delete Successfull !!!');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'upload_master_searching' => 'required',
        ]);

        $file = $request->upload_master_searching;
        // dd($file);
        $x= file_get_contents($file);
        $y= base64_encode($x);
        $name = $file->getClientOriginalName();

        $data = json_encode(array(
            "UserId" => $request->session()->get('Id'),
            "Filename" => "$name",
            "Content" => $y,
        ));
        // dd($data);  

        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/MasterSearchingAPI/UploadMasterSearching"; 
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

        return redirect('/master-searching')->with('success','Upload Data Master Searching Successfull !!!');
    }
}
