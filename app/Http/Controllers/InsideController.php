<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Driver;
use App\Models\Loader;
use App\Models\Operator;
use App\Models\ship;
use App\Models\Shipping;
use App\Models\Store;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InsideController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:نقل من مخزن إلى مخزن', ['only' => ['index','store', 'update', 'delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cargos = Cargo::all();
        $users = User::all();
        $stores = Store::all();
        $vehicles = Vehicle::where('type', '=', 'قلاب')->get()->all();
        $loaders = Loader::all();
        $operators = Operator::where('classs', '=', 'قلاب')->get()->all();
        $loaderoperators = Operator::where('classs', '=', 'لودر')->get()->all();
        $inbetweens = Shipping::where([
            ['shiptrip_id', '=', null],
        ])->get()->all();
        return view('operations.inbetween', compact('stores', 'cargos', 'vehicles', 'loaders',
        'operators', 'users', 'loaderoperators', 'inbetweens'));
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
            'vehicle_id' => 'required',
            'store_id' => 'required',
            'cargo_id' => 'required',
            'store_dist_id' => 'required',
            'loader_id' => 'required',
            'loader_operator_id' => 'required',
            'operator_id' => 'required'
        ],[

            'vehicle_id.required' =>'يرجي كتابة رقم السيارة',
            'store_id.required' =>'يرجي كتابة رقم المخزن',
            'loader_operator_id.required' => 'يرجى تحديد اسم مشغل اللودر',
            'store_dist_id.required' =>'يرجي تحديد رقم المخزن المنقول إليه',
            'cargo_id.required' =>'يرجي تحديد نوع الحمولة',
            'loader_id.required' =>'يرجي تحديد رقم اللودر',
            'operator_id.required' =>'يرجي تحديد اسم السائق',
        ]);

        Shipping::create([
            'vehicle_id' => $request->vehicle_id,
            'store_id' => $request->store_id,
            'store_dist_id' => $request->store_dist_id,
            'loader_id' => $request->loader_id,
            'cargo_id' => $request->cargo_id,
            'loader_operator_id' => $request->loader_operator_id,
            'operator_id' => $request->operator_id,
            'weight' => $request->weight,
            'load_end' => Carbon::now(),
            'load_notes' =>$request->load_notes,
            'user_id' => (Auth::user()->id)

        ]);
        $request->flash();
        session()->flash('Add', 'تم خروج سيارة من المخزن في اتجاه مخزن آخر ');
        return redirect('/inbetween');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stores = Store::where('id', $id)->first();
        return view('operations.inbetween', compact('stores'));
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
    public function update(Request $request, $id)
    {

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
