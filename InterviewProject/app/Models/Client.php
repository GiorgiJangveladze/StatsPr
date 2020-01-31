<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $table = 'clients';
    public $fillable = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
