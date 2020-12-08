<?php

namespace App\Http\Controllers;

use App\Models\Task;
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
        $products = DB::table('products')->get();
        return view('productspage', compact('products'));
    }

    public function product_create()
    {
        $contracts = DB::table('contracts')->orderByDesc('id')->get();
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

        DB::table('products')->insert([
            'name' => $data['product'], 
            'with' => $data['with'],
            'details' => $data['details'],
            'created_at' => Carbon::now()
        ]);

        $last_id = DB::table('products')->orderByDesc('id')->take(1)->get('id');
        $last_id = str_replace("[{\"id\":", "", $last_id);
        $last_id = str_replace("}]", "", $last_id);
        DB::table('logs')->insert([
            'action' => 'create', 
            'type' => 'product',
            'modelid' => $last_id,
            'created_at' => Carbon::now()
        ]);


        return redirect('/products');
    }

    public function product_delete($id)
    {

        DB::table('products')->where('id', '=', $id)->delete();
        DB::table('logs')->insert([
            'action' => 'delete', 
            'type' => 'product',
            'modelid' => $id,
            'created_at' => Carbon::now()
        ]);
        return redirect('/products');
    }

    public function product_view($id)
    {
        $products = DB::table('products')->where([
                        ['id', '=', $id],
                    ])->get();
        return view('view_productpage', compact('products'));
    }

    public function product_edit($id, Request $request)
    {

        $data = $this->validate($request, [
            'product' => 'required|string|max:255',
            'details' => 'string',
        ]);

        DB::table('products')
              ->where('id', $id)
              ->update([
                'name' => $data['products'], 
                'details' => $data['details']
            ]);

        DB::table('logs')->insert([
            'action' => 'update', 
            'type' => 'product',
            'modelid' => $id,
            'created_at' => Carbon::now()
        ]);
        return redirect('/products');
    }
}