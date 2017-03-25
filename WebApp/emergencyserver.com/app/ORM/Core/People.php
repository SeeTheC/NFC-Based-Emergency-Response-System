<?php

namespace App\ORM\Core;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $table = 'tbl_people';
	// optional : connection -> Database name
	protected $connection = 'mysql';
	protected $fillable =['first_name','last_name','address_line_1','adress_line_2','city','state','contact_number','emergency_number'];

	protected $nullable = ['address_line_1','adress_line_2','contact_number'];	

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
