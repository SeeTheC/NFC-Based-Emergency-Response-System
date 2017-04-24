<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller {
   

   public static function sendEmergencyMail($latt,$long,$pinfo){      
     $body=MailController::getbody($latt,$long,$pinfo);
     MailController::sendMail("rathin.d.great@gmail.com","Rathin","Emergency[ICT]", $body);
     MailController::sendMail("khursheed@cse.iitb.ac.in","ali","Emergency",$body);
     MailController::sendMail("abhishekb@cse.iitb.ac.in","bagade","Emergency", $body);
   }   

   private static function getbody($latt,$long,$pinfo){

      //$url="https://www.google.co.in/maps/@".$latt.",".$long.",18z";
      $name=$pinfo->first_name." ".$pinfo->last_name;
      $econtact=$pinfo->emergency_number;    
      $add=$pinfo->address_line_1.",". $pinfo->address_line_2;
      $add.="<br/> <b>City:</b> ".$pinfo->city;
      $add.="<br/> <b>State:</b> ".$pinfo->state;
      $add.="<br/> <b>Contact Number:</b> ".$pinfo->contact_number;


      $url="http://maps.google.com/maps?&z=18&mrt=yp&q=".$latt."+".$long;
      $body="<html><head></head><body><hr/>";
      $body.="<div> <h2> There is an <label style='color:red'> EMERGENCY </label> at below location. Please respond to site as soon as possible.</div>";
      $body.="<div> <h2> <a href='".$url."'> Accident Location</a> </h2> </div>";
      $body.="<div style='font-size:18px'>";
      $body.="<div><b>Below is the information about victim.</b></div>";
      $body.="<br/><b>Name:</b> ".$name;
      $body.="<br/><b>Emergency Contact:</b> ".$econtact; 
      $body.="<br/><b>Address:</b> ". $add;   
      $body.="</div>";
      $body.="<div><br/> <b>Note:</b> This is auto generated mail please don't reply to this mail. </div>";                        
      $body.="<br/>";                           
      $body.="<div> Thank You. </div>";      
      $body.="<div> Emergency-Help Center</div>";               
      $body.="<div> IIT-Bombay </div><br>";          
      $body.="</div><hr/>";
      $body.="</body></html>";
      return $body;
   }
   public static function sendMail($to_email,$to_name,$subject,$body){
      $mail = new \PHPMailer(true);
      try {
           $mail->isSMTP();
           $mail->CharSet = "utf-8";
           $mail->SMTPAuth = true;  
           $mail->SMTPSecure = "tls"; 
           $mail->Host = "";
           $mail->Port = 25; 
           $mail->Username = "";
           $mail->Password = "";
           $mail->setFrom("khursheed@cse.iitb.ac.in", "Emergency-Service[donot-reply]");
           $mail->Subject = $subject;
           $mail->MsgHTML($body);
           $mail->addAddress($to_email,$to_name);           
           $mail->SMTPOptions= array(
               'ssl' => array(
               'verify_peer' => false,
               'verify_peer_name' => false,
               'allow_self_signed' => true
               )
            );     
           $mail->send();      

      } catch (phpmailerException $e) {
           return '{"status":false,"error":$e}';
      } catch (Exception $e) {
           return '{"status":false,"error":$e}';
      }
      return '{"status":true,"error":""}';
   }
     
}
