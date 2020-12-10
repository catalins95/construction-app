<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Carbon\CarbonImmutable;

class Log extends Model
{
    use HasFactory;

    public static function create($action, $type, $id)
    {
        return Log::insert([
            'action' => $action, 
            'type' => $type,
            'modelid' => $id,
            'created_at' => Carbon::now()
        ]);
    }
}
