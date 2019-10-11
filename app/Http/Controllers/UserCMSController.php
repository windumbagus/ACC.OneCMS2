<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserCMSController extends Controller
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
         $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/UserCMSAPI/GetAllUserCMS"; 
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $Hasils= json_decode($result);
        //  dd($Hasils->User);

        return view('user_cms',[
            'UserCMSs'=>$Hasils->User,
            'Roles'=>$Hasils->Role,
            'UserCategories'=>$Hasils->UserCategory,
            'session' => $session            
            ]);    
    }

    public function show(Request $request)
    {
         //API GET
         $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/UserCMSAPI/GetUser?UserId=".$request->Id; 
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

    public function add(Request $request)
    {
        $request->validate([
            'Name_add' => 'required',
            'Username_add' => 'required',
            'Password_add' => 'required|same:Confirm_Password_add',
            'Email_add' => 'required',
            'MobilePhone_add' => 'required',
            'Organization_add' => 'required',
            'NPK_add' => 'required',            
            'Address_add' => 'required',
            'Expired_Date_add' => 'required|date|after:yesterday',
        ]);

        if($request->Is_Active_add == "on"){
            $Is_Active_add = True; 
        }else{
            $Is_Active_add = False;
        }

        $data = json_encode(array(
            "User" => array(   
                // "Id"=> $request->Id_add,
                "Name"=>$request->Name_add,
                "Username"=>$request->Username_add,
                "Password"=>$request->Password_add,
                "Email"=>$request->Email_add,
                "MobilePhone"=>$request->MobilePhone_add,
                // "External_Id"=>$request->External_Id_add,   0
                "Creation_Date"=>now(),
                // "Last_Login"=>$request->Last_Login_add,
                "Is_Active"=>$Is_Active_add,
            ),
            "UserDetail" => array(
                // "Id"=>$request->,
                // "UserId"=>$request->,
                "RoleId"=>$request->Role_add,
                "UserCategory"=>$request->User_Category_add,
                // "IsSuperAdmin"=>$request->,   false
                "AddedDate"=>now(),
                "UserAdded"=>$request->session()->get('Id'),
                // "UpdatedDate"=>$request->,
                // "UserUpdated"=>$request->,
                // "Status"=>$request->,   0
                "Organization"=>$request->Organization_add,
                "NPK"=>$request->NPK_add,
                "ExpiredDate"=>$request->Expired_Date_add,
                "Address"=>$request->Address_add
                // "Supplier"=>   0
            ),
        )); 
        // dd($data);
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/UserCMSAPI/CreateUpdateUser"; 
        $ch = curl_init($url);                   
        curl_setopt($ch, CURLOPT_POST, true);                                  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $Hasils= json_decode($result); 
        // dd($Hasils);

            if ($Hasils->Status == True){
                return redirect("user-cms")->with('success','Data User CMS Add Successfull !!!');
            }else{
                return redirect("user-cms")->with('error',$Hasils->Error);
            }
    }

    public function update(Request $request)
    {
        $request->validate([
            'Name_update' => 'required',
            'Username_update' => 'required',
            'Password_update' => 'required|same:Confirm_Password_update',
            'Email_update' => 'required',
            'MobilePhone_update' => 'required',
            'Organization_update' => 'required',
            'NPK_update' => 'required',            
            'Address_update' => 'required',
            'Expired_Date_update' => 'required|date|after:yesterday',
        ]);

        if($request->Is_Active_update == "on"){
            $Is_Active_update = True; 
        }else{
            $Is_Active_update = False;
        }


        $data = json_encode(array(
            "User" => array(   
                "Id"=> $request->Id_update,
                "Name"=>$request->Name_update,
                "Username"=>$request->Username_update,
                "Password"=>$request->Password_update,
                "Email"=>$request->Email_update,
                "MobilePhone"=>$request->MobilePhone_update,
                // "External_Id"=>$request->External_Id_update,
                "Creation_Date"=>$request->Creation_Date_update,
                // "Last_Login"=>$request->Last_Login_update,
                "Is_Active"=>$Is_Active_update
            ),
            "UserDetail" => array(
                "Id"=>$request->IdUserDetail_update,
                "UserId"=>$request->Id_update,
                "RoleId"=>$request->Role_update,
                "UserCategory"=>$request->User_Category_update,
                // "IsSuperAdmin"=>$request->,
                // "AddedDate"=>$request->,
                // "UserAdded"=>$request->,
                "UpdatedDate"=>now(),
                "UserUpdated"=>$request->session()->get('Id'),
                // "Status"=>$request->,
                "Organization"=>$request->Organization_update,
                "NPK"=>$request->NPK_update,
                "ExpiredDate"=>$request->Expired_Date_update,
                "Address"=>$request->Address_update
                // "Supplier"=>
            ),
        )); 
        // dd($data);
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/UserCMSAPI/CreateUpdateUser"; 
        $ch = curl_init($url);                   
        curl_setopt($ch, CURLOPT_POST, true);                                  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $Hasils= json_decode($result); 
        // dd($Hasils);
        
        if ($Hasils->Status == True){
            return redirect("user-cms")->with('success','Data User CMS Update Successfull !!!');
        }else{
            return redirect("user-cms")->with('error',$Hasils->Error);
        }
    }

    // public function delete($id=null,Request $request)
    // {
    //     $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/UserCMSAPI/DeleteUser/".$id;
    //     dd($url);        
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, $url);
    //     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     $result = curl_exec($ch);
    //     $err = curl_error($ch);
    //     curl_close($ch);
    //     $data = json_decode($result);
    //     dd($result);

    //     return redirect('/user-cms')->with('success',' Delete Data Successfully!');
    // }
}
