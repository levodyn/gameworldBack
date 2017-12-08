<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LingoDict extends Model
{
    //Table name
	protected $table = 'lingodicts';
	//Primary key
	public $primaryKey = 'id';
	//Timestamps
	public $timestamps = true;
}
