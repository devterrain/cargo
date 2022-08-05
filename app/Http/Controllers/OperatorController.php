<?php

namespace App\Http\Controllers;

use App\Models\Operator;
use App\Models\ShipingContractor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OperatorController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:إضافة مشغلين معدات', ['only' => ['index','store', 'update', 'delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operators = Operator::all();
        $users = User::all();
        $shipingcontractors = ShipingContractor::all();
        return view('edit.operator', compact('shipingcontractors', 'users', 'operators'));
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
            'operator_name' => 'required',
            'classs' => 'required',
            'operator_code' => 'required',
            'shipping_contractor_id' => 'required',
        ],[
            'operator_name.required' =>'يرجي كتابة اسم مشغل المعدة',
            'operator_name.unique' =>'اسم السائق مسجل مسبقاً',
            'class' => 'يرجى تحديد تصنيف مشغل المعدة',
            'operator_code' => 'يرجى كتابة كود مشغل المعدة',
            'shipping_contractor_id' => 'يرجى تحديد مقاول الشحن والتفريغ'
        ]);

        Operator::create([
            'operator_name' => $request->operator_name,
            'classs' => $request->classs,
            'operator_code' => $request->operator_code,
            'shipping_contractor_id' => $request->shipping_contractor_id,
            'user_id' => (Auth::user()->id),
            'operator_notes' => $request->operator_notes
        ]);
        session()->flash('Add', 'تم اضافة مشغل معدة ');
        return redirect('/operator');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Operator  $operator
     * @return \Illuminate\Http\Response
     */
    public function show(Operator $operator)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Operator  $operator
     * @return \Illuminate\Http\Response
     */
    public function edit(Operator $operator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Operator  $operator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Operator $operator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Operator  $operator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Operator $operator)
    {
        //
    }
}
