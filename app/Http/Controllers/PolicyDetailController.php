<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use App\Models\PolicyDetail;
use App\Models\Release;
use App\Models\ShipTrip;
use App\Models\Store;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PolicyDetailController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:عمليات نقل البضائع', ['only' => ['index','store', 'update', 'delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $policydetails = PolicyDetail::where('scale1_user_id', '=', null)->get();
        if (filled($policydetails)) {
            $policies = Policy::all();
            $shiptrips = ShipTrip::where('shpping_edate', '>', Carbon::today())->get();
            $releases = Release::where('release_ending', '>',  Carbon::now())->get();
            $stores = Store::all();
            $users = User::all();
            return view('operations.policydetail', compact('policydetails', 'users', 'shiptrips',
                'policies', 'stores', 'releases'));
        } else {
            echo("<h1>لا توجد سيارات في الطريق حتى الآن</h1>");
        }

    }

    public function UnloadBegin()
    {


    }

    public function UnloadStart(Request $request, $id)
    {

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\PolicyDetail $policyDetail
     * @return \Illuminate\Http\Response
     */
    public function show(PolicyDetail $policyDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\PolicyDetail $policyDetail
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        // $policydetails = PolicyDetail::findorfail($id);
        // return $policydetails;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PolicyDetail $policyDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $request->validate([
            'dloaded_weight' =>  'required|confirmed|max:6|min:5'
        ], [
            'dloaded_weight.required' => 'يرجي كتابة رقم السيارة',
            'dloaded_weight.confirmed' => 'يجب تطابق الوزن',
            'dloaded_weight.max' => 'يجب أن لا يزيد الوزن عن 6 أرقام',
            'dloaded_weight.min' => 'يجب أن لا يقل الوزن عن 5 أرقام',
        ]);
        PolicyDetail::where('id', $id)->update
        ([
            'shiptrip_id' => $request->shiptrip_id,
            'store_id' => $request->store_id,
            'release_id' => $request->release_id,
            'dloaded_weight' => $request->dloaded_weight,
            'first_scale' => now(),
            'scale_notes' => $request->scale_notes,
            'other_notes' => $request->other_notes,
            'scale1_user_id' => (Auth::user()->id)
        ]);
        session()->flash('edit', 'تم توجيه السيارة ');
        return redirect('/policydetail');
    }

    public function first_redirect()
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\PolicyDetail $policyDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(PolicyDetail $policyDetail)
    {
        //
    }
}
