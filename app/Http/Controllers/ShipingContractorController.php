<?php

namespace App\Http\Controllers;

use App\Models\ShipingContractor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShipingContractorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipingcontractors = ShipingContractor::all();
        return view('edit.shipingcontractor', compact('shipingcontractors'));
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
        $validatedData = $request->validate([
            'SCName' => 'required'
        ],[
            'SCName.required' =>'يرجي إضافة مقاول الشحن'
        ]);

            ShipingContractor::create([
                'SCName' => $request->SCName,
                'SCName_notes' => $request->SCName_notes,
                'created_by' => (Auth::user()->name)
        ]);
            session()->flash('Add', 'تم اضافة مقاول شحن جديد ');
            return redirect('/shipingcontractor');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShipingContractor  $shipingContractor
     * @return \Illuminate\Http\Response
     */
    public function show(ShipingContractor $shipingContractor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShipingContractor  $shipingContractor
     * @return \Illuminate\Http\Response
     */
    public function edit(ShipingContractor $shipingContractor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShipingContractor  $shipingContractor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShipingContractor $shipingContractor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShipingContractor  $shipingContractor
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShipingContractor $shipingContractor)
    {
        //
    }
}
