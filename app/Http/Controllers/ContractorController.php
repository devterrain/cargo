<?php

namespace App\Http\Controllers;

use App\Models\contractor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContractorController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:إضافة مقاول نقل', ['only' => ['index','store', 'update', 'delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contractors = contractor::all();
        return view('edit.contractor', compact('contractors'));
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
            'contractor_name' => 'required',
        ],[

            'section_name.required' =>'يرجي ادخال اسم القسم'
        ]);

            contractor::create([
                'contractor_name' => $request->contractor_name,
                'contractor_notes' => $request->contractor_notes,
                'created_by' => (Auth::user()->name),

            ]);
            session()->flash('Add', 'تم اضافة مقاول النقل بنجاح ');
            return redirect('/contractor');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\contractor  $contractor
     * @return \Illuminate\Http\Response
     */
    public function show(contractor $contractor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\contractor  $contractor
     * @return \Illuminate\Http\Response
     */
    public function edit(contractor $contractor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\contractor  $contractor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, contractor $contractor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\contractor  $contractor
     * @return \Illuminate\Http\Response
     */
    public function destroy(contractor $contractor)
    {
        //
    }
}
