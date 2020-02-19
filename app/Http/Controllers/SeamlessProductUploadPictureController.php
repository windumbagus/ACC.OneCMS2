<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AccCashApplyExport;
use Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class SeamlessProductUploadPictureController extends Controller
{
  

    public function index(Request $request)
    {
        
        $session=[];
        array_push($session,[
            'LoginSession'=>$request->session()->get('LoginSession'),
            'Email'=>$request->session()->get('Email'),
            'Name'=>$request->session()->get('Name'),
            'Id'=>$request->session()->get('Id'),
           // 'RoleId'=>$request->session()->get('RoleId'),
           // 'SubMenuId'=>"15" // "15" untuk SubMenu UserCms
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


        $data = json_encode(array(
            "doSendDataCMS" => array(   
                "TRANSACTION_CODE"=>"GET_PRODUCT_PICT",
                "P_CD_PRODUCT"=>$request->CD_PRODUCT,
                "P_LANGUAGE"=>"IN",
            ),
        ));

         //API GET
         $url = config('global.base_url_sofia').'/restV2/seamless/accone/datacms';
        //  dd($data);
     
         // dd($url);
       
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
         //dd($err);

         if ($Hasilsrole->OUT_DATA == 'Super Admin' || $Hasilsrole->OUT_DATA == 'Super_Admin' || $Hasilsrole->OUT_DATA == 'seamless')
         {
            return view(
                'seamless_product_picture',[
                   // 'Role' => $Hasils->Role,
                    'SeamlessProductPictures'=>$Hasils->OUT_DATA[0],
                   // 'Roles'=>$Hasils2->Roles,
                  //  'UserCategories'=>$Hasils2->UserCategory, 
                  'role'=> $Hasilsrole->OUT_DATA,
                    'session' => $session
            ]);
         }
         else
         {
             return redirect('/invalid-permission');
         }
 


    }
   
  

   

    public function update(Request $request) {


        $file = $request->addPicture_seamlessproduct;
             // dd($file);
        If(!file_exists($file))
        {
            $content = null;
        }
        else{
        

            $getcontentresizing = (string) Image::make($file)->resize(1435, 576)->encode('data-url');
            //  $getcontent = file_get_contents($file);
            // $getcontentresizing = (string) Image::make($file)->resize(null, 200, 
            // function ($constraint) {
            //     $constraint->aspectRatio();
            // })->encode('data-url');
            
            
        // $content = str_replace('data:image/jpeg;base64,','',$getcontent);
            $getcontent = file_get_contents($getcontentresizing);
            $content = base64_encode($getcontent);
            //dd($content);
            $name = $file->getClientOriginalName();
            $type = $file->extension();

        }


        $data = json_encode(array(
            "doSendDataCMS" => array(   
                "TRANSACTION_CODE"=>"UPLOAD_PRODUCT_PICT_CMS",
                "P_CD_PRODUCT"=>$request->CD_PRODUCT,
                "P_DESC_DETAIL"=>$request->DESC_DETAIL,
                "P_TNC"=>$request->TNC,
                "P_FILE_NAME"=>$request->FILE_NAME,
                "P_USER_NAME"=>"ADMIN",
                "P_PATH_FILE"=>$request->PATH_FILE,
                "P_LANGUAGE"=>"IN",
                "P_RAW_FILE"=>$content,
            ),
        ));

        // dd($data);
         //API GET
         $url = config('global.base_url_sofia').'/restV2/seamless/accone/datacms';
        //  dd($data);
     
         // dd($url);
       
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
         //dd($err);
         
         
        //  if ($Hasils->OUT_STAT == "T"){
            
            return redirect('seamless-product-detail/'.$request->CD_PRODUCT)->with('success','Data berhasil diubah');
        // }else{
            // return redirect('seamless-product-picture/'.$$request->CD_PRODUCT)->with('error',$Hasils->OUT_MESS);
        // }

    }




}
