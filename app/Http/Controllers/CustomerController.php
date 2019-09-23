<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\BankAccountExport;
use Maatwebsite\Excel\Facades\Excel;


class CustomerController extends Controller
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

        return view(
            'customer',[
                'Customers' => $data,
                'session' => $session
        ]);    
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

    public function update(Request $request)
    {
        if($request->customer_IsActive_update == "on"){
            $IsActive = true;
        }else{
            $IsActive = false;
        }

        $data = json_encode(array(
            "Id"=> "$request->customer_Id_update" ,
            "UserId"=> "$request->customer_UserId_update" ,
            "GCMId"=> "$request->customer_GCMId_update" ,
            "NoRekening"=> "$request->customer_NoRekening_update" ,
            "NamaRekening"=> "$request->customer_NamaRekening_update" ,
            "AddedDate"=> "$request->customer_AddedDate_update" ,
            "UserAdded"=> "$request->customer_UserAdded_update" ,
            "Cabang"=> "$request->customer_Cabang_update" ,
            "Is_Active"=> $IsActive ,
            "BankCode"=> "$request->customer_BankCode_update" 
        )); 
        // dd($data);

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

        return redirect('/customer')->with('info',' Update Data Successfully!');
    }

    public function delete($id=null,Request $request)
    {
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/BankAccountCustomerAPI/DeleteBankAccount?BankAccountCustomerID=".$id;
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

        return redirect('/customer')->with('info',' Delete Data Successfully!');
    }

    public function download()
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
        $Hasils = json_decode($result);
        // dd($Hasil);

        $data=[];
        foreach ($Hasils as $Hasil) {
         
            if (property_exists($Hasil->MstBankAccountCustomer, 'BankCode')){
                $BankCode = $Hasil->MstBankAccountCustomer->BankCode;
            }else{
                $BankCode = "";
            }
            if (property_exists($Hasil->MstBankAccountCustomer, 'RekeningUtama')){
                $RekeningUtama =  $Hasil->MstBankAccountCustomer->RekeningUtama;
            }else{
                $RekeningUtama = "FALSE";
            }

            array_push($data,[
                "Username"=>$Hasil->User->Username,
                "CharDesc1"=>$Hasil->MstGCM->CharDesc1,
                "NoRekening"=>$Hasil->MstBankAccountCustomer->NoRekening,
                "NamaRekening"=>$Hasil->MstBankAccountCustomer->NamaRekening,
                "Cabang"=>$Hasil->MstBankAccountCustomer->Cabang,
                "BankCode"=>$BankCode,
                "RekeningUtama"=>$RekeningUtama,
            ]);
        }
        // dd($data);
        return Excel::download(new BankAccountExport($data), 'Bank Account - Customer.xlsx');
    }
}
