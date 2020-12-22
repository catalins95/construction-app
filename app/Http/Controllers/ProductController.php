<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonImmutable;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderByDesc('id')->get();
        return view('productspage', compact('products'));
    }

    public function product_create()
    {
        $contracts = Contract::orderByDesc('id')->get();
        return view('productcreatepage', compact('contracts'));
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'product' => 'required|string|max:255',
            'with' => 'required',
            'details' => 'required',
        ]);

        //Insert into DB Products Table new query
        Product::create($data['product'], $data['details']);

        //Get last ProductID & insert into manyToMany Table @ 'contract_product'
        $last_id = Product::lastid();
        Product::CreateManyToMany($data['with'], $last_id);

        //Insert into DB Logs Table the action done
        Log::create('create', 'product', $last_id);


        return redirect('/products');
    }

    public function product_delete($id)
    {

        Product::find($id)->delete();
        Log::create('delete', 'product', $id);
        return redirect('/products');
    }

    public function product_view($id)
    {
        $product = Product::find($id);
        $rels = Product::find($id)->contracts;
        $contracts = Contract::orderByDesc('id')->get();
        return view('view_productpage', compact('product', 'rels', 'contracts'));
    }

    public function product_edit($id, Request $request)
    {

        $data = $this->validate($request, [
            'product' => 'required|string|max:255',
            'details' => 'string',
            'old_contract' => 'string',
            'with' => 'string',
        ]);

        Product::updateid($id, $data['product'], $data['old_contract'], $data['with'], $data['details']);
        Log::create('update', 'product', $id);

        return redirect('/products');
    }
}