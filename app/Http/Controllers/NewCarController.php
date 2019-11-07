<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\NewCarExport;
use Maatwebsite\Excel\Facades\Excel;

class NewCarController extends Controller
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
            'SubMenuId'=>"4" // "4" untuk SubMenu NewCar,
        ]);
        
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/NewCarAPI/GetAllNewCar?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"];  
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $Hasils = json_decode($result);
        // dd($Hasils);

        if((property_exists($Hasils,"Role")) && ($Hasils->Role->IsView == True)){
            return view('new_car',[
                'Role' => $Hasils->Role,
                'MstTransaksiList' => $Hasils->Data->MstTransaksiList,
                'MstTrsansaksi_StatusList'=> $Hasils->Data->MstTrsansaksi_StatusList,
                'session'=> $session     
            ]);  
        }else{
            return redirect('/invalid-permission');
        } 
    }

    public function getByCondition(Request $request)
    {
        $data = json_encode(
            array(
                "Status" => $request->Status,
                "StartDate" => $request->StartDate,
                "EndDate" => $request->EndDate,
            )
        );
        // dd($data);

        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/NewCarAPI/GetAllNewCarByCondition"; 
        $ch = curl_init($url);                   
        curl_setopt($ch, CURLOPT_POST, true);                                  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val = json_decode($result);
        // dd($val);

        return json_encode($val);  
    }

    public function show(Request $request)
    {
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/NewCarAPI/GetNewCarById?Input=".$request->Id; 
        // dd($url);  
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

    public function delete($id=null, Request $request)
    {
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/NewCarAPI/DeleteNewCarById?Input=".$id;
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

        return redirect('/new-car')->with('success',' Delete Data Successfully!');
    }
    
    public function update(Request $request)
    {
        $data = json_encode(
            array(
                "MstTransaksi_Id" => $request->updateNewCar_MstTransaksi_Id,
                "MstTransaksi_Notes" => $request->updateNewCar_MstTransaksi_Notes,
            )
        );
        // dd($data);

        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/NewCarAPI/FollowUpNewCar"; 
        $ch = curl_init($url);                   
        curl_setopt($ch, CURLOPT_POST, true);                                  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val = json_decode($result);
        // dd($val);

        if(property_exists($val, 'IsSuccess') && ($val->IsSuccess)) {
            return redirect('/new-car')->with('success',' Follow Up Data Successfully!');
        } elseif(property_exists($val, 'ErrorMessage')) {
            return redirect('/new-car')->with('error', $val->ErrorMessage);
        } else {
            return redirect('/new-car')->with('error',' Follow Up Data Failed!');
        }
    }

    public function download($Status=null, $StartDate=null, $EndDate=null, Request $request)
    {
        $tempStatus = $Status;
        $tempStartDate = $StartDate;
        $tempEndDate = $EndDate;
        if ($Status === "null")
            $tempStatus = "";
        if ($StartDate === "null")
            $tempStartDate = "";
        if ($EndDate === "null")
            $tempEndDate = "";
        $data_Input = json_encode(
            array(
                "Status" => $tempStatus,
                "StartDate" => $tempStartDate,
                "EndDate" => $tempEndDate,
            )
        );
        // dd($data_Input);

        //API
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/NewCarAPI/GetAllNewCarByCondition"; 
        $ch = curl_init($url);                   
        curl_setopt($ch, CURLOPT_POST, true);                                  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_Input);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val = json_decode($result);
        // dd($val);

        $data_Output=[];
        $data_Output_fileName='accone New Car Transaction '.date("Y-m-d").'.xls';
        if (property_exists($val, 'MstTransaksiList')) {
            foreach ($val->MstTransaksiList as $MstTransaksi) {

                $tmp_User_Username = "";
                $tmp_MstTransaksi_TransactionDate = "";
                $tmp_MstTransaksi_Brand = "";
                $tmp_MstTransaksi_KodeBrand = "";
                $tmp_MstTransaksi_Type = "";
                $tmp_MstTransaksi_KodeType = "";
                $tmp_MstTransaksi_Model = "";
                $tmp_MstTransaksi_KodeModel = "";
                $tmp_MstTransaksi_Tahun = "";
                $tmp_MstTransaksi_Area = "";
                $tmp_MstTransaksi_Cabang = "";
                $tmp_MstTransaksi_FlagACP = "";
                $tmp_MstTransaksi_FlagAsuransi = "";
                $tmp_MstTransaksi_Status = "";
                $tmp_MstTransaksi_Status_Detail = "";
                $tmp_MstTransaksi_Notes = "";
                $tmp_MstTransaksi_Tenors = "0";
                $tmp_MstTransaksi_DP = "0";
                $tmp_MstTransaksi_Installment = "Rp. ";
                $tmp_MstTransaksi_OTR = "Rp. ";
                $tmp_MstTransaksi_AmountDP = "Rp. ";
                $tmp_MstTransaksi_TDP = "Rp. ";

                if (property_exists($MstTransaksi, 'User')) 
                    $tmp_User_Username = $MstTransaksi->User->Username;
                if (property_exists($MstTransaksi->MstTransaksi, 'TransactionDate')) 
                    $tmp_MstTransaksi_TransactionDate = date('d-m-Y', strtotime($MstTransaksi->MstTransaksi->TransactionDate));
                if (property_exists($MstTransaksi->MstTransaksi, 'Brand')) 
                    $tmp_MstTransaksi_Brand = $MstTransaksi->MstTransaksi->Brand;
                if (property_exists($MstTransaksi->MstTransaksi, 'KodeBrand')) 
                    $tmp_MstTransaksi_KodeBrand = $MstTransaksi->MstTransaksi->KodeBrand;
                if (property_exists($MstTransaksi->MstTransaksi, 'Type')) 
                    $tmp_MstTransaksi_Type = $MstTransaksi->MstTransaksi->Type;
                if (property_exists($MstTransaksi->MstTransaksi, 'KodeType')) 
                    $tmp_MstTransaksi_KodeType = $MstTransaksi->MstTransaksi->KodeType;
                if (property_exists($MstTransaksi->MstTransaksi, 'Model')) 
                    $tmp_MstTransaksi_Model = $MstTransaksi->MstTransaksi->Model;
                if (property_exists($MstTransaksi->MstTransaksi, 'KodeModel')) 
                    $tmp_MstTransaksi_KodeModel = $MstTransaksi->MstTransaksi->KodeModel;
                if (property_exists($MstTransaksi->MstTransaksi, 'Tahun')) 
                    $tmp_MstTransaksi_Tahun = $MstTransaksi->MstTransaksi->Tahun;
                if (property_exists($MstTransaksi->MstTransaksi, 'Area')) 
                    $tmp_MstTransaksi_Area = $MstTransaksi->MstTransaksi->Area;
                if (property_exists($MstTransaksi->MstTransaksi, 'Cabang')) 
                    $tmp_MstTransaksi_Cabang = $MstTransaksi->MstTransaksi->Cabang;
                if (property_exists($MstTransaksi->MstTransaksi, 'Status')) 
                    $tmp_MstTransaksi_Status = $MstTransaksi->MstTransaksi->Status;
                if (property_exists($MstTransaksi->MstTransaksi, 'Status_Detail')) 
                    $tmp_MstTransaksi_Status_Detail = $MstTransaksi->MstTransaksi->Status_Detail;
                if (property_exists($MstTransaksi->MstTransaksi, 'Notes')) 
                    $tmp_MstTransaksi_Notes = $MstTransaksi->MstTransaksi->Notes;
                
                if (property_exists($MstTransaksi->MstTransaksi, 'Tenors'))  
                    if (!($MstTransaksi->MstTransaksi->Tenors == 0) || ($MstTransaksi->MstTransaksi->Tenors == ""))  
                        $tmp_MstTransaksi_Tenors = (double)$MstTransaksi->MstTransaksi->Tenors;
                if (property_exists($MstTransaksi->MstTransaksi, 'DP')) 
                    if (!($MstTransaksi->MstTransaksi->DP == 0) || ($MstTransaksi->MstTransaksi->DP == ""))  
                        $tmp_MstTransaksi_DP = $MstTransaksi->MstTransaksi->DP;
                
                if ((property_exists($MstTransaksi->MstTransaksi, 'Installment')) 
                    && !(($MstTransaksi->MstTransaksi->Installment == "0") || ($MstTransaksi->MstTransaksi->Installment == ""))) 
                    $tmp_MstTransaksi_Installment .= number_format($MstTransaksi->MstTransaksi->Installment);
                else   
                    $tmp_MstTransaksi_Installment .= "0";
                if ((property_exists($MstTransaksi->MstTransaksi, 'OTR')) 
                    && !(($MstTransaksi->MstTransaksi->OTR == "0") || ($MstTransaksi->MstTransaksi->OTR == "")))
                    $tmp_MstTransaksi_OTR .= number_format($MstTransaksi->MstTransaksi->OTR);
                else   
                    $tmp_MstTransaksi_OTR .= "0";
                if ((property_exists($MstTransaksi->MstTransaksi, 'AmountDP')) 
                    && !(($MstTransaksi->MstTransaksi->AmountDP == 0) || ($MstTransaksi->MstTransaksi->AmountDP == "")))
                    $tmp_MstTransaksi_AmountDP .= number_format($MstTransaksi->MstTransaksi->AmountDP);
                else   
                    $tmp_MstTransaksi_AmountDP .= "0";
                if ((property_exists($MstTransaksi->MstTransaksi, 'TDP')) 
                    && !(($MstTransaksi->MstTransaksi->TDP == "0") || ($MstTransaksi->MstTransaksi->TDP == "")))
                    $tmp_MstTransaksi_TDP .= number_format((double) $MstTransaksi->MstTransaksi->TDP);
                else   
                    $tmp_MstTransaksi_TDP .= "0";

                if ((property_exists($MstTransaksi->MstTransaksi, 'FlagACP')) && ($MstTransaksi->MstTransaksi->FlagACP))
                    $tmp_MstTransaksi_FlagACP = "Ya";
                else
                    $tmp_MstTransaksi_FlagACP = "Tidak";
                if ((property_exists($MstTransaksi->MstTransaksi, 'FlagAsuransi')) && ($MstTransaksi->MstTransaksi->FlagAsuransi))
                    $tmp_MstTransaksi_FlagAsuransi = "Tunai";
                else
                    $tmp_MstTransaksi_FlagAsuransi = "Kredit";

                
                array_push($data_Output,[
                    "Username"=>$tmp_User_Username,
                    "TransactionDate"=>$tmp_MstTransaksi_TransactionDate,
                    "Brand"=>$tmp_MstTransaksi_Brand,
                    "KodeBrand"=>$tmp_MstTransaksi_KodeBrand,
                    "Type"=>$tmp_MstTransaksi_Type,
                    "KodeType"=>$tmp_MstTransaksi_KodeType,
                    "Model"=>$tmp_MstTransaksi_Model,
                    "KodeModel"=>$tmp_MstTransaksi_KodeModel,
                    "Tahun"=>$tmp_MstTransaksi_Tahun,
                    "Tenors"=>$tmp_MstTransaksi_Tenors,
                    "Installment"=>$tmp_MstTransaksi_Installment,
                    "OTR"=>$tmp_MstTransaksi_OTR,
                    "DP"=>$tmp_MstTransaksi_DP,
                    "AmountDP"=>$tmp_MstTransaksi_AmountDP,
                    "Area"=>$tmp_MstTransaksi_Area,
                    "Cabang"=>$tmp_MstTransaksi_Cabang,
                    "TDP"=>$tmp_MstTransaksi_TDP,
                    "FlagACP"=>$tmp_MstTransaksi_FlagACP,
                    "FlagAsuransi"=>$tmp_MstTransaksi_FlagAsuransi,
                    "Status"=>$tmp_MstTransaksi_Status,
                    "Status_Detail"=>$tmp_MstTransaksi_Status_Detail,
                    "Notes"=>$tmp_MstTransaksi_Notes,
                ]);
            }
        }
        // dd($data_Output);
        return Excel::download(new NewCarExport($data_Output), $data_Output_fileName);
    }
}
