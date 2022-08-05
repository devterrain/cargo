<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Convair;
use App\Models\Dock;
use App\Models\Driver;
use App\Models\Loader;
use App\Models\Operator;
use App\Models\Policy;
use App\Models\PolicyDetail;
use App\Models\ship;
use App\Models\Shipping;
use App\Models\ShipTrip;
use App\Models\Store;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShippingController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:نقل من المخزن إلى الرصيف', ['only' => ['index','store', 'update', 'delete']]);
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
            ['load_end', '<>', null],
            ['shipping_start', '=', null]
        ])->orderBy('id', 'DESC')->get()->all();
        $ships = ship::all();
        $cargos = Cargo::all();
        $users = User::all();
        $stores = Store::all();
        $vehicles = Vehicle::where('type', '=', 'قلاب')->orderBy('plate_num')->get();
        $loaders = Loader::where('equipment_type', '=', 'لودر')->get()->all();
        $operators = Operator::where('classs', '=', 'قلاب')->orderBy('operator_name')->get();
        $loaderoperators = Operator::where('classs', '=', 'لودر')->orderBy('operator_name')->get()->all();
        $convairs = Convair::orderBy('convair_num')->get();
        $shiptrips = ShipTrip::where('shpping_edate', '>', Carbon::today())->get()->all();
        return view('operations.outgoing', compact('ships', 'stores', 'vehicles', 'loaders',
            'operators', 'convairs', 'cargos', 'loaderoperators', 'users', 'shiptrips', 'shippings'));
    }

    public function getShipping()
    {
        $shippings = Shipping::where([
            ['shiptrip_id', '<>', null],
            ['store_dist_id', '=', null],
            ['shipping_start', '=', null]
        ])->get()->all();
        if (filled($shippings)) {
        $docks = Dock::all();
        $users = User::all();
        $stores = Store::all();
        $vehicles = Vehicle::all();
        $operators = Operator::where('classs', '=', 'قلاب')->orderBy('operator_name')->get();
        $convairs = Convair::all();
        $shiptrips = ShipTrip::where(Carbon::today(), '>', 'shpping_edate');
        return view('operations.shipping', compact('stores', 'vehicles',
            'operators', 'convairs', 'docks', 'users', 'shiptrips', 'shippings'));
        } else {
            echo("لا توجد عمليات شحن حالياً");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'vehicle_id' => 'required',
            'store_id' => 'required',
            'cargo_id' => 'required',
            'shiptrip_id' => 'required',
            'loader_id' => 'required',
            'operator_id' => 'required'
        ], [

            'vehicle_id.required' => 'يرجي تحديد رقم القلاب',
            'store_id.required' => 'يرجي كتابة رقم المخزن',
            'cargo_id.required' => 'يرجي تحديد الحمولة',
            'shiptrip_id.required' => 'يرجي كتابة رقم رحلة السفينة',
            'loader_id.required' => 'يرجي تحديد رقم اللودر',
            'operator_id.required' => 'يرجي تحديد اسم السائق',
        ]);

        Shipping::create([
            'vehicle_id' => $request->vehicle_id,
            'start_shift' => $request->start_shift,
            'cargo_id' => $request->cargo_id,
            'store_id' => $request->store_id,
            'shiptrip_id' => $request->shiptrip_id,
            'loader_id' => $request->loader_id,
            'loader_operator_id' => $request->loader_operator_id,
            'operator_id' => $request->operator_id,
            'weight' => $request->weight,
            'load_end' => Carbon::now(),
            'load_notes' => $request->load_notes,
            'user_id' => (Auth::user()->id)

        ]);
        $request->flash();
        session()->flash('Add', 'تم خروج سيارة من المخزن في اتجاه الرصيف ');
        return redirect('/outgoing');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Shipping $shipping
     * @return \Illuminate\Http\Response
     */
    public function show(Shipping $shipping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Shipping $shipping
     * @return \Illuminate\Http\Response
     */
    public function edit(Shipping $shipping)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Shipping $shipping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        Shipping::where('id', $id)->update
        ([
            'shipping_start' => Carbon::now(),
            'convair_id' => $request->convair_id,
            'gate_num' => $request->gate_num,
            'operator2_id' => $request->operator2_id,
            'end_shift' => $request->end_shift,
            'shipping_notes' => $request->shipping_notes,
            'user2_id' => (Auth::user()->id)
        ]);
        $request->flash();
        session()->flash('edit', 'تم بدء عملية الشحن ');
        return redirect('/shipping');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Shipping $shipping
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        Shipping::find($id)->delete();
        session()->flash('delete','تم إلغاء عملية الشحن');
        return redirect('/shipping');
    }
}
