<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataPemegangPolisExport;

class DataPemegangPolisController extends Controller
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
        // API
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/DataPemegangPolisAPI/GetAllDataPemegangPolis"; 
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $data = json_decode($result);
        // dd($data);

        return view(
            'data_pemegang_polis',[
                'Poliss' => $data,
                'session' => $session
        ]);    
    }

    public function show(Request $request)
    {
         // API
         $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/DataPemegangPolisAPI/GetDataPemegangPolisSimulasiById?MstDataPemegangPolisId=".$request->Id; 
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $val = json_decode($result);
        //  dd($val);

         return json_encode($val);
    }

    public function downloadSimulasi(Request $request)
    {
         // API
         $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/DataPemegangPolisAPI/GetAllDataPemegangPolis"; 
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $Hasils = json_decode($result);
         // dd($data);

         $data=[];
         foreach ($Hasils->Simulasi as $Simulasi) {
 
            if (property_exists($Simulasi,'AddedDate')){
                $AddedDate = $Simulasi->AddedDate;
            }else{
                $AddedDate = "";
            }

            if (property_exists($Simulasi,'UserAdded')){
                $UserAdded = $Simulasi->UserAdded;
            }else{
                $UserAdded = "";
            }

            if (property_exists($Simulasi,'MstPicturesId')){
                $MstPicturesId = $Simulasi->MstPicturesId;
            }else{
                $MstPicturesId = "";
            }

            if (property_exists($Simulasi,'UpdatedDate')){
                $UpdatedDate = $Simulasi->UpdatedDate;
            }else{
                $UpdatedDate = "";
            }

            if (property_exists($Simulasi,'UserUpdated')){
                $UserUpdated = $Simulasi->UserUpdated;
            }else{
                $UserUpdated = "";
            }
            
           array_push($data,[
               "Id"=>$Simulasi->Id,
               "Nama"=>$Simulasi->Nama,
               "TanggalLahir"=>$Simulasi->TanggalLahir,
               "JenisKelamin"=>$Simulasi->JenisKelamin,
               "Handphone"=>$Simulasi->Handphone,
               "NoKTP"=>$Simulasi->NoKTP,
               "MstPictures"=>$MstPicturesId,
               "Email"=>$Simulasi->Email,
               "Alamat"=>$Simulasi->Alamat,
               "Provinsi"=>$Simulasi->Provinsi,
               "KodePos"=>$Simulasi->KodePos,
               "MstStatus"=>$Simulasi->MstStatusId,
               "AddedDate"=>$AddedDate,
               "UserAdded"=>$UserAdded,
               "UpdatedDate"=>$UpdatedDate,
               "UserUpdated"=>$UserUpdated,
               "User"=>$Simulasi->UserId,
           ]);
         }
        //  dd($data);
       
         return Excel::download(new DataPemegangPolisExport($data), 'ACCSafe Data Pemegang Polis '. date("Y-m-d") .'.xlsx'); 
    }
}
