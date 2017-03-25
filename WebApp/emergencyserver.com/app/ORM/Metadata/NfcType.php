<?php

namespace App\ORM\Metadata;

use Illuminate\Database\Eloquent\Model;

class NfcType extends Model
{
    protected $table = 'tbl_nfc_type';
	// optional : used for multiple DB
	protected $connection = 'mysql';
}
