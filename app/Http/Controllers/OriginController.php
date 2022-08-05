<?php

namespace App\Http\Controllers;

use App\Models\Origin;
use Illuminate\Http\Request;

class OriginController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:إضافة مصانع وجهات تحميل', ['only' => ['index','store', 'update', 'delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $origins = Origin::all();
        return view('edit.origin', compact('origins'));
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
        $request->validate([
            'origin_name' => 'required|unique:origins',
        ],[

            'origin_name.required' =>'يرجي كتابة اسم جهة التحميل',
            'origin_name.unique' =>'اسم جهة التحميل مسجل مسبقاً'
        ]);

            Origin::create([
                'origin_name' => $request->origin_name,
                'origin_address' => $request->origin_address,
                'origin_phone' => $request->origin_phone,
                'origin_notes' => $request->origin_notes
            ]);
            session()->flash('Add', 'تم اضافة جهة تحميل جديدة ');
            return redirect('/origin');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Origin  $origin
     * @return \Illuminate\Http\Response
     */
    public function show(Origin $origin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Origin  $origin
     * @return \Illuminate\Http\Response
     */
    public function edit(Origin $origin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Origin  $origin
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

        $origins = Origin::find($id);
        $origins->update([
            'origin_name' => $request->origin_name,
            'origin_address' => $request->origin_address,
            'origin_phone' => $request->origin_phone,
            'origin_notes' => $request->origin_notes
        ]);
        session()->flash('edit','تم تعديل بيانات جهة التحميل');
        return redirect('/origin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Origin  $origin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Origin $origin)
    {
        //
    }
}
