<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'supplier',
        'details',

    ];

    public function contract()
    {
    	return $this->hasMany(Contract::class);
    }
}
