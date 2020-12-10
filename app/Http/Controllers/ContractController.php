<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Supplier;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonImmutable;

class ContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::orderBy('id', 'DESC')->get();

        return view('contractspage', compact('contracts'));
    }

    public function contract_create()
    {
        $suppliers = Supplier::orderByDesc('id')->get();
        return view('contractcreatepage', compact('suppliers'));
    }

    public function store(Request $request)
    {
        // validate the fillable boxes
        $data = $this->validate($request, [
            'contract' => 'required|string|max:255',
            'with' => 'required',
            'details' => 'required',
        ]);

        //Insert into DB Contracts Table new query
        Contract::create($data['contract'], $data['details']);

        //Get last ContractID & insert into manyToMany Table @ 'supplier_contract'
        $last_id = Contract::lastid();
        Contract::CreateManyToMany($last_id ,$data['with']);

        //Insert into DB Logs Table the action done
        Log::create('create', 'contract', $last_id);

        return redirect('/contracts');
    }

    public function contract_delete($id)
    {
        Contract::find($id)->delete();
        Log::create('delete', 'contract', $id);

        return redirect('/contracts');
    }

    public function contract_view($id)
    {
        $contract = Contract::find($id);
        return view('view_contractpage', compact('contract'));
    }

    public function contract_edit($id, Request $request)
    {
        $data = $this->validate($request, [
            'contract' => 'required|string|max:255',
            'details' => 'string',
        ]);

        Contract::updateid($id, $data['contract'], $data['details']);
        Log::create('update', 'contract', $id);

        return redirect('/contracts');
    }
}