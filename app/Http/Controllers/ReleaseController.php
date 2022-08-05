<?php

namespace App\Http\Controllers;

use App\Models\Release;
use App\Models\ShipTrip;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReleaseController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:إضافة رقم افراج', ['only' => ['index','store', 'update', 'delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $shiptrips = ShipTrip::where('shpping_edate', '>', Carbon::today())->get();
        $releases = Release::all();
        return view('operations.release', compact('users', 'shiptrips', 'releases'));
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
        // $request->validate([
        //     'release_num' => 'required|unique:origins',
        // ],[

        //     'release_num.required' =>'يرجي كتابة رقم الافراج',
        //     'release_num.unique' =>'رقم الافراج مسجل مسبقاً'
        // ]);
        Release::create([
            'release_num' => $request->release_num,
            'ship_trip_id' => $request->ship_trip_id,
            'release_opening' => $request->release_opening,
            'release_ending' => $request->release_ending,
            'release_quantitiy' => $request->release_quantitiy,
            'user_id' => (Auth::user()->id)
        ]);
        session()->flash('Add', 'تم اضافة رقم افراج');
        return redirect('/release');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Release  $release
     * @return \Illuminate\Http\Response
     */
    public function show(Release $release)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Release  $release
     * @return \Illuminate\Http\Response
     */
    public function edit(Release $release)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Release  $release
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $releases = Release::find($id);
        $releases->update([
            'release_num' => $request->release_num,
            'ship_trip_id' => $request->ship_trip_id,
            'release_opening' => $request->release_opening,
            'release_ending' => $request->release_ending,
            'release_quantitiy' => $request->release_quantitiy,
        ]);
        session()->flash('edit','تم تعديل بيانات رقم الافراج');
        return redirect('/release');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Release  $release
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        Release::find($id)->delete();
        session()->flash('delete','تم حذف رقم الافراج');
        return redirect('/release');
    }
}
