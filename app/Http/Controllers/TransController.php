<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use App\Models\PolicyDetail;
use App\Models\Release;
use App\Models\Shipping;
use App\Models\ShipTrip;
use App\Models\Store;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:عرض تقارير', ['only' => ['index','store', 'update', 'delete']]);
    }
    public function index(){
        return view('reports.transported');

    }
    public function view_storage()
    {
        return view('reports.storagereport');
    }
    public function view_shipping()
    {

        return view('reports.shippingreport');
    }
    public  function Search_policies(Request $request)
    {
        $start_at = date($request->start_at);
        $end_at = date($request->end_at);
        $count = Policy::whereBetween('shipping_date',[$start_at,$end_at])->where([
            ['deleted_at', '=', null]
        ])->count();
        $net_weight = Policy::whereBetween('shipping_date',[$start_at,$end_at])->sum('net_weight');
        $policies = Policy::whereBetween('shipping_date',[$start_at,$end_at])->get();
        $policydetails = PolicyDetail::all();
        return view('reports.transported',compact('policies', 'policydetails', 'count',
            'net_weight', 'start_at','end_at'));
    }

    public  function Search_storage(Request $request)
    {
        $start_at = date($request->start_at);
        $end_at = date($request->end_at);
        $policies = Policy::whereBetween('shipping_date',[$start_at,$end_at])->orderBy('id', 'DESC')->get();
        $policydetails = PolicyDetail::where([
            ['first_scale', '<>', 'null'],
            ['second_scale', '<>', 'null'],
        ])->get();
        return view('reports.storagereport',compact('policies', 'policydetails', 'start_at','end_at'));
    }
    public  function Search_shipping(Request $request)
    {
        $start_at = date($request->start_at);
        $end_at = date($request->end_at);
        $shippings = Shipping::whereBetween('created_at',[$start_at,$end_at])->where([
            ['shiptrip_id', '<>', null],
            ['store_dist_id', '=', null],
            ['shipping_start', '<>', null],
            ['shipping_end', '<>', null],
        ])->get();
        return view('reports.shippingreport',compact('shippings', 'start_at','end_at'));
    }
}
