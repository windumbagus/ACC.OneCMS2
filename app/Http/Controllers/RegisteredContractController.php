<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RegisteredContractExport;
use App\Exports\TransactionHistoryExport;

class RegisteredContractController extends Controller
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
            'SubMenuId'=>"16"
        ]);
         //API GET
         $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/RegisteredContractAPI/GetAllRegisteredContract?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"];  
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
            return view('registered_contract',[
                'Role' => $Hasils->Role,
                'Contracts'=>$Hasils->Data,
                'session' => $session            
            ]);           
        }else{
            return redirect('/invalid-permission');
        }   
    }

    public function show(Request $request)
    {
        // API
        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/RegisteredContractAPI/GetRegisteredContractById?Id=".$request->Id; 
         $ch = curl_init($url);                                                     
        //  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $val= json_decode($result);
        //  dd($val);
         return json_encode($val);
    }

    public function delete($id=null, Request $request)
    {
        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/RegisteredContractAPI/DeleteRegisteredContractById?Id=".$id;
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

        return redirect('/registered-contract');
    }

    public function TransactionHistory(Request $request)
    {
        $data = json_encode(array(
            "MstRegisteredContractId"=>$request->Id,
            "ContractNo"=>$request->ContractNo,
            "Username"=>$request->Username,
            )); 
        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/RegisteredContractAPI/GetAllTransactionHistoryRegisteredContractId"; 
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
       $val= [
            "Data"=> $Hasils,
            "MstRegisteredContractId"=>$request->Id,
            "ContractNo"=>$request->ContractNo,
            "Username"=>$request->Username,
       ];
        return $val;
    }

    public function TransactionDetail(Request $request)
    {
        $data = json_encode(array(
            "MstTransactionHistoryId"=>$request->MstTransactionHistoryId,
            "MstRegisteredContractId"=>$request->MstRegisteredContractId,
            "ContractNo"=>$request->ContractNo,
            "Username"=>$request->Username,
            )); 
        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/RegisteredContractAPI/GetTransactionHistoryById"; 
        $ch = curl_init($url);                   
        curl_setopt($ch, CURLOPT_POST, true);                                  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val= json_decode($result); 
        // dd($val);
        return json_encode($val);
    }

    public function DownloadRegisteredContract(Request $request)
    {
         //API GET
         $session=[];
         array_push($session,[
             'LoginSession'=>$request->session()->get('LoginSession'),
             'Email'=>$request->session()->get('Email'),
             'Name'=>$request->session()->get('Name'),
             'Id'=>$request->session()->get('Id'),
             'RoleId'=>$request->session()->get('RoleId'),
             'SubMenuId'=>"16"
         ]);
         //API GET
         $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/RegisteredContractAPI/GetAllRegisteredContract?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"];  
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $Hasils= json_decode($result);
        //  dd($Hasils);

         $data=[];
         foreach ($Hasils->Data as $Hasil) {

            if (property_exists($Hasil->MstRegisteredContract, 'POLIS_INSURANCE')){
                $POLIS_INSURANCE = $Hasil->MstRegisteredContract->POLIS_INSURANCE;
            }else{
                $POLIS_INSURANCE = "";
            }

            if (property_exists($Hasil->MstRegisteredContract, 'AMOUNT_INSTALLMENT_OVD')){
                $AMOUNT_INSTALLMENT_OVD = $Hasil->MstRegisteredContract->AMOUNT_INSTALLMENT_OVD;
            }else{
                $AMOUNT_INSTALLMENT_OVD = "";
            }

            if (property_exists($Hasil->MstRegisteredContract, 'INFO_PLAFON')){
                $INFO_PLAFON = $Hasil->MstRegisteredContract->INFO_PLAFON;
            }else{
                $INFO_PLAFON = "";
            }

            if (property_exists($Hasil->MstRegisteredContract, 'NAME_INSU_CO')){
                $NAME_INSU_CO = $Hasil->MstRegisteredContract->NAME_INSU_CO;
            }else{
                $NAME_INSU_CO = "";
            }

            if (property_exists($Hasil->MstRegisteredContract, 'CURRENT_INSURANCE')){
                $CURRENT_INSURANCE = $Hasil->MstRegisteredContract->CURRENT_INSURANCE;
            }else{
                $CURRENT_INSURANCE = "";
            }

           array_push($data,[
               "Id"=>$Hasil->User->Id,
               "Name"=>$Hasil->User->Name,
               "CONTRACT_NO"=>$Hasil->MstRegisteredContract->CONTRACT_NO,
               "V_ACCOUNT"=>$Hasil->MstRegisteredContract->V_ACCOUNT,
               "POLICE_NO"=>$Hasil->MstRegisteredContract->POLICE_NO,
               "TOTAL_PAYMENT"=>$Hasil->MstRegisteredContract->TOTAL_PAYMENT,
               "AMOUNT_OF_AR"=>$Hasil->MstRegisteredContract->AMOUNT_OF_AR,
               "POLIS_INSURANCE"=>$POLIS_INSURANCE,
               "AMOUNT_INSTALLMENT_OVD"=>$AMOUNT_INSTALLMENT_OVD,
               "INFO_PLAFON"=>$INFO_PLAFON,
               "AMT_ACP"=>$Hasil->MstRegisteredContract->AMT_ACP,
               "NAME_INSU_CO"=>$NAME_INSU_CO,
               "AMT_INSTALLMENT_PAID"=>$Hasil->MstRegisteredContract->AMT_INSTALLMENT_PAID,
               "FLAG_BAYAR"=>$Hasil->MstRegisteredContract->FLAG_BAYAR,
               "BILL_NO"=>$Hasil->MstRegisteredContract->BILL_NO,
               "BILL_DATE"=>$Hasil->MstRegisteredContract->BILL_DATE,
               "BILL_EXP"=>$Hasil->MstRegisteredContract->BILL_EXP,
               "BILL_DESC"=>$Hasil->MstRegisteredContract->BILL_DESC,
               "BILL_AMOUNT"=>$Hasil->MstRegisteredContract->BILL_AMOUNT,
               "TENOR"=>$Hasil->MstRegisteredContract->TENOR,
               "CURRENCY_ID"=>$Hasil->MstRegisteredContract->CURRENCY_ID,
               "PAYMENT_TYPE"=>$Hasil->MstRegisteredContract->PAYMENT_TYPE,
               "PAYMENT_PLAN"=>$Hasil->MstRegisteredContract->PAYMENT_PLAN,
               "PAYMENT_METHOD"=>$Hasil->MstRegisteredContract->PAYMENT_METHOD,
               "PAYMENT_DETAIL"=>$Hasil->MstRegisteredContract->PAYMENT_DETAIL,
               "SIGNATUREDEBIT"=>$Hasil->MstRegisteredContract->SIGNATUREDEBIT,
               "SIGNATUREDEBIT2"=>$Hasil->MstRegisteredContract->SIGNATUREDEBIT2,
               "SIGNATURECREDIT"=>$Hasil->MstRegisteredContract->SIGNATURECREDIT,
               "MERCHANTID"=>$Hasil->MstRegisteredContract->MERCHANTID,
               "MERCHANTNAME"=>$Hasil->MstRegisteredContract->MERCHANTNAME,
               "FLAG_SYARIAH"=>$Hasil->MstRegisteredContract->FLAG_SYARIAH,
               "CURRENT_INSURANCE"=>$CURRENT_INSURANCE,
               "CUSTNAME"=>$Hasil->MstRegisteredContract->CUSTNAME,
           ]);
         }
        // dd($data);
        return Excel::download(new RegisteredContractExport($data), 'accone Selling Car Transaction  '. date("Y-m-d") .'.xlsx');
    }

    public function DownloadTransactionHistory(Request $request)
    {
        $data = json_encode(array(
            "MstRegisteredContractId"=>$request->Id,
            "ContractNo"=>$request->ContractNo,
            "Username"=>$request->Username,
            )); 
            // dd($data);
        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/RegisteredContractAPI/GetAllTransactionHistoryRegisteredContractId"; 
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

        $X=[];
        foreach ($Hasils as $Hasil) {

            if (property_exists($Hasil->MstTransactionHistory, 'AMOUNT_INSTALLMENT_PAID')){
                $AMOUNT_INSTALLMENT_PAID =  $Hasil->MstTransactionHistory->AMOUNT_INSTALLMENT_PAID;
            }else{
                $AMOUNT_INSTALLMENT_PAID = "";
            }

            if (property_exists($Hasil->MstTransactionHistory, 'ACTUALDATE_PAYMENT')){
                $ACTUALDATE_PAYMENT =  $Hasil->MstTransactionHistory->ACTUALDATE_PAYMENT;
            }else{
                $ACTUALDATE_PAYMENT = "";
            }

            array_push($X,[
                "Username"=> $request->Username,
                "CONTRACT_NO"=>$Hasil->MstTransactionHistory->CONTRACT_NO,
                "NO_INSTALLMENT"=>$Hasil->MstTransactionHistory->NO_INSTALLMENT,
                "DUEDATE_PAYMENT"=>$Hasil->MstTransactionHistory->DUEDATE_PAYMENT,
                "AMOUNT_INSTALLMENT"=>$Hasil->MstTransactionHistory->AMOUNT_INSTALLMENT,
                "AMOUNT_INSTALLMENT_PAID"=>$AMOUNT_INSTALLMENT_PAID,
                "ACTUALDATE_PAYMENT"=>$ACTUALDATE_PAYMENT,
                "STATUS"=>$Hasil->MstTransactionHistory->STATUS,
                "AMT_CHARGE"=>$Hasil->MstTransactionHistory->AMT_CHARGE,
                "AMT_PENALTY"=>$Hasil->MstTransactionHistory->AMT_PENALTY,
                "CURRENT_INSTALLMENT"=>$Hasil->MstTransactionHistory->CURRENT_INSTALLMENT,
                "CURRENT_INSURANCE"=>$Hasil->MstTransactionHistory->CURRENT_INSURANCE,            
            ]);
        }
        // dd($X);
        return Excel::download(new TransactionHistoryExport($X), 'accone Transaction History Per '. date("Y-m-d") .'.xlsx');
    }
    
}
