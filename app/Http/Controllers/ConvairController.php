<?php

namespace App\Http\Controllers;

use App\Models\Convair;
use App\Models\ShipingContractor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConvairController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:إضافة سيور رفع', ['only' => ['index','store', 'update', 'delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipingcontractors = ShipingContractor::all();
        $users = User::all();
        $convairs = Convair::all();
        return view('edit.convair', compact('shipingcontractors', 'users', 'convairs'));
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
        Convair::create([
            'convair_num' => $request->convair_num,
            'convair_power' => $request->convair_power,
            'type' => $request->type,
            'length' => $request->length,
            'convair_notes' => $request->convair_notes,
            'shiping_contractor_id' => $request->shiping_contractor_id,
            'user_id' => (Auth::user()->id)
        ]);
        session()->flash('اضافة', 'تم اضافة سير جديد ');
        return redirect('/convair');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Convair  $convair
     * @return \Illuminate\Http\Response
     */
    public function show(Convair $convair)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Convair  $convair
     * @return \Illuminate\Http\Response
     */
    public function edit(Convair $convair)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Convair  $convair
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $convairs = Convair::findorFail($id);
        $convairs->update([
            'convair_num' => $request->convair_num,
            'type' => $request->type,
            'length' => $request->length,
            'convair_power' => $request->convair_power,
            'convair_notes' => $request->convair_notes,
            'shiping_contractor_id' => $request->shiping_contractor_id
        ]);
        session()->flash('edit','تم تعديل بيانات السير');
        return redirect('/convair');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Convair  $convair
     * @return \Illuminate\Http\Response
     */
    public function destroy(Convair $convair)
    {
        //
    }
}
