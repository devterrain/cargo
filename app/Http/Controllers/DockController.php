<?php

namespace App\Http\Controllers;

use App\Models\Dock;
use App\Models\port;
use Illuminate\Http\Request;

class DockController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:إضافة أرصفة ارساء', ['only' => ['index','store', 'update', 'delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $docks = Dock::all();
        $ports = port::all();
        return view('edit.dock', compact('docks', 'ports'));
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
        $input = $request->all();
        $b_exists = Dock::where('dock_name', '=',$input['dock_name'])->exists();
        if($b_exists)
        {
            session()->flash('Error', 'خطأ هذا الرصيف مسجل مسبقاً');
            return redirect('/dock');
        }else{
            Dock::create([
                'dock_name' => $request->dock_name,
                'port_id' => $request->port_id,
            ]);
            session()->flash('Add', 'تم اضافة رصيف جديد');
            return redirect('/dock');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dock  $dock
     * @return \Illuminate\Http\Response
     */
    public function show(Dock $dock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dock  $dock
     * @return \Illuminate\Http\Response
     */
    public function edit(Dock $dock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dock  $dock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dock $dock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dock  $dock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dock $dock)
    {
        //
    }
}
