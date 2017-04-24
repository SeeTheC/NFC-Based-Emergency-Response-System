<?php

namespace App\ORM\Core;

use Illuminate\Database\Eloquent\Model;

class EmergencyCall extends Model
{
    protected $table = 'tbl_emergency_call';
	// optional : connection -> Database name
	protected $connection = 'mysql';
	protected $fillable =['user_id','nfc_type','nfc_type_id','lattitude','longitude',
	'reported_by','duplicate_id','status'	];

	protected $nullable = ['nfc_type_id','lattitude','longitude','status'];	

	/*
		Sets the field value to null other wise it eloquent will give error.
		By: Khursheed Ali
		On: 25/3/2017 14:55
	*/
	protected static function setNullables($model)
	{
	    foreach($model->nullable as $field)
	    {
	      if(empty($model->{$field}))
	      {
	        $model->{$field} = null;
	      }
	    }
	}


	/*
		Fetchs the People Information
		By: Khursheed Ali
		On: 25/3/2017 15:55
	*/
	public function people()
	{
		
		return $this->belongsTo("App\ORM\Core\People","user_id");
	}


	/*
		Fetchs the People Information
		By: Khursheed Ali
		On: 25/3/2017 15:55
	*/
	public function reportedBy()
	{
		return $this->belongsTo("App\ORM\Core\People","reported_by");
	}

	/*
		Fetchs the NFC Information
		By: Khursheed Ali
		On: 25/3/2017 15:55
	*/
	public function nfcType()
	{
		return $this->belongsTo("App\ORM\Metadata\NfcType","nfc_type");
	}

	/*
		Fetchs the Vehical Information
		By: Khursheed Ali
		On: 25/3/2017 14:55
	*/
	public function vehicalType()
	{		
		return $this->belongsTo("App\ORM\Metadata\VehicalType","nfc_type_id");
	}

	/*
		Save the form value. 		
		By: Khursheed Ali
		On: 25/3/2017 14:55
	*/
	public static function saveForm($form)
	{
		$result=["success"=>true,'errorMsg'=>'','rtnId'=>0];
		$row= new EmergencyCall($form);      	    	   
	    	EmergencyCall::setNullables($row);	    	
    		$row->save();      	    	
		$result["rtnId"]=$row->id;
		return $result;	 
	} 	

}
