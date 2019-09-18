<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RegisteredContractExport;

class RegisteredContractController extends Controller
{
    public function index()
    {
         //API GET
         $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/RegisteredContractAPI/GetAllRegisteredContract"; 
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $Hasils= json_decode($result);
        //  dd($Hasils);

        return view('registered_contract',['Contracts'=>$Hasils]);  
    }

    public function show(Request $request)
    {
        // API
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/RegisteredContractAPI/GetRegisteredContractById?Id=".$request->Id; 
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
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/RegisteredContractAPI/DeleteRegisteredContractById?Id=".$id;
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
            "NoKontrak"=>$request->ContractNo,
            "Username"=>$request->Username,
            )); 
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/RegisteredContractAPI/GetAllTransactionHistoryRegisteredContractId"; 
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
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/RegisteredContractAPI/GetTransactionHistoryById"; 
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

    public function DownloadRegisteredContract()
    {
         //API GET
         $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/RegisteredContractAPI/GetAllRegisteredContract"; 
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
         foreach ($Hasils as $Hasil) {

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
        return Excel::download(new RegisteredContractExport($data), 'RegisteredContract.xlsx');
    }
    
}
