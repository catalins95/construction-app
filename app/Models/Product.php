<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'supplier',
        'old_contract',
        'details',
        'with',

    ];

    public function contracts()
    {
    	return $this->belongsToMany(Contract::class, 'contract_product');
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

    public static function updateid($id, $name, $old_contract, $with, $details)
    {
        DB::table('contract_product')
                ->where([
                    ['product_id', '=', $id],
                    ['contract_id', '=', $old_contract],
                ])->update(['contract_id' => $with]);
                
        return Product::find($id)
            ->update([
                'name' => $name, 
                'details' => $details
        ]);
    }
}
