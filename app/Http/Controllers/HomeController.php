<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use App\Models\PolicyDetail;
use App\Models\Shipping;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalCounts = Policy::all()->count();
        $count = Policy::whereDate('shipping_date', Carbon::today())->count();
        $totalweight = Policy::whereDate('shipping_date', Carbon::today())->sum('loaded_weight') - Policy::whereDate('shipping_date', Carbon::today())->sum('empty_weight');
        $storage = PolicyDetail::where([['unload_start', '<>', null],['unload_end', '=', null]])->count();
        $stores = Store::all();
        $storageop = Shipping::whereDate('load_end', Carbon::today())->count();
        $storageopwights = Shipping::whereDate('load_end', Carbon::today())->sum('weight');
        $inbetweens = Shipping::where([
            ['shiptrip_id', '=', null],
        ])->count();
        $underways = Shipping::where([
            ['shiptrip_id', '<>', null],
            ['store_dist_id', '=', null],
            ['shipping_start', '<>', null],
            ['shipping_end', '=', null]
        ])->count();

        $totalshippings = Shipping::where([
            ['shiptrip_id', '<>', null],
            ['store_dist_id', '=', null],
            ['shipping_end', '<>', null]
        ])->count();
        $ontheroad = PolicyDetail::where([['first_scale', '=', null],['second_scale', '=', null]])->count();
        $storagein =  Policydetail::sum('dnet_weight');
        $policydetails = PolicyDetail::where('scale1_user_id', '=', null)->get();
        return view('home', compact('totalCounts','count', 'totalweight', 'stores','storage', 'ontheroad', 'storagein',
        'inbetweens', 'storageop', 'storageopwights', 'underways', 'totalshippings', 'policydetails'));
    }


}
