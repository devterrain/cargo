<?php

namespace App\Http\Controllers;

use App\Models\Shipping;
use App\Models\ShipTrip;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DraftController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:إعداد الدرافت', ['only' => ['index','store', 'update', 'delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shiptrips = ShipTrip::where('shpping_edate', '>',  Carbon::today())->get();
        return view('operations.draft', compact('shiptrips'));
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
    public function update(Request $request, $ship_trip_id)
    {
//        $start_at = date($request->start_at);
//        $end_at = date($request->end_at);
//        $drafted = Shipping::whereBetween('created_at',[$start_at,$end_at])->get();
//        $count = Shipping::whereBetween('created_at',[$start_at,$end_at])->count();
//        Shipping::where('shiptrip_id', $shiptrip_id)->update([
//            'weight' => $request->weight / $count
//        ]);
        $shiptrip_id = $request->ship_trip_id;
        $count = Shipping::where('shiptrip_id', $shiptrip_id)->count();
        Shipping::where('shiptrip_id', $shiptrip_id)->update([
            'weight' => $request->weight / $count
        ]);
        session()->flash('edit', 'تم عمل الدرافت ');
        return redirect('/draft');
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
