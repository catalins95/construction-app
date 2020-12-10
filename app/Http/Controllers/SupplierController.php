<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonImmutable;

class SupplierController extends Controller
{

    public function index()
    {
        $suppliers = Supplier::orderByDesc('id')->get();
        return view('supplierspage', compact('suppliers'));
    }

    public function supplier_create()
    {
        return view('suppliercreatepage');
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'supplier' => 'required|string|max:255',
            'details' => 'string',
        ]);

        //Insert into DB Products Table new query
        Supplier::create($data['supplier'], $data['details']);

        //Get last ProductID & insert into manyToMany Table @ 'contract_product'
        $last_id = Supplier::lastid();
        //Supplier::CreateManyToMany($data['with'], $last_id);

        //Insert into DB Logs Table the action done
        Log::create('create', 'supplier', $last_id);


        return redirect('/suppliers');
    }

    public function supplier_delete($id)
    {

        Supplier::find($id)->delete();
        Log::create('delete', 'supplier', $id);

        return redirect('/suppliers');
    }

    public function supplier_view($id)
    {
        $supplier = Supplier::find($id);
        $rels = Supplier::find($id)->contracts;
        return view('view_supplierpage', compact('supplier'), compact('rels'));
    }

    public function supplier_edit($id, Request $request)
    {

        $data = $this->validate($request, [
            'supplier' => 'required|string|max:255',
            'details' => 'string',
        ]);

        Supplier::updateid($id, $data['supplier'], $data['details']);
        Log::create('update', 'supplier', $id);

        return redirect('/suppliers');
    }
}