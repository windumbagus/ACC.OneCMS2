<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AccCashApplyExport;

class ACCCashApplyController extends Controller
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
        if($request->STATUS == "REJECT")
        {
            $statuschange = $request->REASONREJECT;
        }
        else if($request->STATUS == "PENDING")
        {
            $statuschange = $request->REASONPENDING;
        }
        else{
            $statuschange = "APPROVED";
        }

        switch ($statuschange) {
            case 'REJECT-NOTAPPLY':
                $reasonchange = "Customer tidak merasa mengajukan";
                break;

            case 'REJECT-UNCONTACTED':
                $reasonchange = "Customer tidak dapat dihubungi dalam waktu 3x24 jam";
                break;

            case 'REJECT-DATA':
                $reasonchange = "Customer berubah pikiran terhadap nominal dan tenor yang diajukan dan ingin mengajukan ulang sendiri";
                break;

            case 'REJECT-DATA2':
                $reasonchange = "Customer berubah pikiran terhadap nominal dan tenor yang diajukan dan ingin diproses secara manual oleh cabang";
                break;

            case 'REJECT-PICT':
                $reasonchange = "Foto mobil tidak sesuai dengan petunjuk";
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


        $dataLeads = json_encode(array(
            "doSendDataLeads" => array(   
                "P_ACCOUNT_ID"=>"",
                "P_NAME"=>$request->ID_USER, 
                "P_PRODUCT"=>"0001",
                "P_NO_AGGR"=>$request->NO_AGGR,
                "P_PHONE_NUMBER"=>$request->PHONE_MOBILE_1,
                "P_CD_VEHICLE_BRAND"=>"002",	
                "P_CD_VEHICLE_MODEL"=>"014",		
                "P_CD_VEHICLE_TYPE"=>"N01",     		
                "P_YEAR_OF_MFG"=>"2019",
                "P_OTR"=>"150000000",
                "P_DP"=>"25",
                "P_TENOR"=>$request->TENOR,
                "P_CD_AREA"=>$request->AREA,
                "P_CD_SP"=>$request->CABANG,
                "P_FLAT_RATE"=>"",
                "P_ASURANSI_CASH_KREDIT"=>"C",
                "P_FLAG_ACP"=>"",
                "P_AMT_ACP"=>"",
                "P_TDP"=>"",
                "P_SOURCE_LEADS"=>"098",
                "P_AGEN_SOURCE_LEADS"=>"",
                "P_AMT_INSTALLMENT"=>$request->AMT_INSTALLMENT,
                "P_CD_CHANNEL"=>"",
                "P_CD_SPK"=>"",
            ),
        ));

        //ACC LEADS
        if($statuschange = "APPROVED"){


            //dd($dataleads);
    
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
            return redirect("acccash-apply/".$request->STATUS)->with('success','Status berhasil diubah');
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
