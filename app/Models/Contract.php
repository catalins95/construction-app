<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'supplier',
        'details',
        'with',

    ];

    public function suppliers()
    {
    	return $this->belongsToMany(Supplier::class, 'supplier_contract');
    }

    public function products()
    {
    	return $this->belongsToMany(Product::class, 'contract_product'); 
    }

    public static function create($name, $details)
    {
        return Contract::insert([
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
        // -> OLD METHOD
        //$last_id = Contract::orderByDesc('id')->take(1)->get('id');
        //$last_id = str_replace("[{\"id\":", "", $last_id);
        //$last_id = str_replace("}]", "", $last_id);

        return Contract::orderBy('id', 'desc')->first()->id;
    }

    public static function updateid($id, $name, $details)
    {
        return Contract::find($id)
            ->update([
                'name' => $name, 
                'details' => $details
        ]);
    }
}
