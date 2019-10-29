<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvalidPermissionController extends Controller
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
      
            return view(
                'invalid_permission',[
                    'session' => $session
            ]);  
    }

}
