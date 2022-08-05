<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use App\Models\PolicyDetail;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScaleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:الوزن الفارغ', ['only' => ['index','store', 'update', 'delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $policydetails = PolicyDetail::where([
            ['first_scale', '<>', null],
            ['unload_end', '<>', null],
            ['second_scale', '=', null]
        ])->get()->all();
        if (filled($policydetails)) {
            $policies = Policy::all();
            $stores = Store::all();
            $users = User::all();
            return view('operations.secondscale', compact('policydetails', 'policies', 'users', 'stores'));
        } else {
            echo("<h1>لا توجد سيارات في الطريق حتى الآن</h1>");
        }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $request->validate([
            'dempty_weight' =>  'required|confirmed|max:5|min:5'
        ], [
            'dempty_weight.required' => 'يرجي كتابة رقم السيارة',
            'dempty_weight.confirmed' => 'يجب تطابق الوزن',
            'dempty_weight.max' => 'يجب أن لا يزيد الوزن عن 5 أرقام',
            'dempty_weight.min' => 'يجب أن لا يقل الوزن عن 5 أرقام',
        ]);
        PolicyDetail::where('id', $id)->update
        ([
            'second_scale' => now(),
            'dempty_weight' => $request->dempty_weight,
            'scale_notes' => $request->scale_notes,
            'other_notes' => $request->other_notes,
            'scale2_user_id' => (Auth::user()->id)
        ]);
        session()->flash('edit', 'تم تأكيد الوزن الثاني للسيارة ');
        return redirect('/secondscale');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
