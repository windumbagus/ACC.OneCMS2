<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewCarController extends Controller
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
        
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/NewCarAPI/GetAllNewCar"; 
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val = json_decode($result);
        // dd($val);

        return view('new_car',[
            'MstTransaksiList' => $val->MstTransaksiList,
            'MstTrsansaksi_StatusList'=> $val->MstTrsansaksi_StatusList,
            'session'=> $session     
        ]);  
    }

    public function getByCondition(Request $request)
    {
        $data = json_encode(
            array(
                "Status" => $request->Status,
                "EndDate" => $request->EndDate,
                "StartDate" => $request->StartDate,
            )
        );
        // dd($data);

        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/NewCarAPI/GetAllNewCarByCondition"; 
        $ch = curl_init($url);                   
        curl_setopt($ch, CURLOPT_POST, true);                                  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val = json_decode($result);
        // dd($val);

        return json_encode($val);  
    }

    public function show(Request $request)
    {
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/NewCarAPI/GetNewCarById?Input=".$request->Id; 
        // dd($url);  
        $ch = curl_init($url);                                                     
        //  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val= json_decode($result);
        // dd($val);

        return json_encode($val);
    }

    public function delete($id=null, Request $request)
    {
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/NewCarAPI/DeleteNewCarById?Input=".$id;
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

        return redirect('/new-car')->with('success',' Delete Data Successfully!');
    }
    
    public function update(Request $request)
    {
        // dd($request);
        $data = json_encode(
            array(
                "MstTransaksi_Id" => $request->updateNewCar_MstTransaksi_Id,
                "MstTransaksi_Notes" => $request->updateNewCar_MstTransaksi_Notes,
            )
        );
        // dd($data);

        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/NewCarAPI/FollowUpNewCar"; 
        $ch = curl_init($url);                   
        curl_setopt($ch, CURLOPT_POST, true);                                  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val = json_decode($result);
        // dd($val);

        if(property_exists($val, 'IsSuccess') && ($val->IsSuccess)) {
            return redirect('/new-car')->with('success',' Follow Up Data Successfully!');
        } elseif(property_exists($val, 'ErrorMessage')) {
            return redirect('/new-car')->with('error', $val->ErrorMessage);
        } else {
            return redirect('/new-car')->with('error',' Follow Up Data Failed!');
        }
    }
}
