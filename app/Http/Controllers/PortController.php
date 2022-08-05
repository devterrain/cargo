<?php

namespace App\Http\Controllers;

use App\Models\port;
use Illuminate\Http\Request;

class PortController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:إضافة موانئ شحن', ['only' => ['index','store', 'update', 'delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ports = port::all();
        return view('edit.port', compact('ports'));
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
        $b_exists = port::where('portname', '=',$input['portname'])->exists();
        if($b_exists)
        {
            session()->flash('Error', 'خطأ هذا الميناء مسجل مسبقاً');
            return redirect('/port');
        }else{
            port::create([
                'portname' => $request->portname
            ]);
            session()->flash('Add', 'تم اضافة ميناء جديد');
            return redirect('/port');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\port  $port
     * @return \Illuminate\Http\Response
     */
    public function show(port $port)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\port  $port
     * @return \Illuminate\Http\Response
     */
    public function edit(port $port)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\port  $port
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, port $port)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\port  $port
     * @return \Illuminate\Http\Response
     */
    public function destroy(port $port)
    {
        //
    }
}
