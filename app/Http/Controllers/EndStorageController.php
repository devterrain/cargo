<?php

namespace App\Http\Controllers;

use App\Models\Convair;
use App\Models\Loader;
use App\Models\Operator;
use App\Models\Policy;
use App\Models\PolicyDetail;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EndStorageController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:انهاء التخزين', ['only' => ['index','store', 'update', 'delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $policydetails = PolicyDetail::where([
            ['unload_start', '<>', null],
            ['unload_end', '=', null]
        ])->get()->all();
        if (filled($policydetails)) {
            $policies = Policy::all();
            $stores = Store::all();
            $loaders = Loader::all();
            $convairs = Convair::all();
            $loaderoperators = Operator::where('classs', '=', 'لودر')->get();
            $convairoperators = Operator::where('classs', '=', 'سير')->get();
            $users = User::all();
            return view('operations.endstorage', compact('policydetails', 'loaders', 'convairs', 'convairoperators', 'loaderoperators', 'policies', 'users', 'stores'));
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
    public function update(Request $request, $id)
    {
        $id = $request->id;
        PolicyDetail::where('id', $id)->update
        ([
            'unload_end' => now(),
            'loader_id' => $request->loader_id,
            'loader2_id' => $request->loader2_id,
            'convair_id' => $request->convair_id,
            'loader_operator_id' => $request->loader_operator_id,
            'loader2_operator_id' => $request->loader2_operator_id,
            'convair_operator_id' => $request->convair_operator_id,
            'unload_notes' => $request->unload_notes,
            'shipping2_user_id' => (Auth::user()->id)
        ]);
        $request->flash();
        session()->flash('edit', 'تم إنهاء العملية ');
        return redirect('/endstorage');
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
