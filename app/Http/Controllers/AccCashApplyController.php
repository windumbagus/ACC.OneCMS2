<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AccCashApplyExport;

class AccCashApplyController extends Controller
{
  
    public function index(Request $request)
    {
    //    dd($this->base_url.'/restV2/acccash/getdata/transactionapply');
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
            "doTransactionApply" => array(   
                // "Id"=> $request->Id_add,
                "P_GUID"=>"",
                "TRANSACTION_CODE"=>"GET_APPLY",
                "P_STATUS"=>$request->Statusapply,
            ),
        ));

        $url = config('global.base_url_sofia').'/restV2/acccash/getdata/transactionapply';

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
           //dd($data);
        //    dd($Hasils);
            return view(
                'acccash_apply',[
                   // 'Role' => $Hasils->Role,
                    'ACCCashApplys'=>$Hasils->OUT_DATA,
                   // 'Roles'=>$Hasils2->Roles,
                  //  'UserCategories'=>$Hasils2->UserCategory, 
                  'Statusapply'=>$request->Statusapply,
                    'session' => $session

            ]);

    }


    public function getbystatus(Request $request)
    {
        
        $data = json_encode(array(
            "doTransactionApply" => array(   
                // "Id"=> $request->Id_add,
                "P_GUID"=>"",
                "TRANSACTION_CODE"=>"GET_APPLY",
                "P_STATUS"=>$request->Statusapply,
            ),
        ));
        //dd($data);
         //API GET
        //$url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/UserCMSAPI/GetAllUserCMS?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
       $url = config('global.base_url_sofia').'/restV2/acccash/getdata/transactionapply';
        // $url = "http://172.16.4.32:8301/restV2/acccash/getdata/transactionapply";
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
        //   dd($Hasils);

        return json_encode($Hasils->OUT_DATA[0]->dataApply);
    }


    public function changestatus(Request $request)
    {
        if($request->STATUS == "REJECT ALL")
        {
            $statuschange = $request->REASONREJECTALL;
            $redirectstatus = "REJECT";
        }
        else if($request->STATUS == "REJECT PARTIAL")
        {
            $statuschange = $request->REASONREJECTPARTIAL;
            $redirectstatus = "REJECT";
        }
        else if($request->STATUS == "PENDING")
        {
            $statuschange = $request->REASONPENDING;
            $redirectstatus = "PENDING";
        }
        else{
            $statuschange = "APPROVED";
            $redirectstatus = "APPROVED";
        }

        switch ($statuschange) {
            case 'REJECT-NOTAPPLY':
                $reasonchange = "Customer tidak merasa mengajukan";
                break;

            case 'REJECT-UNCONTACTED':
                $reasonchange = "Customer tidak dapat dihubungi dalam waktu 3x24 jam";
                break;

            case 'REJECT-DATA':
                $reasonchange = "Customer ingin mengubah data pengajuan";
                break;

            case 'REJECT-PICT':
                $reasonchange = "Foto mobil tidak jelas/tidak sesuai dengan petunjuk";
                break;

            case 'REJECT-WRONGUNIT':
                $reasonchange = "Spesifikasi mobil pada foto tidak sesuai dengan data pada AOL";
                break;

            case 'REJECT-UNIT':
                $reasonchange = "Kondisi mobil tidak layak untuk dibiayai";
                break;

            case 'PENDING-UNCONTACTED':
                $reasonchange = "Customer tidak dapat dihubungi";
                break;

            case 'PENDING-NEXTTIME':
                $reasonchange = "Customer minta dihubungi pada waktu lain";
                break;

            case 'APPROVED':
                $reasonchange = "";
                break;
        
        }

        $data = json_encode(array(
            "doTransactionApply" => array(   
                // "Id"=> $request->Id_add,
                "P_GUID"=>$request->GUID,
                "TRANSACTION_CODE"=>"UPD_APPLY",
                // "P_STATUS"=>$request->STATUS,
               // "P_REASON"=>$request->REASON,
                "P_STATUS"=>$statuschange,
                "P_REASON"=>$reasonchange,
            ),
        ));
        //dd($data);

         //API GET
        //$url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/UserCMSAPI/GetAllUserCMS?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
        $url = config('global.base_url_sofia').'/restV2/acccash/getdata/transactionapply';
        // $url = "http://172.16.4.32:8301/restV2/acccash/getdata/transactionapply";
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
        //   dd($Hasils);




        //ACC LEADS
        if($redirectstatus = "APPROVED"){


            $datacashtoLeads = json_encode(array(
                "doTransactionApply" => array(   
                    "TRANSACTION_CODE"=>"GET_DATA_LMS",
		            "P_ID_APPLY"=>$request->GUID,
                ),
            ));

            //dd($datacashtoleads);
    
            //PREPARATION TO LEADS
            $urlcashtoLeads = config('global.base_url_sofia').'/restV2/acccash/getdata/transactionapply';
            $chcashtoLeads = curl_init($urlcashtoLeads);                   
            curl_setopt($chcashtoLeads, CURLOPT_POST, true);                                  
            curl_setopt($chcashtoLeads, CURLOPT_POSTFIELDS, $datacashtoLeads);
            curl_setopt($chcashtoLeads, CURLOPT_SSL_VERIFYPEER, FALSE);   
            curl_setopt($chcashtoLeads, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
            curl_setopt($chcashtoLeads, CURLOPT_RETURNTRANSFER, true);                                                                  
            $resultcashtoLeads = curl_exec($chcashtoLeads);
            $errcashtoLeads = curl_error($chcashtoLeads);
            curl_close($chcashtoLeads);
            $HasilscashtoLeads= json_decode($resultcashtoLeads); 
            //   dd($HasilscashtoLeads);


            $dataLeads = json_encode(array(
                "doSendDataLeads" => array(   
                    "P_ACCOUNT_ID"=>"",
                    "P_NAME"=>$HasilscashtoLeads->OUT_DATA[0]->NAME, 
                    "P_PRODUCT"=>$HasilscashtoLeads->OUT_DATA[0]->PRODUCT,
                    "P_NO_AGGR"=>$HasilscashtoLeads->OUT_DATA[0]->NO_AGGR,
                    "P_PHONE_NUMBER"=>$HasilscashtoLeads->OUT_DATA[0]->PHONE_MOBILE,
                    "P_CD_VEHICLE_BRAND"=>$HasilscashtoLeads->OUT_DATA[0]->CD_VEHICLE_BRAND,	
                    "P_CD_VEHICLE_MODEL"=>$HasilscashtoLeads->OUT_DATA[0]->CD_VEHICLE_MODEL,		
                    "P_CD_VEHICLE_TYPE"=>$HasilscashtoLeads->OUT_DATA[0]->CD_VEHICLE_TYPE,     		
                    "P_YEAR_OF_MFG"=>$HasilscashtoLeads->OUT_DATA[0]->YEAR_OF_MFG,
                    "P_OTR"=>$HasilscashtoLeads->OUT_DATA[0]->OTR,
                    "P_DP"=>$HasilscashtoLeads->OUT_DATA[0]->DP,
                    "P_TENOR"=>$HasilscashtoLeads->OUT_DATA[0]->TENOR,
                    "P_CD_AREA"=>$HasilscashtoLeads->OUT_DATA[0]->CD_AREA,
                    "P_CD_SP"=>$HasilscashtoLeads->OUT_DATA[0]->CD_SP,
                    "P_FLAT_RATE"=>$HasilscashtoLeads->OUT_DATA[0]->FLAT_RATE,
                    "P_ASURANSI_CASH_KREDIT"=>$HasilscashtoLeads->OUT_DATA[0]->ASURANSI_CASH_KREDIT,
                    "P_FLAG_ACP"=>$HasilscashtoLeads->OUT_DATA[0]->FLAG_ACP,
                    "P_AMT_ACP"=>$HasilscashtoLeads->OUT_DATA[0]->AMT_ACP,
                    "P_TDP"=>$HasilscashtoLeads->OUT_DATA[0]->TDP,
                    "P_SOURCE_LEADS"=>$HasilscashtoLeads->OUT_DATA[0]->SOURCE_LEADS,
                    "P_AGEN_SOURCE_LEADS"=>$HasilscashtoLeads->OUT_DATA[0]->AGEN_SOURCE_LEADS,
                    "P_AMT_INSTALLMENT"=>$HasilscashtoLeads->OUT_DATA[0]->AMT_INSTALLMENT,
                    "P_ADD_AMOUNT"=>$HasilscashtoLeads->OUT_DATA[0]->ADD_AMOUNT,
                    "P_EFF_RATE"=>$HasilscashtoLeads->OUT_DATA[0]->EFF_RATE,
                    "P_NO_ADV_INST"=>$HasilscashtoLeads->OUT_DATA[0]->NO_ADV_INST,
                    "P_PAYMENT_METHOD"=>$HasilscashtoLeads->OUT_DATA[0]->PAYMENT_METHOD,
                    "P_MODE_PROVISI"=>$HasilscashtoLeads->OUT_DATA[0]->MODE_PROVISI,
                    "P_BIAYA_PROVISI"=>$HasilscashtoLeads->OUT_DATA[0]->BIAYA_PROVISI,
                    "P_AF"=>$HasilscashtoLeads->OUT_DATA[0]->AF,
                    "P_INTEREST"=>$HasilscashtoLeads->OUT_DATA[0]->INTEREST,
                    "P_AR"=>$HasilscashtoLeads->OUT_DATA[0]->AR,
                    "ID_USER"=>$HasilscashtoLeads->OUT_DATA[0]->ID_USER,
                    "P_CD_SALESMAN"=>$HasilscashtoLeads->OUT_DATA[0]->CD_SALESMAN,
                    "P_CD_BANK_BR"=>$HasilscashtoLeads->OUT_DATA[0]->CD_BANK_BR,
                    "P_NO_REKENING"=>$HasilscashtoLeads->OUT_DATA[0]->NO_REKENING,
                    "P_NAMA_REKENING"=>$HasilscashtoLeads->OUT_DATA[0]->NAMA_REKENING,
                    "P_CD_CHANNEL"=>"",
                    "P_CD_SPK"=>"",
                ),
            ));

            // dd($dataLeads);
    
            //ACC LEADS
            $urlLeads = config('global.base_url_sofia').'/rest/com/acc/lms/in/httprest/dataentry/dataleads';
            $chLeads = curl_init($urlLeads);                   
            curl_setopt($chLeads, CURLOPT_POST, true);                                  
            curl_setopt($chLeads, CURLOPT_POSTFIELDS, $dataLeads);
            curl_setopt($chLeads, CURLOPT_SSL_VERIFYPEER, FALSE);   
            curl_setopt($chLeads, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
            curl_setopt($chLeads, CURLOPT_RETURNTRANSFER, true);                                                                  
            $resultLeads = curl_exec($chLeads);
            $errLeads = curl_error($chLeads);
            curl_close($chLeads);
            $HasilsLeads= json_decode($resultLeads); 
            //   dd($HasilsLeads);

        }
        



        //dd($Hasils);
        if ($Hasils->OUT_STAT == "T"){
            // return redirect("acccash-apply/".$request->STATUS)->with('success','Status berhasil diubah');
            return redirect("acccash-apply/".$redirectstatus)->with('success','Status berhasil diubah');
        }else{                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
            return redirect("acccash-apply/PENDING")->with('error',$Hasils->OUT_MESS);
        }
       
    }

    public function show(Request $request)
    {

        $data = json_encode(array(
            "doTransactionApply" => array(   
                // "Id"=> $request->Id_add,
                "P_GUID"=>$request->Id,
                // "P_NO_AGGR"=>$request->P_NO_AGGR,
                "TRANSACTION_CODE"=>"GET_APPLY",
               
            ),
        ));
        
         //API GET
         $url = config('global.base_url_sofia').'/restV2/acccash/getdata/transactionapply';
         //dd($data);
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
         $val= json_decode($result);
         // dd($val);
         //dd($err);
        return json_encode($val);
    }

    
    public function download(Request $request)
    {
         //API GET

         $data = json_encode(array(
            "doTransactionApply" => array(   
                // "Id"=> $request->Id_add,
                "P_GUID"=>"",
                "TRANSACTION_CODE"=>"GET_APPLY",
                "P_STATUS"=>$request->Statusapply,
            ),
        ));
         //$url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/UserCMSAPI/DownloadUserCMS"; 
         $url = config('global.base_url_sofia').'/restV2/acccash/getdata/transactionapply';
        //  $url = "http://172.16.4.32:8301/restV2/acccash/getdata/transactionapply";
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

         $data=[];
         foreach ($Hasils->OUT_DATA[0]->dataApply as $Hasil) {
 
             array_push($data,[
                 "NoAggr"=>$Hasil->NO_AGGR,
                 "Disbursement"=>$Hasil->DISBURSEMENT,
                 "AmtInstallment"=>$Hasil->AMT_INSTALLMENT,
                 "Tenor"=>$Hasil->TENOR,
                 "TujuanPenggunaan"=>$Hasil->TUJUAN_PENGGUNAAN,
                 "Penyedia"=>$Hasil->PENYEDIA,
                 "IDUser"=>$Hasil->ID_USER,
                 "DTAdded"=>$Hasil->DT_ADDED,
                 "IDUserUpdated"=>$Hasil->ID_USER_UPDATED,
                 "DTUpdated"=>$Hasil->DT_UPDATED,
                 "Status"=>$Hasil->STATUS,
                 "Reason"=>$Hasil->REASON,
                 "Btmy"=>$Hasil->BTMY,
                 "PhoneMobile1"=>$Hasil->PHONE_MOBILE1,
                 "PhoneMobile2"=>$Hasil->PHONE_MOBILE2,
                 "Area"=>$Hasil->AREA,
                 "Cabang"=>$Hasil->CABANG,
                 "NoPolisi"=>$Hasil->NO_CAR_POLICE,
                 "PefindoScore"=>$Hasil->PEFINDO_SCORE,
                 "PefindoDetail"=>$Hasil->PEFINDO_DETAIL,

            ]);
         }
        //  dd($data);
         return Excel::download(new ACCCashApplyExport($data), 'ACCCash Apply '.$request->Statusapply.' '. date("Y-m-d His") .'.xlsx');
    }


}
