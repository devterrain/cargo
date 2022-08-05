<?php

namespace App\Http\Controllers;

use Alkoumi\LaravelArabicNumbers\Numbers;
use App\Models\Cargo;
use App\Models\contractor;
use App\Models\Destination;
use App\Models\Driver;
use App\Models\Origin;
use App\Models\Policy;
use App\Models\PolicyDetail;
use App\Models\Trailer;
use App\Models\User;
use App\Models\Vehicle;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PolicyController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:تحرير بوليصة شحن', ['only' => ['index','store', 'update', 'delete']]);
        // $this->middleware('permission:تعديل بوليصة شحن', ['only' => ['index','store', 'update', 'delete']]);
        // $this->middleware('permission:حذف بوليصة شحن', ['only' => ['index','store', 'update', 'delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contractors = contractor::all();
        $users = User::all();
        $vehicles = Vehicle::orderBy('plate_num')->get();
        $origins = Origin::all();
        $trailers = Trailer::orderBy('tplate_num')->get();
        $drivers = Driver::orderBy('driver_name')->get();
        $policies = Policy::orderBy('id', 'DESC')->get();
        $cargos = Cargo::all();
        $destinations = Destination::all();
        return view('operations.policy', compact('contractors', 'users', 'vehicles',
            'trailers', 'drivers', 'cargos', 'origins', 'destinations', 'policies'));
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
        $request->validate([
            'vehicle_id' => 'required',
            'trailer_id' => 'required',
            'contractor_id' => 'required',
            'origin_id' => 'required',
            'cargo_id' => 'required',
            'shipping_date' => 'required',
            'driver_id' => 'required',
            'destination_id' => 'required',
            'empty_weight' => 'required|confirmed|max:5|min:5',
            'loaded_weight' => 'required|confirmed|max:6|min:5',
            'net_weight' => 'required|confirmed|max:5|min:5'
        ], [
            'vehicle_id.required' => 'يرجي كتابة رقم السيارة',
            'trailer_id.required' => 'يرجي كتابة رقم المقطورة',
            'contractor_id.required' => 'يرجي اختيار مقاول النقل',
            'origin_id.required' => 'يرجي تحديد الراسل',
            'cargo_id.required' => 'يرجي تحديد نوع البضاعة',
            'shipping_date.required' => 'يرجي تحديد تاريخ الشحن',
            'destination_id.required' => 'يرجي تحديد الوجهة',
            'empty_weight.required' => 'يرجي كتابة الوزن الفارغ',
            'empty_weight.max' => 'يجب ان لا يزيد الوزن الفارغ عن 6 ارقام',
            'loaded_weight.required' => 'يرجي كتابة الوزن القائم',
            'net_weight.required' => 'يرجي كتابة الوزن الصافي',
            'loaded_weight.max' => 'يجب ان لا يزيد الوزن القائم عن 7 ارقام',
            'empty_weight.confirmed' => 'لا يوجد تطابق في الوزن الفارغ',
            'loaded_weight.confirmed' => 'لا يوجد تطابق في الوزن القائم',
            'net_weight.confirmed' => 'لا يوجد تطابق في الوزن الصافي',
        ]);
        Policy::create([
            'vehicle_id' => $request->vehicle_id,
            'trailer_id' => $request->trailer_id,
            'contractor_id' => $request->contractor_id,
            'origin_id' => $request->origin_id,
            'cargo_id' => $request->cargo_id,
            'shipping_date' => $request->date('shipping_date'),
            'driver_id' => $request->driver_id,
            'destination_id' => $request->destination_id,
            'empty_weight' => $request->empty_weight,
            'loaded_weight' => $request->loaded_weight,
            'net_weight' => $request->net_weight,
            'created_at' => now(),
            'user_id' => (Auth::user()->id)

        ]);
        $policy_id = Policy::latest()->first()->id;
        PolicyDetail::create([
            'policy_id' => $policy_id,

        ]);
        $request->flash();
        session()->flash('edit', 'تم اضافة بوليصة جديدة ');
        return redirect('/policy');
    }

    public function print_policy($id)
    {
        $policies = Policy::where('id', $id)->first();
        return view('operations.print_policy', compact('policies'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Policy $policy
     * @return \Illuminate\Http\Response
     */
    public function show(Policy $policy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Policy $policy
     * @return \Illuminate\Http\Response
     */
    public function edit(Policy $policy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Policy $policy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
//        $request->validate([
//            'vehicle_id' => 'required',
//            'trailer_id' => 'required',
//            'contractor_id' => 'required',
//            'origin_id' => 'required',
//            'cargo_id' => 'required',
//            'shipping_date' => 'required',
//            'driver_id' => 'required',
//            'destination_id' => 'required',
//            'empty_weight' => 'required|confirmed|max:5|min:5',
//            'loaded_weight' => 'required|confirmed|max:6|min:5',
//            'net_weight' => 'required|confirmed|max:5|min:5'
//        ], [
//            'vehicle_id.required' => 'يرجي كتابة رقم السيارة',
//            'trailer_id.required' => 'يرجي كتابة رقم المقطورة',
//            'contractor_id.required' => 'يرجي اختيار مقاول النقل',
//            'origin_id.required' => 'يرجي تحديد الراسل',
//            'cargo_id.required' => 'يرجي تحديد نوع البضاعة',
//            'shipping_date.required' => 'يرجي تحديد تاريخ الشحن',
//            'destination_id.required' => 'يرجي تحديد الوجهة',
//            'empty_weight.required' => 'يرجي كتابة الوزن الفارغ',
//            'empty_weight.max' => 'يجب ان لا يزيد الوزن الفارغ عن 6 ارقام',
//            'loaded_weight.required' => 'يرجي كتابة الوزن القائم',
//            'net_weight.required' => 'يرجي كتابة الوزن الصافي',
//            'loaded_weight.max' => 'يجب ان لا يزيد الوزن القائم عن 7 ارقام',
//            'empty_weight.confirmed' => 'لا يوجد تطابق في الوزن الفارغ',
//            'loaded_weight.confirmed' => 'لا يوجد تطابق في الوزن القائم',
//            'net_weight.confirmed' => 'لا يوجد تطابق في الوزن الصافي',
//        ]);
        $id = $request->id;
        $policies = Policy::findorFail($id);
        $policies->update([
            'vehicle_id' => $request->vehicle_id,
            'trailer_id' => $request->trailer_id,
            'contractor_id' => $request->contractor_id,
            'origin_id' => $request->origin_id,
            'cargo_id' => $request->cargo_id,
            'shipping_date' => $request->date('shipping_date'),
            'driver_id' => $request->driver_id,
            'destination_id' => $request->destination_id,
            'empty_weight' => $request->empty_weight,
            'loaded_weight' => $request->loaded_weight,
            'created_at' => now(),
            'user_id' => (Auth::user()->id)

        ]);
        session()->flash('edit', 'تم تعديل بيانات البوليصة ');
        return redirect('/policy');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Policy $policy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        Policy::find($id)->delete();
        session()->flash('delete', 'تم حذف بيانات البوليصة');
        return redirect('/policy');
    }

}
