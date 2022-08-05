<?php

namespace App\Http\Controllers;

use App\Models\Loader;
use App\Models\ShipingContractor;
use Illuminate\Http\Request;

class LoaderController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:إضافة معدات تحميل', ['only' => ['index','store', 'update', 'delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipingcontractors = ShipingContractor::all();
        $loaders = Loader::all();
        return view('edit.loader', compact('shipingcontractors', 'loaders'));
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
        Loader::create([
            'loader_num' => $request->loader_num,
            'type' => $request->type,
            'model' => $request->model,
            'equipment_type' => $request->equipment_type,
            'loader_notes' => $request->loader_notes,
            'shiping_contractor_id' => $request->shiping_contractor_id,
        ]);
        session()->flash('اضافة', 'تم اضافة لودر جديد');
        return redirect('/loader');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loader  $loader
     * @return \Illuminate\Http\Response
     */
    public function show(Loader $loader)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loader  $loader
     * @return \Illuminate\Http\Response
     */
    public function edit(Loader $loader)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loader  $loader
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loader $loader)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loader  $loader
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loader $loader)
    {
        //
    }
}
