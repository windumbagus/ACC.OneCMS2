<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryPembayaranAsuransiJiwaController extends Controller
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
            'SubMenuId'=>"37" // "37" untuk SubMenu HistoryPembayaranAsuransiJiwa

        ]);

         //API
         $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/HistoryPembayaranAsuransiJiwaAPI/GetAllHistoryPembayaranAsuransiJiwa?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
         $ch = curl_init($url);                                                     
         // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $data = json_decode($result);
         // dd($data);

        if(property_exists($data,"IsSuccess")){
            return view(
                'history_pembayaran_asuransi_jiwa',[
                    'As' => $data->Data,
                    'session' => $session
            ]);
        }else{
            return redirect('/invalid-permission');
        }  
    }

    public function show(Request $request)
    {
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/HistoryPembayaranAsuransiJiwaAPI/GetHistoryPembayaranAsuransiJiwaById?HistoryId=".$request->Id; 
        $ch = curl_init($url);                                                     
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val = json_decode($result);
        // dd($data);
        return json_encode($val);
    }

    public function delete($id=null,Request $request)
    {
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/HistoryPembayaranAsuransiJiwaAPI/DeleteHistoryPembayaranAsuransiJiwa?HistoryId=".$id;
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

        return redirect('/history-pembayaran-asuransi-jiwa')->with('info',' Delete Data Successfully!');
    }
}
