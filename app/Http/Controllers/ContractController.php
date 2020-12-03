<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonImmutable;

class ContractController extends Controller
{
    /**
     * Paginate the authenticated user's tasks.
     *
     * @return \Illuminate\View\View
     */

    public function index()
    {
        $contracts = DB::table('contracts')->get();
        return view('viewcontracts', compact('contracts'));
    }

    public function contract_create()
    {
         $suppliers = DB::table('suppliers')->get();
        return view('viewcontractcreate', compact('suppliers'));
    }

    public function store(Request $request)
    {
        // validate the given request
        $data = $this->validate($request, [
            'contract' => 'required|string|max:255',
            'with' => 'required|int|max:255',
        ]);

        // 

        DB::table('contracts')->insert([
            'name' => $data['contract'], 
            'with' => $data['with'],
            'created_at' => Carbon::now()
        ]);

        $last_id = DB::table('contracts')->orderByDesc('id')->take(1)->get('id');
        $last_id = str_replace("[{\"id\":", "", $last_id);
        $last_id = str_replace("}]", "", $last_id);
        DB::table('logs')->insert([
            'action' => 'create', 
            'type' => 'contract',
            'modelid' => $last_id,
            'created_at' => Carbon::now()
        ]);


        return redirect('/contracts');
    }

    public function contract_delete($id)
    {

        DB::table('contracts')->where('id', '=', $id)->delete();
        DB::table('logs')->insert([
            'action' => 'delete', 
            'type' => 'contract',
            'modelid' => $id,
            'created_at' => Carbon::now()
        ]);
        return redirect('/contracts');
    }
}