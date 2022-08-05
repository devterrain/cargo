<?php

namespace App\Http\Controllers;

use App\Models\contractor;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:إضافة سيارات', ['only' => ['index','store', 'update', 'delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contractors = contractor::all();
        $users = User::all();
        $vehicles = Vehicle::all();
        return view('edit.vehicle', compact('contractors', 'users', 'vehicles'));
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
            'plate_num' => 'required|unique:vehicles',
            'type' => 'required',
            'manufacturer' => 'max:50',
            'model' => 'max:50',
            'engine_num' => 'unique:vehicles',
            'chasset_num' => 'unique:vehicles',
            'contractor_id' => 'required'
        ],[

            'plate_num.required' =>'يرجي كتابة رقم السيارة',
            'plate_num.unique' =>'اسم السيارة مسجل مسبقاً'
        ]);

            Vehicle::create([
                'plate_num' => $request->plate_num,
                'type' => $request->type,
                'model' => $request->model,
                'manufacturer' => $request->manufacturer,
                'engine_num' => $request->engine_num,
                'chasset_num' => $request->chasset_num,
                'contractor_id' => $request->contractor_id,
                'entry_date' => $request->date('entry_date'),
                'user_id' => (Auth::user()->id)

            ]);
            session()->flash('Add', 'تم اضافة سيارة جديدة ');
            return redirect('/vehicle');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $vehicles = Vehicle::where('id', $id)->first();
    //     return view('vehicles.status_update', compact('vehicles'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
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

        $vehicles = Vehicle::find($id);
        $vehicles->update([
            'plate_num' => $request->plate_num,
            'type' => $request->type,
            'model' => $request->model,
            'manufacturer' => $request->manufacturer,
            'engine_num' => $request->engine_num,
            'chasset_num' => $request->chasset_num,
            'contractor_id' => $request->contractor_id,
            'entry_date' => $request->date('entry_date')
        ]);
        session()->flash('edit','تم تعديل بيانات السيارة');
        return redirect('/vehicle');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        Vehicle::find($id)->delete();
        session()->flash('delete','تم حذف السيارة بنجاح');
        return redirect('/vehicle');
    }
}
