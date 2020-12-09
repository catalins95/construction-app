<?php

namespace App\Http\Controllers;

use App\Models\Contracts;
use App\Models\Suppliers;
use App\Models\Logs;
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
        $contracts = Contracts::orderBy('id', 'DESC')->get();
        return view('contractspage', compact('contracts'));
    }

    public function contract_create()
    {
         $suppliers = Suppliers::orderByDesc('id')->get();
        return view('contractcreatepage', compact('suppliers'));
    }

    public function store(Request $request)
    {
        // validate the fillable boxes
        $data = $this->validate($request, [
            'contract' => 'required|string|max:255',
            'with' => 'required|int|max:255',
            'details' => 'required',
        ]);

        //Insert into DB Contracts Table new query
        Contracts::insert([
            'name' => $data['contract'], 
            'with' => $data['with'],
            'details' => $data['details'],
            'created_at' => Carbon::now()
        ]);

        //Get the Contract ID created
        $last_id = Contracts::orderByDesc('id')->take(1)->get('id');
        $last_id = str_replace("[{\"id\":", "", $last_id);
        $last_id = str_replace("}]", "", $last_id);

        //Insert into DB Logs Table the action done
        Logs::insert([
            'action' => 'create', 
            'type' => 'contract',
            'modelid' => $last_id,
            'created_at' => Carbon::now()
        ]);


        return redirect('/contracts');
    }

    public function contract_delete($id)
    {

        Contracts::find($id)->delete();
        Logs::insert([
            'action' => 'delete', 
            'type' => 'contract',
            'modelid' => $id,
            'created_at' => Carbon::now()
        ]);
        return redirect('/contracts');
    }

    public function contract_view($id)
    {
        $contract = Contracts::find($id);
        return view('view_contractpage', compact('contract'));
    }

    public function contract_edit($id, Request $request)
    {

        $data = $this->validate($request, [
            'contract' => 'required|string|max:255',
            'details' => 'string',
        ]);

        Contracts::find($id)
              ->update([
                'name' => $data['contract'], 
                'details' => $data['details']
            ]);

        Logs::insert([
            'action' => 'update', 
            'type' => 'contract',
            'modelid' => $id,
            'created_at' => Carbon::now()
        ]);
        return redirect('/contracts');
    }
}