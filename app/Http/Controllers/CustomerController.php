<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        //API
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/BankAccountCustomerAPI/GetAllBankAccountList"; 
        $ch = curl_init($url);                                                     
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $data = json_decode($result);
        // dd($data);
        
        return view('customer',['Customers' => $data]);    
    }

    public function show(Request $request)
    {
         //API GET
         $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/BankAccountCustomerAPI/GetBankAccountById?BankAccountCustomerID=".$request->Id; 
         $ch = curl_init($url);                                                     
         // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $val= json_decode($result);
         // dd($val);
 
         return json_encode($val);
    }

    public function edit(Request $request)
    {
        $data = json_encode(array(
            "Id"=> "$request->customer_Id_update" ,
            "UserId"=> "$request->customer_UserId_update" ,
            "GCMId"=> "$request->customer_GCMId_update" ,
            "NoRekening"=> "$request->customer_NoRekening_update" ,
            "NamaRekening"=> "$request->customer_NamaRekening_update" ,
            "AddedDate"=> "$request->" ,
            "UserAdded"=> "$request->" ,
            "Cabang"=> "$request->customer_Cabang_update" ,
            "Is_Active"=> "$request->customer_IsActive_update" ,
            "BankCode"=> "$request->" 
        )); 
        dd($data);

        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/BankAccountCustomerAPI/UpdateBankAccount"; 
        $ch = curl_init($url);                   
        curl_setopt($ch, CURLOPT_POST, true);                                  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $data = json_decode($result);
        // dd($result);

        return redirect('/customer');
    }
}
