<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeamlessUnitUploadController extends Controller
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
        
        // dd($Hasils);
        
        return view('modal/upload_seamless_unit',[
           
            'session' => $session
            ]);    
    }

    public function upload(Request $request)
    {
        $request->validate([
            'upload_seamless_unit' => 'required',
        ]);
       
        // $file = $request->upload_seamless_unit;
        // $x= file_get_contents($file);
        // $y= base64_encode($x);
        $x=$request->jsonObject; 
        // $name = $file->getClientOriginalName();
       
        $data = json_encode(array(
            "doSendDataCMS" => array(   
                "TRANSACTION_CODE"=>"INSERT_DATA_UNIT",
                "DataUnit"=>json_decode($x),
            ),
        ));
        //  dd($data);

        $url = config('global.base_url_sofia')."/restV2/seamless/accone/datacms"; 
        $ch = curl_init($url);                   
        curl_setopt($ch, CURLOPT_POST, true);                                  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $Hasils = json_decode($result);
        //   dd($result);

        if($Hasils->OUT_STAT="T"){
            return redirect('/seamless-unit')->with('success','Seamless Unit Upload Successfull !!!');
        }else{
            return redirect('/seamless-unit/upload-page')->with('warning', 'Error');
        }
    }

    public function cancel(Request $request)
    {
         
        return redirect('/seamless-unit');

    }

   
}
