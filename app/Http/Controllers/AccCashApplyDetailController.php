<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AccCashApplyExport;
use PDF;

class AccCashApplyDetailController extends Controller
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
           // 'SubMenuId'=>"15" // "15" untuk SubMenu UserCms
        ]);

        $role = json_encode(array(  
            // "Id"=> $request->Id_add,
            "ROLEID"=>$request->session()->get('RoleId'),
        
        ));

        $urlrole = config('global.base_url_outsystems').'/ACCWorldCMS/rest/CheckRoleAPI/CheckRole';

        $chrole = curl_init($urlrole);                   
        curl_setopt($chrole, CURLOPT_POST, true);                                  
        curl_setopt($chrole, CURLOPT_POSTFIELDS, $role);
        curl_setopt($chrole, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($chrole, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($chrole, CURLOPT_RETURNTRANSFER, true);                                                                  
        $resultrole = curl_exec($chrole);
        $errrole = curl_error($chrole);
        curl_close($chrole);
        $Hasilsrole= json_decode($resultrole);
        //dd($Hasilsrole);

        $datacount = json_encode(array(
            "doTransactionApply" => array(   
                // "Id"=> $request->Id_add,
                "P_GUID"=>"",
                "TRANSACTION_CODE"=>"GET_APPLY",
                "P_STATUS"=>"PENDING",
            ),
        ));

        $urlcount = config('global.base_url_sofia').'/restV2/acccash/getdata/transactionapply';

        $chcount = curl_init($urlcount);                   
        curl_setopt($chcount, CURLOPT_POST, true);                                  
        curl_setopt($chcount, CURLOPT_POSTFIELDS, $datacount);
        curl_setopt($chcount, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($chcount, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($chcount, CURLOPT_RETURNTRANSFER, true);                                                                  
        $resultcount = curl_exec($chcount);
        $errcount = curl_error($chcount);
        curl_close($chcount);
        $Hasilscount= json_decode($resultcount); 

        $data = json_encode(array(
            "doTransactionApply" => array(   
                // "Id"=> $request->Id_add,
                "P_GUID"=>$request->GUID,
                // "P_NO_AGGR"=>$request->P_NO_AGGR,
                "TRANSACTION_CODE"=>"GET_APPLY",
               
            ),
        ));
        //dd($request->session()->get('Name'));        
         //API GET
         $url = config('global.base_url_sofia').'/restV2/acccash/getdata/transactionapply';
        //  dd($data);
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
         $Hasils= json_decode($result);
        //   dd($Hasils);

        $data_detail = json_encode(array(
            "doTransactionApply" => array(   
                "TRANSACTION_CODE"=>"GET_ACTIVITY",
                "P_ID_APPLY"=>$request->GUID,
                "P_LANGUAGE"=>"",
            ),
        ));

       
         //API GET
       
        $url = config('global.base_url_sofia').'/restV2/acccash/getdata/transactionapply';
        $ch_detail = curl_init($url);                   
        curl_setopt($ch_detail, CURLOPT_POST, true);                                  
        curl_setopt($ch_detail, CURLOPT_POSTFIELDS, $data_detail);
        curl_setopt($ch_detail, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch_detail, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch_detail, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result_detail = curl_exec($ch_detail);
        $err_detail = curl_error($ch_detail);
        curl_close($ch_detail);
        $Hasils_detail= json_decode($result_detail); 
            //    dd($Hasils_detail);
            //   dd($data_detail);

            if ($Hasilsrole->OUT_DATA == 'Super Admin' || $Hasilsrole->OUT_DATA == 'Super_Admin' || $Hasilsrole->OUT_DATA == 'acccash')
            {
                return view(
                    'acccash_apply_detail',[
                       // 'Role' => $Hasils->Role,
                        'AccCashApplys'=>$Hasils->OUT_DATA[0]->dataApply,
                        'AccCashApplyPictures'=>$Hasils->OUT_DATA[0]->dataPicture,
                        'AccCashApplyDetails'=>$Hasils_detail->OUT_DATA,
                        'Statusapply'=>$request->Statusapply,
                       // 'Roles'=>$Hasils2->Roles,
                      //  'UserCategories'=>$Hasils2->UserCategory, 
                      'role'=> $Hasilsrole->OUT_DATA,
                      'countpendingacccash'=>count($Hasilscount->OUT_DATA[0]->dataApply),
                        'session' => $session
                ]);
            }
            else
            {
                return redirect('/invalid-permission');
            }

    }

    public function changestatus(Request $request)
    {

        // $data_mail = [
        //     'EMAIL' => $request->EMAIL,
        //     'DISBURSEMENT' => $request->DISBURSEMENT,
        //     'NO_AGGR'=>$request->NO_AGGR
        // ];
        // // dd($data_mail);
        // \Mail::to('atosna70@gmail.com')->send(new \App\Mail\MailAccCashApproved($data_mail));


        //   @dd($request->EMAIL);
        $statusnotif = "";
        if($request->STATUS == "REJECT SEMUA")
        {
            $statuschange = $request->REASONREJECTALL;
            $redirectstatus = "REJECT";
        }
        else if($request->STATUS == "REJECT SEBAGIAN")
        {
            $statuschange = $request->REASONREJECTPARTIAL;
            $redirectstatus = "REJECT";
            //$redirectstatus = "PENDING";
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
        // @dd($redirectstatus);

        switch ($statuschange) {

        //REJECT ALL
            case 'REJECT-NOTAPPLY':
                $reasonchange = "Customer tidak merasa mengajukan";
                $statusnotif = 'Pengajuan Kamu sebesar Rp'.$request->DISBURSEMENT.' dari No. Kontrak '.$request->NO_AGGR.' ditolak karena belum memenuhi syarat dan ketentuan yang berlaku.';
                break;

            case 'REJECT-UNCONTACTED':
                $reasonchange = "Customer tidak dapat dihubungi dalam waktu 3x24 jam";
                $statusnotif = "Pengajuan Kamu dialihkan ke cabang ACC karena kami tidak dapat menghubungi Kamu selama 3x24 jam.";
                break;

            case 'REJECT-WRONGUNIT':
                $reasonchange = "Spesifikasi mobil pada foto tidak sesuai dengan data pada AOL";
                $statusnotif = 'Pengajuan Kamu sebesar Rp'.$request->DISBURSEMENT.' dari No. Kontrak '.$request->NO_AGGR.' ditolak karena belum memenuhi syarat dan ketentuan yang berlaku.';
                break;

            case 'REJECT-UNIT':
                $reasonchange = "Kondisi mobil tidak layak untuk dibiayai";
                $statusnotif = 'Pengajuan Kamu sebesar Rp'.$request->DISBURSEMENT.' dari No. Kontrak '.$request->NO_AGGR.' ditolak karena belum memenuhi syarat dan ketentuan yang berlaku.';
                break;

            case 'REJECT-STNKEXP':
                $reasonchange = "Masa berlaku STNK habis dan customer tidak bersedia perpanjang";
                $statusnotif = 'Pengajuan Kamu sebesar Rp'.$request->DISBURSEMENT.' dari No. Kontrak '.$request->NO_AGGR.' ditolak karena belum memenuhi syarat dan ketentuan yang berlaku.';
                break;

            case 'REJECT-STNKINVALID':
                $reasonchange = "Data pada STNK yang dilampirkan tidak sesuai (No. Polisi berbeda dengan data yang tertera di CMS)";
                $statusnotif = 'Pengajuan Kamu sebesar Rp'.$request->DISBURSEMENT.' dari No. Kontrak '.$request->NO_AGGR.' ditolak karena belum memenuhi syarat dan ketentuan yang berlaku.';
                break;

            case 'REJECT':
                $reasonchange = "Customer berubah pikiran dan ingin mengajukan ulang";
                $statusnotif = 'Pengajuan Kamu sebesar Rp'.$request->DISBURSEMENT.' dari No. Kontrak '.$request->NO_AGGR.' ditolak karena belum memenuhi syarat dan ketentuan yang berlaku.';
                break;

        //REJECT PARTIAL
            case 'REJECT-DATA':
                $reasonchange = "Customer ingin mengubah data pengajuan";
                $statusnotif = "Kamu masih dapat mengubah informasi pengajuan kamu. Ubah sekarang yuk!";
                break;

            case 'REJECT-PICT':
                $reasonchange = "Foto mobil tidak jelas/tidak sesuai dengan petunjuk";
                $statusnotif = "Pengajuan Kamu belum dapat diproses, Mohon unggah kembali foto mobil Kamu.";
                break;

            case 'REJECT-STNK':
                $reasonchange = "Perlu Foto Ulang STNK";
                $statusnotif = "Pengajuan Kamu belum dapat diproses, Mohon unggah kembali foto STNK Kamu.";
                break;

            case 'REJECT-STNKUNIT':
                $reasonchange = "Perlu Foto Ulang Unit dan STNK";
                $statusnotif = "Pengajuan Kamu belum dapat diproses, Mohon unggah kembali foto STNK dan mobil Kamu.";
                break;  

            case 'PENDING-UNCONTACTED':
                $reasonchange = "Customer tidak dapat dihubungi";
                break;

            case 'PENDING-NEXTTIME':
                $reasonchange = "Customer minta dihubungi pada waktu lain";
                break;

            case 'APPROVED':
                $reasonchange = "";
                $statusnotif = 'Pengajuan Kamu sebesar Rp'.$request->DISBURSEMENT.' dari No Kontrak '.$request->NO_AGGR.' telah disetujui. Kamu akan segera kami hubungi untuk tanda tangan kontrak.';
                break;
        
        }
        // dd($statusnotif);

       //getdatalms
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



        //ACC LEADS
        if($redirectstatus == 'REJECT'){

            if ($statuschange == 'REJECT-UNCONTACTED')
            {
                $dataLeads = json_encode(array(
                    "doSendDataLeads" => array(   
                        "P_ACCOUNT_ID"=>$HasilscashtoLeads->OUT_DATA[0]->ACCOUNT_ID,
                        "P_NAME"=>$HasilscashtoLeads->OUT_DATA[0]->NAME, 
                        "P_PRODUCT"=>"0003",
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
                        "P_ADMIN_FEE"=>$HasilscashtoLeads->OUT_DATA[0]->ADMIN_FEE,
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
                        "P_RESERVE1"=> $HasilscashtoLeads->OUT_DATA[0]->AMT_CASH_PENCAIRAN,
                        "P_RESERVE2"=> $HasilscashtoLeads->OUT_DATA[0]->AMT_CASH_INT,
                        "P_RESERVE3"=> $HasilscashtoLeads->OUT_DATA[0]->TENOR_CASH,
                        "P_RESERVE4"=> $HasilscashtoLeads->OUT_DATA[0]->TUJUAN_DANA,
                        "P_RESERVE5"=> $HasilscashtoLeads->OUT_DATA[0]->BARANG_JASA,
                        "P_RESERVE6"=> $request->EXP_STNK,
                        "P_CD_CHANNEL"=>"",
                        "P_CD_SPK"=>"",
                    ),
                ));
                //  dd($dataLeads);
                //ACC LEADS
                $urlLeads = config('global.base_url_sofia2').'/rest/com/acc/lms/in/httprest/dataentry/dataleads';
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
                  //dd($HasilsLeads);

                // Mail Send
                //if($HasilsLeads->OUT_STAT == "T"){

                    $data_mail = [
                        'NAME' => $request->NAME,
                        'EMAIL' => $request->EMAIL,
                        'DISBURSEMENT' => $request->DISBURSEMENT,
                        'NO_AGGR'=>$request->NO_AGGR,
                        'CABANG'=>$request->CABANG
                    ];
                    // dd($data_mail);
                    \Mail::to($request->EMAIL)->send(new \App\Mail\MailAccCashReject($data_mail));
                //}
                
                $directstatus = "REJECT";
                //$leadsid=null;
                $leadsid=$HasilsLeads->OUT_DATA;
            }
            else if($request->STATUS == "REJECT PARTIAL")
            {
                $directstatus = "REJECT";
                $leadsid=null;
            }
            else if($statuschange == 'REJECT-STNKEXP') 
            {

                $dataLeads = json_encode(array(
                    "doSendDataLeads" => array(   
                        "P_ACCOUNT_ID"=>$HasilscashtoLeads->OUT_DATA[0]->ACCOUNT_ID,
                        "P_NAME"=>$HasilscashtoLeads->OUT_DATA[0]->NAME, 
                        "P_PRODUCT"=>"0003",
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
                        "P_ADMIN_FEE"=>$HasilscashtoLeads->OUT_DATA[0]->ADMIN_FEE,
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
                        "P_RESERVE1"=> $HasilscashtoLeads->OUT_DATA[0]->AMT_CASH_PENCAIRAN,
                        "P_RESERVE2"=> $HasilscashtoLeads->OUT_DATA[0]->AMT_CASH_INT,
                        "P_RESERVE3"=> $HasilscashtoLeads->OUT_DATA[0]->TENOR_CASH,
                        "P_RESERVE4"=> $HasilscashtoLeads->OUT_DATA[0]->TUJUAN_DANA,
                        "P_RESERVE5"=> $HasilscashtoLeads->OUT_DATA[0]->BARANG_JASA,
                        "P_RESERVE6"=> $request->EXP_STNK,
                        "P_CD_CHANNEL"=>"",
                        "P_CD_SPK"=>"",
                    ),
                ));
                //  dd($dataLeads);
                //ACC LEADS
                $urlLeads = config('global.base_url_sofia2').'/rest/com/acc/lms/in/httprest/dataentry/dataleads';
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
                  //dd($HasilsLeads);

                $data_mail = [
                    'NAME' => $request->NAME,
                    'EMAIL' => $request->EMAIL,
                    'DISBURSEMENT' => $request->DISBURSEMENT,
                    'NO_CAR_POLICE'=>$request->NO_CAR_POLICE,
                    'CABANG'=>$request->CABANG
                ];
                // dd($data_mail);
                \Mail::to($request->EMAIL)->send(new \App\Mail\MailAccCashRejectStnkExp($data_mail));

                $directstatus = "REJECT";
                //$leadsid=null;
                $leadsid=$HasilsLeads->OUT_DATA;
            }
            else if($statuschange == 'REJECT-STNKINVALID') 
            {
                $data_mail = [
                    'NAME' => $request->NAME,
                    'EMAIL' => $request->EMAIL,
                    'DISBURSEMENT' => $request->DISBURSEMENT,
                    'NO_CAR_POLICE'=>$request->NO_CAR_POLICE,
                    'CABANG'=>$request->CABANG
                ];
                // dd($data_mail);
                \Mail::to($request->EMAIL)->send(new \App\Mail\MailAccCashRejectStnkInvalid($data_mail));

                $directstatus = "REJECT";
                $leadsid=null;
            }
            else 
            {
                $data_mail = [
                    'NAME' => $request->NAME,
                    'EMAIL' => $request->EMAIL,
                    'DISBURSEMENT' => $request->DISBURSEMENT,
                    'NO_AGGR'=>$request->NO_AGGR,
                    'CABANG'=>$request->CABANG
                ];
                // dd($data_mail);
                \Mail::to($request->EMAIL)->send(new \App\Mail\MailAccCashRejectAll($data_mail));

                $directstatus = "REJECT";
                $leadsid=null;

                // dd($statuschange);
            }
        }
        else if ($redirectstatus == 'APPROVED')
        {
            
            $dataLeads = json_encode(array(
                "doSendDataLeads" => array(   
                    "P_ACCOUNT_ID"=>$HasilscashtoLeads->OUT_DATA[0]->ACCOUNT_ID,
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
                    "P_ADMIN_FEE"=>$HasilscashtoLeads->OUT_DATA[0]->ADMIN_FEE,
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
                    "P_RESERVE1"=> $HasilscashtoLeads->OUT_DATA[0]->AMT_CASH_PENCAIRAN,
                    "P_RESERVE2"=> $HasilscashtoLeads->OUT_DATA[0]->AMT_CASH_INT,
                    "P_RESERVE3"=> $HasilscashtoLeads->OUT_DATA[0]->TENOR_CASH,
                    "P_RESERVE4"=> $HasilscashtoLeads->OUT_DATA[0]->TUJUAN_DANA,
                    "P_RESERVE5"=> $HasilscashtoLeads->OUT_DATA[0]->BARANG_JASA,
                    "P_RESERVE6"=> $request->EXP_STNK,
                    "P_CD_CHANNEL"=>"",
                    "P_CD_SPK"=>"",
                ),
            ));
            // dd($dataLeads);
            //ACC LEADS
            $urlLeads = config('global.base_url_sofia2').'/rest/com/acc/lms/in/httprest/dataentry/dataleads';
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
            

            
    
    

            // Mail Send
           // if($HasilsLeads->OUT_STAT == "T"){

                $data_mail = [
                    'NAME' => $request->NAME,
                    'EMAIL' => $request->EMAIL,
                    'DISBURSEMENT' => $request->DISBURSEMENT,
                    'NO_AGGR'=>$request->NO_AGGR,
                    'CABANG'=>$request->CABANG
                ];
                // dd($data_mail);
                \Mail::to($request->EMAIL)->send(new \App\Mail\MailAccCashApproved($data_mail));
            //}
            
            $directstatus = "APPROVED";
            $leadsid=$HasilsLeads->OUT_DATA;
        }
        else
        {
            $directstatus = "PENDING";
            $leadsid=null;
        }
        


        $data = json_encode(array(
            "doTransactionApply" => array(   
                // "Id"=> $request->Id_add,
                "P_GUID"=>$request->GUID,
                "TRANSACTION_CODE"=>"UPD_APPLY",
                // "P_STATUS"=>$request->STATUS,
               // "P_REASON"=>$request->REASON,
               "P_ID_USER"=>$request->session()->get('Name'),
               "P_LEADS_ID"=>$leadsid,
                "P_STATUS"=>$statuschange,
                "P_REASON"=>$reasonchange,
            ),
        ));
        // dd($data);

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

         //@dd($directstatus);

        if($statusnotif != "")
        {
            $datanotif = json_encode(array(
                "doTransactionApply" => array(   
                    // "Id"=> $request->Id_add,
                    "P_EMAIL"=>$request->EMAIL,
                    "TRANSACTION_CODE"=>"SEND_NOTIF",
                    // "P_STATUS"=>$request->STATUS,
                   // "P_REASON"=>$request->REASON,
                    "P_MESSAGE"=>$statusnotif,
                ),
            ));
            //`dd($datanotif);
    
            //SEND NOTIF
            $urlnotif = config('global.base_url_sofia').'/restV2/acccash/getdata/transactionapply';
            $chnotif = curl_init($urlnotif);                   
            curl_setopt($chnotif, CURLOPT_POST, true);                                  
            curl_setopt($chnotif, CURLOPT_POSTFIELDS, $datanotif);
            curl_setopt($chnotif, CURLOPT_SSL_VERIFYPEER, FALSE);   
            curl_setopt($chnotif, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
            curl_setopt($chnotif, CURLOPT_RETURNTRANSFER, true);                                                                  
            $resultnotif = curl_exec($chnotif);
            $errnotif = curl_error($chnotif);
            curl_close($chnotif);
            $Hasilsnotif= json_decode($resultnotif); 
            //   dd($Hasilsnotif);
        }
        
        


        //dd($Hasils);
       // if ($Hasils->OUT_STAT == "T"){
            // return redirect("acccash-apply/".$request->STATUS)->with('success','Status berhasil diubah');
            // return redirect("acccash-apply/".$directstatus)->with('success','Status berhasil diubah');
            return redirect("acccash-apply/PENDING")->with('success','Status berhasil diubah');
        //}else{
        //    return redirect("acccash-apply/PENDING")->with('error',$Hasils->OUT_MESS);
       // }
       
    }

    public function cetakPDF(Request $request)
    {
        //API GET
        $data = json_encode(array(
            "doTransactionApply" => array(   
                // "Id"=> $request->Id_add,
                "P_GUID"=>$request->GUID,
                // "P_NO_AGGR"=>$request->P_NO_AGGR,
                "TRANSACTION_CODE"=>"GET_APPLY",
               
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
        //   dd($Hasils);

        //API GET       
        $data_detail = json_encode(array(
            "doTransactionApply" => array(   
                "TRANSACTION_CODE"=>"GET_ACTIVITY",
                "P_ID_APPLY"=>$request->GUID,
                "P_LANGUAGE"=>"",
            ),
        ));

        $url = config('global.base_url_sofia').'/restV2/acccash/getdata/transactionapply';
        $ch_detail = curl_init($url);                   
        curl_setopt($ch_detail, CURLOPT_POST, true);                                  
        curl_setopt($ch_detail, CURLOPT_POSTFIELDS, $data_detail);
        curl_setopt($ch_detail, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch_detail, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch_detail, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result_detail = curl_exec($ch_detail);
        $err_detail = curl_error($ch_detail);
        curl_close($ch_detail);
        $Hasils_detail= json_decode($result_detail); 
           
    	$pdf = PDF::loadview('acccash_apply_detail_pdf',[
                                'AccCashApplys'=>$Hasils->OUT_DATA[0]->dataApply,
                                'AccCashApplyPictures'=>$Hasils->OUT_DATA[0]->dataPicture,
                                'AccCashApplyDetails'=>$Hasils_detail->OUT_DATA,
                                'Statusapply'=>$request->Statusapply,
                                // 'session' => $session
                            ]);
    	return $pdf->download('AccCash-Apply-Detail-GUID-'.$request->GUID.'.pdf');
    }

}
