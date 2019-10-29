<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserCMSExport;

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
            'RoleId'=>$request->session()->get('RoleId'),
            'SubMenuId'=>"15" // "15" untuk SubMenu UserCms
        ]);
         //API GET
         $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/UserCMSAPI/GetAllUserCMS?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $Hasils= json_decode($result);
        //  dd($Hasils);

        //API GET
        $url2 = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/UserCMSAPI/GetUserCategoryRoles"; 
        $ch2 = curl_init($url2);                                                     
        curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch2, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result2 = curl_exec($ch2);
        $err2 = curl_error($ch2);
        curl_close($ch2);
        $Hasils2= json_decode($result2);
        // dd($Hasils2);

        if(property_exists($Hasils,"IsSuccess")){
            return view(
                'user_cms',[
                    'UserCMSs'=>$Hasils->Data,
                    'Roles'=>$Hasils2->Roles,
                    'UserCategories'=>$Hasils2->UserCategory, 
                    'session' => $session
            ]);
        }else{
            return redirect('/invalid-permission');
        }  
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

    public function download(Request $request)
    {
         //API GET
         $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/UserCMSAPI/DownloadUserCMS"; 
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $Hasils= json_decode($result);
        //  dd($Hasils);

         $data=[];
         foreach ($Hasils as $Hasil) {
 
             if (property_exists($Hasil->User, 'Last_Login')){
                 $Last_Login = $Hasil->User->Last_Login;
             }else{
                 $Last_Login = "";
             }
 
             array_push($data,[
                 "Name"=>$Hasil->User->Name,
                 "Username"=>$Hasil->User->Username,
                 "Email"=>$Hasil->User->Email,
                 "MobilePhone"=>$Hasil->User->MobilePhone,
                 "CreationDate"=>$Hasil->User->Creation_Date,
                 "LastLogin"=>$Last_Login,
                 "IsActive"=>$Hasil->User->Is_Active,
                 "Organization"=>$Hasil->MstUserDetail->Organization,
                 "NPK"=>$Hasil->MstUserDetail->NPK,
                 "Address"=>$Hasil->MstUserDetail->Address,
            ]);
         }
        //  dd($data);
         return Excel::download(new UserCMSExport($data), 'User CMS '. date("Y-m-d His") .'.xlsx');
    }

    public function delete($Id=null,$UserDetailId=null,Request $request)
    {
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/UserCMSAPI/DeleteUser?UserId=".$Id."&MstUserDetailId=".$UserDetailId;
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

        return redirect('/user-cms')->with('success',' User CMS Delete Successfully!');
    }
}
