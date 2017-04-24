<?php

namespace App\ORM\Metadata;

use Illuminate\Database\Eloquent\Model;

class VehicalType extends Model
{
    protected $table = 'tbl_vehical_type';
	// optional : used for multiple DB
	protected $connection = 'mysql';
}
