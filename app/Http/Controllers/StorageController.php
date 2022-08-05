<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use App\Models\PolicyDetail;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StorageController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:انتظار التخزين', ['only' => ['index','store', 'update', 'delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $policydetails = PolicyDetail::where([
            ['unload_start', '=', null],
            ['shiptrip_id', '=', null],
            ['store_id', '<>', null],
        ])->get()->all();
        if (filled($policydetails)) {
            $policies = Policy::all();
            $stores = Store::all();
            $users = User::all();
            return view('operations.storage', compact('policydetails', 'policies', 'users', 'stores'));
        } else {
            echo("لا توجد سيارات في الطريق حتى الآن");
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
        PolicyDetail::where('id', $id)->update
        ([
            'unload_start' => now(),
            'unload_notes' => $request->unload_notes,
            'shipping1_user_id' => (Auth::user()->id)
        ]);
        session()->flash('edit', 'تم بدء العملية ');
        return redirect('/storage');
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
