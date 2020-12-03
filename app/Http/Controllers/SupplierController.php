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

        // create a new incomplete task with the given title
        DB::insert('insert into suppliers (name) values (?)', [$data['supplier']]);
        DB::insert('insert into logs (action, type, created_at) values (?, ?, ?)', ['create', 'supplier', Carbon::now()]);
        // redirect to tasks index
        return redirect('/logs');
    }
}