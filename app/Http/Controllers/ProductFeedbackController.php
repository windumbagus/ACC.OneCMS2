<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductFeedbackExport;

class ProductFeedbackController extends Controller
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
            'SubMenuId'=>"23"
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
         $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/ProductFeedbackAPI/GetAllProductFeedback?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"];   
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
            return view('product_feedback',[
                'Role' => $Hasils->Role,
                'Feedbacks'=>$Hasils->Data,
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
        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/ProductFeedbackAPI/GetProductFeedbackById?Id=".$request->Id; 
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

    public function delete($id=null,Request $request)
    {
        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/ProductFeedbackAPI/DeleteProductFeedbackById?Id=".$id;
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

        return redirect('/product-feedback');
    }

    public function download(Request $request)
    {
         //API GET
         $session=[];
         array_push($session,[
             'LoginSession'=>$request->session()->get('LoginSession'),
             'Email'=>$request->session()->get('Email'),
             'Name'=>$request->session()->get('Name'),
             'Id'=>$request->session()->get('Id'),
             'RoleId'=>$request->session()->get('RoleId'),
             'SubMenuId'=>"23"
         ]);
         //API GET
         $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/ProductFeedbackAPI/GetAllProductFeedback?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"];   
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $Hasils= json_decode($result);
         dd($Hasils);
         $data=[];
         foreach ($Hasils->Data as $Hasil) {
            array_push($data,[
                "Username"=>$Hasil->User->Username,
                "Report"=>$Hasil->MstKritikSaranBug->Report,
            ]);
         }
        //  dd($data);
        return Excel::download(new ProductFeedbackExport($data), 'accone Product Feedback '. date("Y-m-d") .'.xlsx');

    }
}
