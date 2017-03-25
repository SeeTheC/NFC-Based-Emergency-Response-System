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


}
