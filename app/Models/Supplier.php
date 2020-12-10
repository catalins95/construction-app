<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\DB;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'supplier',
        'details',

    ];

    public function contracts()
    {
    	return $this->belongsToMany(Contract::class, 'supplier_contract');
    }

    public static function create($name, $details)
    {
        return Supplier::insert([
            'name' => $name, 
            'details' => $details,
            'created_at' => Carbon::now()
        ]);
    }

    public static function createManyToMany($cid, $sid)
    {
        return DB::table('supplier_contract')->insert([
            'supplier_id' => $sid, 
            'contract_id' => $cid,
            'created_at' => Carbon::now()
        ]);
    }

    public static function lastid()
    {

        return Supplier::orderBy('id', 'desc')->first()->id;
    }

    public static function updateid($id, $name, $details)
    {
        return Supplier::find($id)
            ->update([
                'name' => $name, 
                'details' => $details
        ]);
    }
}
