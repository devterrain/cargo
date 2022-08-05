<?php

namespace App\Http\Controllers;

use App\Models\ship;
use Illuminate\Http\Request;

class ShipController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:إضافة سفينة', ['only' => ['index','store', 'update', 'delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ships = ship::all();
        return view('edit.ship', compact('ships'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ship_name' => 'required|unique:ships'
        ],[
            'ship_name.required' => 'يرجى كتابة اسم السفينة',
            'ship_name.unique' => 'يرجى كتابة اسم السفينة'
        ]
        );
        ship::create([
            'ship_name' => $request->ship_name,
            'country' => $request->country,
            'gate_number' => $request->gate_number,
            'ship_dimensions' => $request->ship_dimensions,
            'ship_capacity' => $request->ship_capacity
        ]);
        session()->flash('Add', 'تم اضافة سفينة جديدة ');
        return redirect('/ship');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function show(ship $ship)
    {
        // return view('edit.ship', compact('ships'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function edit(ship $ship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [
            'ship_name' => 'required',
            'country' => 'required',
            'gate_number' => 'required',
            'ship_dimensions' => 'required',
            'ship_capacity' => 'required',
        ],[
            'ship_name.required' => 'يرجى كتابة اسم السفينة'
        ]);

        $ships = ship::find($id);
        $ships->update([
            'ship_name' => $request->ship_name,
            'country' => $request->country,
            'gate_number' => $request->gate_number,
            'ship_dimensions' => $request->ship_dimensions,
            'ship_capacity' => $request->ship_capacity,
        ]);

        session()->flash('edit','تم تعديل بيانات السفينة');
        return redirect('/ship');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function destroy(ship $ship)
    {
        //
    }
}
