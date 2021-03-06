<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class LogController extends Controller
{
    /**
     * Paginate the authenticated user's tasks.
     *
     * @return \Illuminate\View\View
     */

    public function index()
    {
        //$logs = DB::table('logs')->orderByDesc('id')->get();
        $logs = Log::orderBy('id', 'DESC')->get();
        return view('logspage', compact('logs'));
    }
}