<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $table = 'products';
    public $fillable = ['client_id','product','total','date'];
    public $timestamps = false;

   	public function client()
	{
	    return $this->belongsTo(Client::class,'client_id');
	}
}
