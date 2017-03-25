<?php

namespace App\Http\Controllers\ControlPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ORM\Metadata\TypeOfMachine;
use App\ORM\Metadata\Section;
use App\ORM\Core\EmergencyCall;
#use App\Http\Controllers\Core\ControlPanel\Crypt;

class ControlPanelController extends Controller
{
  
    //get
    public function computerMgm()
    {
     
        return view("im.computer.ComputerMgm");
    }

    //get
    public function viewEmergency()
    {     
        $encryption = new Crypt();
        $encryption->decrypt('kNYavlc4Vp+AZvVa66wtcA==');

        $info=EmergencyCall::all();
        return view("im.controlpanel.ViewEmergency",compact('info'));
    }

    //post
    public function emergencyCallPost(Request $request)
    {
      $form=$request->all();  
      $result=EmergencyCall::saveForm($form);
      return $result;
    } 
   
   
}
