<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatusPengajuanController extends Controller
{
    public function index()
    {
        //API GET
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/StatusPengajuanAPI/GetAllStatusPengajuan"; 
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $Hasils = json_decode($result);
        //  dd($Hasils);

        return view('status_pengajuan',['Status_pengajuans'=>$Hasils]);  
    }

    public function show(Request $request)
    {
        // API
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/StatusPengajuanAPI//GetStatusPengajuanById?MstStatusPengajuan_Id=".$request->Id; 
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

    public function delete($id=null,Request $request)
    {
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/StatusPengajuanAPI//DeleteStatusPengajuanById?MstStatusPengajuan_Id=".$id;
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

        return redirect('/status-pengajuan-aplikasi');
    }
    
    public function StatusData(Request $request)
    {
        // API
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/StatusPengajuanAPI/GetAllStatusDataByStatusPengajuanId?MstStatusPengajuan_Id=".$request->Id; 
        $ch = curl_init($url);                                                     
        //  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $Hasil = json_decode($result);
        // dd($Status_Datas);

        return  ['Status_Datas' => $Hasil];
    }
}
