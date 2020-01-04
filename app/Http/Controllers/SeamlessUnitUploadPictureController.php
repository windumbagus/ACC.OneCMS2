<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AccCashApplyExport;

class SeamlessUnitUploadPictureController extends Controller
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
        

        $data = json_encode(array(
            "doSendDataCMS" => array(   
                "TRANSACTION_CODE"=>"GET_COLOR_PICT_CMS",
                "P_ID_UNIT"=>$request->ID_UNIT,
                "P_GUID"=>$request->GUID,
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
            return view(
                'seamless_unit_picture',[
                   // 'Role' => $Hasils->Role,
                    'SeamlessUnitPictures'=>$Hasils->OUT_DATA[0],
                   // 'Roles'=>$Hasils2->Roles,
                  //  'UserCategories'=>$Hasils2->UserCategory, 
                    'session' => $session
            ]);

    }
   
  

   

    public function uploadpicture(Request $request) {

            $file = $request->addPicture_seamlessunit;
            // dd($file);
            $getContent = file_get_contents($file);
           
            $content= base64_encode($getContent);
            $name = $file->getClientOriginalName();
            $type = $file->extension();

        $data = json_encode(array(
            "doSendDataCMS" => array(   
                "TRANSACTION_CODE"=>"UPLOAD_COLOR_PICT_CMS",
                "P_ID_UNIT"=>$request->ID_UNIT,
                "P_GUID"=>$request->GUID,
                "P_CD_COLOR"=>$request->CD_COLOR,
			    "P_DESC_COLOR"=>$request->DESC_COLOR,
			    "P_FLAG_PRIMARY"=>$request->FLAG_PRIMARY,
                "P_FILE_NAME"=>$request->FILE_NAME,
                "P_USER_NAME"=>"ADMIN",
                "P_PATH_FILE"=>'/mnt/ACCONE/unit/'.$request->FILE_NAME,
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
         
         
         if ($Hasils->OUT_STAT == "T"){
            
            return redirect('seamless-unit-detail/'.$request->ID_UNIT)->with('success','Gambar berhasil diubah');
        }else{
            return redirect('seamless-unit-picture/'.$request->GUID.'&'.$request->ID_UNIT)->with('error',$Hasils->OUT_MESS);
        }

    }




}
