<?php

namespace App\Http\Controllers;

use App\Models\Contracts;
use App\Models\Suppliers;
use App\Models\Products;
use App\Models\logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonImmutable;

class ProductController extends Controller
{
    /**
     * Paginate the authenticated user's tasks.
     *
     * @return \Illuminate\View\View
     */

    public function index()
    {
        $products = Products::orderByDesc('id')->get();
        return view('productspage', compact('products'));
    }

    public function product_create()
    {
        $contracts = Contracts::orderByDesc('id')->get();
        return view('productcreatepage', compact('contracts'));
    }

    public function store(Request $request)
    {
        // validate the given request
        $data = $this->validate($request, [
            'product' => 'required|string|max:255',
            'with' => 'required|int|max:255',
            'details' => 'required',
        ]);

        // 

        Products::insert([
            'name' => $data['product'], 
            'with' => $data['with'],
            'details' => $data['details'],
            'created_at' => Carbon::now()
        ]);

        $last_id = Products::orderByDesc('id')->take(1)->get('id');
        $last_id = str_replace("[{\"id\":", "", $last_id);
        $last_id = str_replace("}]", "", $last_id);
        Logs::insert([
            'action' => 'create', 
            'type' => 'product',
            'modelid' => $last_id,
            'created_at' => Carbon::now()
        ]);


        return redirect('/products');
    }

    public function product_delete($id)
    {

        Products::find($id)->delete();
        Logs::insert([
            'action' => 'delete', 
            'type' => 'product',
            'modelid' => $id,
            'created_at' => Carbon::now()
        ]);
        return redirect('/products');
    }

    public function product_view($id)
    {
        $product = Products::find($id);
        return view('view_productpage', compact('product'));
    }

    public function product_edit($id, Request $request)
    {

        $data = $this->validate($request, [
            'product' => 'required|string|max:255',
            'details' => 'string',
        ]);

        Products::find($id)
              ->update([
                'name' => $data['product'], 
                'details' => $data['details']
            ]);

        Logs::insert([
            'action' => 'update', 
            'type' => 'product',
            'modelid' => $id,
            'created_at' => Carbon::now()
        ]);
        return redirect('/products');
    }
}