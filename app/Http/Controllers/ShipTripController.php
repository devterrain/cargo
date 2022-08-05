<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Dock;
use App\Models\ship;
use App\Models\ShipTrip;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShipTripController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:إضافة رحلة سفينة', ['only' => ['index','store', 'update', 'delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ships = ship::all();
        $docks = Dock::all();
        $cargos = Cargo::all();
        $users = User::all();
        $shiptrips = ShipTrip::all();
        return view('operations.shiptrip', compact('ships', 'docks', 'cargos', 'users', 'shiptrips'));
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
        ShipTrip::create([
            'arrival_date' => $request->date('arrival_date'),
            'tracky_date' => $request->date('tracky_date'),
            'shpping_bdate' => $request->date('shpping_bdate'),
            'shpping_edate' => $request->date('shpping_edate'),
            'ship_id' => $request->ship_id,
            'dock_id' => $request->dock_id,
            'cargo_id' => $request->cargo_id,
            'user_id' => (Auth::user()->id),
            'shipping_agency' => $request->shipping_agency,
            'quantitiy' => $request->quantitiy,
            'active' => 1
        ]);
        session()->flash('Add', 'تم اضافة رحلة سفينة');
        return redirect('/shiptrip');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShipTrip  $shipTrip
     * @return \Illuminate\Http\Response
     */
    public function show(ShipTrip $shipTrip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShipTrip  $shipTrip
     * @return \Illuminate\Http\Response
     */
    public function edit(ShipTrip $shipTrip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShipTrip  $shipTrip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;

        // $this->validate($request,[
        //     'manufacturer' => 'max:50',
        //     'model' => 'max:50',
        //     'contractor_id' => 'required'
        // ],[
        //     'plate_num.required' =>'يرجي كتابة رقم السيارة',
        //     'plate_num.unique' =>'اسم السيارة مسجل مسبقاً'
        // ]);

        $shiptrips = ShipTrip::find($id);
        $shiptrips->update([
            'arrival_date' => $request->date('arrival_date'),
            'tracky_date' => $request->date('tracky_date'),
            'shpping_bdate' => $request->date('shpping_bdate'),
            'shpping_edate' => $request->date('shpping_edate'),
            'ship_id' => $request->ship_id,
            'dock_id' => $request->dock_id,
            'cargo_id' => $request->cargo_id,
            'shipping_agency' => $request->shipping_agency,
            'quantitiy' => $request->quantitiy
        ]);
        session()->flash('edit','تم تعديل بيانات رحلة السفينة');
        return redirect('/shiptrip');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShipTrip  $shipTrip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        ShipTrip::find($id)->delete();
        session()->flash('delete','تم حذف رحلة السفينة');
        return redirect('/shiptrip');
    }
}
