<?php

namespace App\Http\Controllers;

use App\Models\contractor;
use App\Models\Driver;
use App\Models\ShipingContractor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:إضافة سائقين', ['only' => ['index','store', 'update', 'delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = Driver::all();
        $users = User::all();
        $contractors = contractor::all();
        return view('edit.driver', compact('contractors', 'users', 'drivers'));
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
            'driver_name' => 'required|unique:drivers'
        ],[

            'driver_name.required' =>'يرجي كتابة اسم السائق',
            'driver_name.unique' =>'اسم السائق مسجل مسبقاً'
        ]);

            Driver::create([
                'driver_name' => $request->driver_name,
                'province' => $request->province,
                'city' => $request->city,
                'driver_address' => $request->driver_address,
                'driver_birthday' => $request->date('driver_birthday'),
                'licence_type' => $request->licence_type,
                'licence_num' => $request->licence_num,
                'identity_num' => $request->identity_num,
                'hiring_date' => $request->date('hiring_date'),
                'driver_code' => $request->driver_code,
                'contractor_id' => $request->contractor_id,
                'user_id' => (Auth::user()->id),
                'driver_notes' => $request->driver_notes

            ]);
            session()->flash('Add', 'تم اضافة سائق ');
            return redirect('/driver');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
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

        $drivers = Driver::findorFail($id);
        $drivers->update([
                'driver_name' => $request->driver_name,
                'province' => $request->province,
                'city' => $request->city,
                'driver_address' => $request->driver_address,
                'driver_birthday' => $request->date('driver_birthday'),
                'licence_type' => $request->licence_type,
                'licence_num' => $request->licence_num,
                'identity_num' => $request->identity_num,
                'hiring_date' => $request->date('hiring_date'),
                'driver_code' => $request->driver_code,
                'contractor_id' => $request->contractor_id,
                'driver_notes' => $request->driver_notes
        ]);
        session()->flash('edit','تم تعديل السائق');
        return redirect('/driver');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        Driver::find($id)->delete();
        session()->flash('delete','تم حذف السائق بنجاح');
        return redirect('/driver');
    }
}
