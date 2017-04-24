<?php

namespace App\Http\Controllers\ControlPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ORM\Core\EmergencyCall;
use App\ORM\Core\People;
use App\ORM\Metadata\VehicalType;
use App\Http\Controllers\ControlPanel\Crypt;
use App\Http\Controllers\MailController;
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
       
        $info=EmergencyCall::orderBy('report_datetime', 'DESC')->get(); 
	//dd($info[0]);       
        return view("im.controlpanel.ViewEmergency",compact('info'));
    }

    //post
    public function emergencyCallPost(Request $request)
    {
      $form=$request->all();  
      $latt=$form["lattitude"];
      $long=$form["longitude"];
      $euid=$form["uid"];      
      $encryption = new Crypt();
      $duid=$encryption->decrypt($euid);
      list($uid, $type) = preg_split("/@/", $duid, 2);      
      $pinfo=People::where('id',$uid)->get();       
      $form["user_id"]=$uid;
      $form["reported_by"]=1;
      $form["nfc_type_id"]=5;
      $result=EmergencyCall::saveForm($form);
      MailController::sendEmergencyMail($latt,$long,$pinfo[0]);
      return $result;
    } 
    // get 
    public function map($id){
      $crypt = new Crypt();
      $d_id=$crypt->decrypt($id);
      $info= EmergencyCall::where("id",$d_id)->get();      
      return view("im.controlpanel.gmap",compact('info'));      
    }
    
    // get 
    public function analyse(){          
      return view("im.controlpanel.Analysis");      
    }
   
     // get 
    public function testMail(){  
      $encryption = new Crypt();
      $duid=$encryption->decrypt('kNYavlc4Vp+AZvVa66wtcA==');
      list($uid, $type) = preg_split("/@/", $duid, 2);
      //echo $uid;
      $pinfo=People::where('id',2)->get();    
      MailController::sendEmergencyMail(19.12345,72.533433,$pinfo[0]);  
      return "Mail sent successfully";   
    }
    private function getVehicleMap(){
      $vt=VehicalType::all();
      $arr=[];
      $len=count($vt);
      for($i=0;$i<$len;$i++){
        $arr[$vt[$i]->id]=$vt[$i]->type;
      }
      return $arr;
    }    

    private function getMonthMap(){
      $arr=["1"=>"Jan","2"=>"Feb","3"=>"Mar","4"=>"Apr","5"=>"May","6"=>"Jun","7"=>"Jul","8"=>"Aug","9"=>"Sep","10"=>"Oct","11"=>"Nov","12"=>"Dec"];
    }
    // get 
    public function getAccidentStatus($year=2017){
      $info= EmergencyCall::selectRaw('nfc_type_id,count(id) AS cnt')
             ->orderBy('cnt', 'asc')
             ->groupBy('nfc_type_id')
             ->get(); 

      $vt=$this->getVehicleMap();          
      $json=[];       
      $len=count($info);
      $total_case=0;
      for($i=0;$i<$len;$i++){
        $total_case+=$info[$i]->cnt;      
      }      
      for($i=0;$i<$len;$i++){
        if($info[$i]->nfc_type_id==5){//cycle
          $json[$i]=["name"=>$vt[$info[$i]->nfc_type_id],"count"=>$info[$i]->cnt,"y"=>(($info[$i]->cnt*100)/$total_case),"sliced"=>true,"selected"=>true];
        }
        else{
          $json[$i]=["name"=>$vt[$info[$i]->nfc_type_id],"count"=>$info[$i]->cnt,"y"=>(($info[$i]->cnt*100)/$total_case)];
          
        }
      }
      #dd($this->getVehicleMap());   
      $encoded_json=json_encode($json);      
      return $encoded_json;
    }

    //get
    public function getAccidentMonthly($year=2016){
        

      $info= EmergencyCall::selectRaw('nfc_type_id,  MONTH(report_datetime) mon, count(id) AS cnt')
             ->where(\DB::raw('YEAR(report_datetime)'),$year)
             ->orderBy('nfc_type_id', 'asc')
             ->groupBy('nfc_type_id',\DB::raw('MONTH(report_datetime)'))
             ->get(); 
      
      $month=$this->getMonthMap();
      $vt=$this->getVehicleMap();          
      $json=[];       
      $len=count($info);
      $t=0;
      $item_list=[];
      for($i=1;$i<count($vt);$i++){          
          $m_data=[0,0,0,0,0,0,0,0,0,0,0,0];          
          for($j=0;$j<$len;$j++){
            if($info[$j]->nfc_type_id==$i){
               $m_data[$info[$j]->mon-1]=$info[$j]->cnt; 
            }
          }
          array_push($json,["name"=>$vt[$i],"data"=>$m_data]);                            
      }
      
      $encoded_json=json_encode($json);      
      return $encoded_json;
    }
}
