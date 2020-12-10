<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'supplier',
        'details',
        'with',

    ];

    public function contracts()
    {
    	return $this->belongsTo(Contract::class);
    }

    public static function create($name, $details)
    {
        return Product::insert([
            'name' => $name, 
            'details' => $details,
            'created_at' => Carbon::now()
        ]);
    }

    public static function createManyToMany($cid, $pid)
    {
        return DB::table('contract_product')->insert([ 
            'contract_id' => $cid,
            'product_id' => $pid,
            'created_at' => Carbon::now()
        ]);
    }

    public static function lastid()
    {

        return Product::orderBy('id', 'desc')->first()->id;
    }

    public static function updateid($id, $name, $details)
    {
        return Product::find($id)
            ->update([
                'name' => $name, 
                'details' => $details
        ]);
    }
}
