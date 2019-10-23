<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TradeInController extends Controller
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
         $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/TradeInListAPI/GetAllTradeInList"; 
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $Hasils= json_decode($result);
        //  dd($Hasils);

         //API GET Dropdown
         $url2 = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/TradeInListAPI/GetTransactionStatus"; 
         $ch2 = curl_init($url2);                                                     
         curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch2, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result2 = curl_exec($ch2);
         $err2 = curl_error($ch2);
         curl_close($ch2);
         $Hasils2= json_decode($result2);
        //  dd($Hasils2);

        return view('trade_in',[
            'TradeIns'=>$Hasils,
            'Statuss'=>$Hasils2,
            'session' => $session            
            ]);    
    }

    public function getByCondition(Request $request)
    {
        $data = json_encode(array(
            "Status"=> "$request->Status",
            "StartDate"=> "$request->StartDate",
            "EndDate"=> "$request->EndDate"
        ));
        // dd($data);

        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/TradeInListAPI/GetAllTradeInListByCondition"; 
        $ch = curl_init($url);                   
        curl_setopt($ch, CURLOPT_POST, true);                                  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $output = json_decode($result);
        // dd($result);
        return json_encode($output);
    }

    public function show(Request $request)
    {
        //API GET
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/TradeInListAPI/GetTradeInById?MappingTransaksiId=".$request->Id; 
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

    public function delete($id = null,Request $request)
    {
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/TradeInListAPI/DeleteTradeIn/?MappingTransaksiId=".$id;
        // dd($url);        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val = json_decode($result);
        // dd($result);

        if(property_exists($val, 'Success')){
            return redirect('/trade-in')->with('success',$val->Message);
        }else{
            return redirect('/trade-in')->with('error',$val->Message);
        }
    }

    public function approve(Request $request)
    {
        //API GET
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/TradeInListAPI/Approved?MappingTransaksiId=".$request->MappingTransaksiId; 
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
        if(property_exists($val, 'Success')){
            return redirect('/trade-in')->with('success','Data Approved Successfull !!!');
        }else{
            return redirect('/trade-in')->with('error',$val->Message);
        }
    }
}
