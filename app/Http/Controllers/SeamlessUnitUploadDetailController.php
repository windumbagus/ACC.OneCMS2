<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SeamlessUnitDetailExport;

class SeamlessUnitUploadDetailController extends Controller
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
        
        return view('modal/upload_seamless_unit_detail',[
            'unitid'=>$request->Id,
            'session' => $session
            ]);    
    }

    public function upload(Request $request)
    {
        $request->validate([
            'upload_seamless_unit_detail' => 'required',
        ]);
       
        // $file = $request->upload_seamless_unit_detail;
        $x=$request->jsonObject; 
        // $y= base64_encode($x);

        // $name = $file->getClientOriginalName();
        //dd($x);
        $data = json_encode(array(
            "doSendDataCMS" => array(   
                "TRANSACTION_CODE"=>"INSERT_DATA_UNIT_DETAIL",
                "DataUnitDetail"=>json_decode($x),
            ),
        ));

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
        // dd($Hasils);

        if($Hasils->OUT_STAT="T"){
            return redirect('/seamless-unit-detail/'.$request->Id)->with('success','Seamless Unit Detail Upload Successfull !!!');
        }else{
            return redirect('/seamless-unit-detail/upload-page/'.$request->Id)->with('warning', $Hasils->OUT_MESS);
        }
    }

    public function download(Request $request)
    {
         //API GET

        $data=[];
             array_push($data,[

                 "CATEGORY"=>"EXAMPLE",
                 "CD_VALUE"=>"999",
                 "CHAR_VALUE"=>"999",
                 "CHAR_DESC"=>"EXAMPLE 123",
                 "ID_USER_ADDED"=>"ADMIN",
                 "ID_USER_UPDATED"=>"ADMIN",

            ]);
         
        //   dd($data);
         return Excel::download(new SeamlessUnitDetailExport($data), 'SeamlessUnitDetailTemplate.xlsx');
    }

    public function cancel(Request $request)
    {
         
        return redirect('/seamless-unit-detail/'.$request->Id);

    }

   
}
