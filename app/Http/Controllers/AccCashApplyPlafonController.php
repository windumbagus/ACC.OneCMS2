<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class AccCashApplyPlafonController extends Controller
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


        $data = json_encode(array(
            "doTransactionPlafond" => array(   
                // "Id"=> $request->Id_add,
                "TRANSACTION_CODE"=>"GET_BROADCAST",
            ),
        ));

        $url = config('global.base_url_sofia').'/restV2/acccash/getdata/transactionplafond';

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
            

        if ($Hasilsrole->OUT_DATA == 'Super Admin' || $Hasilsrole->OUT_DATA == 'Super_Admin' || $Hasilsrole->OUT_DATA == 'acccash')
        {
            return view(
                'acccash_apply_plafon',[
                   // 'Role' => $Hasils->Role,
                    'ACCCashPlafonds'=>$Hasils->OUT_DATA,
                   // 'Roles'=>$Hasils2->Roles,
                  //  'UserCategories'=>$Hasils2->UserCategory, 
                    'session' => $session

            ]);

        }
        else
        {
            return redirect('/invalid-permission');
        }

    }

    public function broadcast(Request $request)
    {

        // $data_mail = [
        //     'EMAIL' => $request->EMAIL,
        //     'DISBURSEMENT' => $request->DISBURSEMENT,
        //     'NO_AGGR'=>$request->NO_AGGR
        // ];
        // // dd($data_mail);
        // 
        
        $data = json_encode(array(
            "doTransactionPlafond" => array(   
                // "Id"=> $request->Id_add,
                "TRANSACTION_CODE"=>"GET_BROADCAST",
            ),
        ));

        $url = config('global.base_url_sofia').'/restV2/acccash/getdata/transactionplafond';

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

        foreach ($Hasils->OUT_DATA as $Hasil){ 
            // Code Here
                $data_mail = [
                        'NAME' => $Hasil->NAME,
                        'EMAIL' => $Hasil->EMAIL,
                        'PLAFOND' => $Hasil->PLAFOND
                    ];
                    // // dd($data_mail);
                \Mail::to($Hasil->EMAIL)->send(new \App\Mail\MailAccCashPlafon($data_mail));
            }
            // dd($data_mail);



        //dd($Hasils);

            return redirect("acccash-apply-plafon")->with('success','Berhasil brodcast');
       
    }

    public function broadcastapi(Request $request)
    {

        // Code Here
                $data_mail = [
                        'NAME' => $request->NAME,
                        'EMAIL' => $request->EMAIL,
                        'PLAFOND' => $request->PLAFOND
                    ];
                \Mail::to($request->EMAIL)->send(new \App\Mail\MailAccCashPlafon($data_mail));

                $message = \Response::json(array(
                    'OUT_MESS' => 'SUKSES',
                    'OUT_STAT' => 'T',
                    ));
                    return $message;
    }

    public function broadcastapi2(Request $request)
    {

        // Code Here
                $data_mail = [
                        'NAME' => $request->json()->get("NAME"),
                        'EMAIL' => $request->json()->get("EMAIL"),
                        'PLAFOND' => $request->json()->get("PLAFOND")
                    ];
                \Mail::to($request->EMAIL)->send(new \App\Mail\MailAccCashPlafon($data_mail));

                $message = \Response::json(array(
                    'OUT_MESS' => 'SUKSES',
                    'OUT_STAT' => 'T',
                    ));
                    return $message;
    }


    

}
