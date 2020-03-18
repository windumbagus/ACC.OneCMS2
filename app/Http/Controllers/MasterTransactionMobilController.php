<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MasterTransactionMobilExport;

class MasterTransactionMobilController extends Controller
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
            'SubMenuId'=>"31" // "31" untuk SubMenu MasterTransactionMobil,
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

         //API GET
         $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/MasterTransactionMobilAPI/GetAllMasterTransactionMobil?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
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
            return view('master_transaction_mobil',[
                'Role' => $Hasils->Role,
                'Transactions'=> $Hasils->Data,
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
        //API GET
        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/MasterTransactionMobilAPI/GetMasterTransactionMobilById?MstTransactionMobilId=".$request->Id; 
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val= json_decode($result);
        // dd($Hasils);
        return json_encode($val);
    }

    public function delete($id = null,Request $request)
    {
        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/MasterTransactionMobilAPI/DeleteMasterTransactionMobil?MST_TransactionMobilId=".$id;
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

        return redirect('/master-transaction-mobil')->with('success','Data Master Transaction Mobil Delete Successfull !!!');
    }

    public function download(Request $request)
    {
       //API GET
       $session=[];
        array_push($session,[
            'LoginSession'=>$request->session()->get('LoginSession'),
            'Email'=>$request->session()->get('Email'),
            'Name'=>$request->session()->get('Name'),
            'Id'=>$request->session()->get('Id'),
            'RoleId'=>$request->session()->get('RoleId'),
            'SubMenuId'=>"31" // "31" untuk SubMenu MasterTransactionMobil,
        ]);

       //API GET
       $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/MasterTransactionMobilAPI/GetAllMasterTransactionMobil?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
       $ch = curl_init($url);                                                     
       curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
       curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
       $result = curl_exec($ch);
       $err = curl_error($ch);
       curl_close($ch);
       $Hasils= json_decode($result);
    //    dd($Hasils);

        $data=[];
        foreach ($Hasils->Data as $Hasil) {

            if (property_exists($Hasil->User, 'Name')){
                $Name = $Hasil->User->Name;
            }else{
                $Name = "";
            }

            if (property_exists($Hasil->MstTransactionMobil, 'NomorPlat')){
                $NomorPlat = $Hasil->MstTransactionMobil->NomorPlat;
            }else{
                $NomorPlat = "";
            }

            if (property_exists($Hasil->MstTransactionMobil, 'DueDate')){
                $DueDate = $Hasil->MstTransactionMobil->DueDate;
            }else{
                $DueDate = "";
            }
        
            if (property_exists($Hasil->MstTransactionMobil, 'Colour')){
                $Colour = $Hasil->MstTransactionMobil->Colour;
            }else{
                $Colour = "";
            }

            if (property_exists($Hasil->MstTransactionMobil, 'ColourSTNK')){
                $ColourSTNK = $Hasil->MstTransactionMobil->ColourSTNK;
            }else{
                $ColourSTNK = "";
            }

            if (property_exists($Hasil->MstTransactionMobil, 'PolicyNumber')){
                $PolicyNumber = $Hasil->MstTransactionMobil->PolicyNumber;
            }else{
                $PolicyNumber = "";
            }



            array_push($data,[
                "Nama"=>$Name,
                "NoPolisi"=>$NomorPlat,
                "NamaTertanggung"=>$Hasil->MstTransactionMobil->NamaTertanggung,
                "Kendaraan"=>$Hasil->MstTransactionMobil->Kendaraan,
                "Pertanggungan"=>$Hasil->MstTransactionMobil->Pertanggungan,
                "HargaPertanggungan"=>$Hasil->MstTransactionMobil->HargaPertanggungan,
                "Warna"=>$Colour,
                "ColorOnSTNK"=>$ColourSTNK,
                "NoKontrak"=>$PolicyNumber,
                "DueDate"=>$DueDate
            ]);
        }
    //   dd($data);
    
      return Excel::download(new MasterTransactionMobilExport($data), 'accone Master Transaction Mobil '. date("Y-m-d") .'.xlsx');   
    }
}
