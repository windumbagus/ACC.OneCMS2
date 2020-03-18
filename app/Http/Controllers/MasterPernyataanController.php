<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterPernyataanController extends Controller
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
            'SubMenuId'=>"38" // "38" untuk SubMenu MasterPernyataan
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

        //API
        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/MasterPernyataanAPI/GetAllMasterPernyataan?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $data = json_decode($result);
        // dd($data);

        //get Perlindungan Untuk
        $url2 = config("global.base_url_outsystems")."/ACCWorldCMS/rest/MasterPernyataanAPI/GetAllPerlindunganUntuk"; 
        $ch2 = curl_init($url2);                                                     
        curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch2, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result2 = curl_exec($ch2);
        $err2 = curl_error($ch2);
        curl_close($ch2);
        $data2 = json_decode($result2);
        // dd($data2);

        //get Jenis Proteksi
        $url3 = config("global.base_url_outsystems")."/ACCWorldCMS/rest/MasterPernyataanAPI/GetAllJenisProteksi"; 
        $ch3 = curl_init($url3);                                                     
        curl_setopt($ch3, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch3, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result3 = curl_exec($ch3);
        $err3 = curl_error($ch3);
        curl_close($ch3);
        $data3 = json_decode($result3);
        // dd($data3);

        //GetAllProduct
        $url4 = config("global.base_url_outsystems")."/ACCWorldCMS/rest/MasterPernyataanAPI/GetAllProduct"; 
        $ch4 = curl_init($url4);                                                     
        curl_setopt($ch4, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch4, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch4, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result4 = curl_exec($ch4);
        $err4 = curl_error($ch4);
        curl_close($ch4);
        $data4 = json_decode($result4);
        // dd($data4);

        //GetAllHubungan
        $url5 = config("global.base_url_outsystems")."/ACCWorldCMS/rest/MasterPernyataanAPI/GetAllHubungan"; 
        $ch5 = curl_init($url5);                                                     
        curl_setopt($ch5, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch5, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch5, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result5 = curl_exec($ch5);
        $err5 = curl_error($ch5);
        curl_close($ch5);
        $data5 = json_decode($result5);
        // dd($data5);

        if((property_exists($data,"Role")) && ($data->Role->IsView == True)){
            return view(
                'master_pernyataan',[
                    'Role' => $data->Role,
                    'Pernyataans' => $data->Data,
                    'Perlindungans' => $data2,
                    'Proteksis' => $data3,
                    'Products' => $data4,
                    'Hubungans' => $data5,
                    'role'=> $Hasilsrole->OUT_DATA, 
                    'countpendingacccash'=>count($Hasilscount->OUT_DATA[0]->dataApply),
                    'session' => $session
            ]);
        }else{
            return redirect('/invalid-permission');
        }  
    }

    public function show(Request $request)
    {
         //API
         $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/MasterPernyataanAPI/GetMasterPernyataanById?MstPernyataanID=".$request->Id; 
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $val = json_decode($result);
         // dd($data);

         return json_encode($val);
    }

    public function delete($id = null,Request $request)
    {
        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/MasterPernyataanAPI/DelateMasterPernyataan?MstPernyataanID=".$id;
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

        return redirect('/master-pernyataan')->with('success',$data->Message);
    }

    public function add(Request $request)
    {
        if($request->pemegang_polis_tertanggung_utama_add == "on"){
            $pemegang_polis_tertanggung_utama_add = true;
        }else{
            $pemegang_polis_tertanggung_utama_add = false;
        }
        
        if($request->asuransi_tambahan_add == "on"){
            $asuransi_tambahan_add = true;
        }else{
            $asuransi_tambahan_add = false;
        }

        $data = json_encode(array(
            // "Id"=> $request->id_update,
            "PerlindunganUntuk"=> $request->perlindungan_untuk_add,
            "JenisProteksi"=> $request->jenis_proteksi_add,
            "NamaProduk"=> $request->nama_product_add,
            "IsPemegangPolisTertanggungUt"=> $pemegang_polis_tertanggung_utama_add,
            "IsiDataTertanggungUtama"=> $request->data_tertanggung_utama_add,
            "IsAsuransiTambahan"=> $asuransi_tambahan_add,
            "Pernyataan"=> $request->pernyataan_add   
        ));

        // dd($data);

        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/MasterPernyataanAPI/CreateOrUpdateMasterPernyataan"; 
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

        return redirect('/master-pernyataan')->with('success',' Data Master Pernyataan Added Successfull !!!');
    }

    public function update(Request $request)
    {
        if($request->pemegang_polis_tertanggung_utama_update == "on"){
            $pemegang_polis_tertanggung_utama_update = true;
        }else{
            $pemegang_polis_tertanggung_utama_update = false;
        }
        
        if($request->asuransi_tambahan_update == "on"){
            $asuransi_tambahan_update = true;
        }else{
            $asuransi_tambahan_update = false;
        }

        $data = json_encode(array(
            "Id"=> $request->Id_update,
            "PerlindunganUntuk"=> $request->perlindungan_untuk_update,
            "JenisProteksi"=> $request->jenis_proteksi_update,
            "NamaProduk"=> $request->nama_product_update,
            "IsPemegangPolisTertanggungUt"=> $pemegang_polis_tertanggung_utama_update,
            "IsiDataTertanggungUtama"=> $request->data_tertanggung_utama_update,
            "IsAsuransiTambahan"=> $asuransi_tambahan_update,
            "Pernyataan"=> $request->pernyataan_update   
        ));

        // dd($data);

        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/MasterPernyataanAPI/CreateOrUpdateMasterPernyataan"; 
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

        return redirect('/master-pernyataan')->with('success',' Data Master Pernyataan Update Successfull !!!');
    }

    
}
