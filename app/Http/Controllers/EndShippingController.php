<?php

namespace App\Http\Controllers;

use App\Models\Convair;
use App\Models\Driver;
use App\Models\Loader;
use App\Models\Operator;
use App\Models\Shipping;
use App\Models\ShipTrip;
use App\Models\Store;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EndShippingController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:عمليات الشحن قيد التنفيذ', ['only' => ['index','store', 'update', 'delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shippings = Shipping::where([
            ['shiptrip_id', '<>', null],
            ['store_dist_id', '=', null],
            ['shipping_start', '<>', null],
            ['shipping_end', '=', null]
        ])->get()->all();
        if (filled($shippings)) {
            $users = User::all();
            $stores = Store::all();
            $vehicles = Vehicle::all();
            $loaders = Loader::all();
            $operators = Operator::where('classs', '=', 'قلاب')->get()->all();
            $convairs = Convair::all();
            $shiptrips = ShipTrip::all();
            return view('operations.underway', compact('stores', 'vehicles', 'loaders',
                'operators', 'convairs', 'users', 'shiptrips', 'shippings'));
        } else {
            echo("لا توجد عمليات شحن قيد التنفيذ حاليا");
        }
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        Shipping::where('id', $id)->update
        ([
            'shipping_end' => Carbon::now(),
            'shipping_notes' => $request->shipping_notes,
        ]);
        session()->flash('edit', 'تم إنهاء عملية الشحن ');
        return redirect('/underway');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
