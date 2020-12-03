<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonImmutable;

class SupplierController extends Controller
{
    /**
     * Paginate the authenticated user's tasks.
     *
     * @return \Illuminate\View\View
     */

    public function index()
    {
        $suppliers = DB::table('suppliers')->get();
        return view('viewsuppliers', compact('suppliers'));
    }

    public function supplier_create()
    {
        return view('viewsuppliercreate');
    }

    public function store(Request $request)
    {
        // validate the given request
        $data = $this->validate($request, [
            'supplier' => 'required|string|max:255',
        ]);

        // 
        DB::table('suppliers')->insert([
            'name' => $data['supplier'], 
            'created_at' => Carbon::now()
        ]);


        $last_id = DB::table('suppliers')->orderByDesc('id')->take(1)->get('id');
        $last_id = str_replace("[{\"id\":", "", $last_id);
        $last_id = str_replace("}]", "", $last_id);
        DB::table('logs')->insert([
            'action' => 'create', 
            'type' => 'supplier',
            'modelid' => $last_id,
            'created_at' => Carbon::now()
        ]);


        return redirect('/suppliers');
    }

    public function supplier_delete($id)
    {

        DB::table('suppliers')->where('id', '=', $id)->delete();
        DB::table('logs')->insert([
            'action' => 'delete', 
            'type' => 'supplier',
            'modelid' => $id,
            'created_at' => Carbon::now()
        ]);

        return redirect('/suppliers');
    }
}