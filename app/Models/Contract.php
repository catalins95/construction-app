<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'supplier',
        'details',
        'with',

    ];

    public function supplier()
    {
    	return $this->belongsTo(Supplier::class);
    }

    public function product()
    {
    	return $this->hasMany(Product::class); 
    }
}
