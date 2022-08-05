<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Loader;
use App\Models\Operator;
use App\Models\Shipping;
use App\Models\Store;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TerminalController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:نقل من مخزن إلى مخزن', ['only' => ['index','store', 'update', 'delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cargos = Cargo::all();
        $users = User::all();
        $stores = Store::all();
        $vehicles = Vehicle::where('type', '=', 'قلاب')->get()->all();
        $loaders = Loader::all();
        $operators = Operator::where('classs', '=', 'قلاب')->get()->all();
        $loaderoperators = Operator::where('classs', '=', 'لودر')->get()->all();
        $inbetweens = Shipping::where([
            ['shiptrip_id', '=', null],
            ['load_end', '<>', null],
            ['shipping_end', '<>', null],
        ])->get()->all();
        return view('operations.terminal', compact('stores', 'cargos', 'vehicles', 'loaders',
            'operators', 'users', 'loaderoperators', 'inbetweens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = $request->id;
        Shipping::where('id', $id)->update
        ([
            'shipping_end' => Carbon::now(),
            'shipping_notes' => $request->shipping_notes,
            'operator2_id' => $request->operator2_id
        ]);
        session()->flash('edit', 'تم إنهاء عملية الشحن ');
        return redirect('/terminal');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
