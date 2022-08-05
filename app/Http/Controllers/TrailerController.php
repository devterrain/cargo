<?php

namespace App\Http\Controllers;

use App\Models\contractor;
use App\Models\Trailer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrailerController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:إضافة مقطورات', ['only' => ['index','store', 'update', 'delete']]);
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
        $trailers = Trailer::all();
        return view('edit.trailer', compact('contractors', 'users', 'trailers'));
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
            'tplate_num' => 'required|unique:trailers',
            'trailer_type' => 'required',
            'contractor_id' => 'required'
        ],[

            'tplate_num.required' =>'يرجي كتابة رقم المقطورة',
            'tplate_num.unique' =>'اسم المقطورة مسجل مسبقاً'
        ]);

            Trailer::create([
                'tplate_num' => $request->tplate_num,
                'trailer_type' => $request->trailer_type,
                'trailer_notes' => $request->trailer_notes,
                'contractor_id' => $request->contractor_id,
                'entry_date' => $request->date('entry_date'),
                'user_id' => (Auth::user()->id)

            ]);
            session()->flash('Add', 'تم اضافة مقطورة جديدة ');
            return redirect('/trailer');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trailer  $trailer
     * @return \Illuminate\Http\Response
     */
    public function show(Trailer $trailer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trailer  $trailer
     * @return \Illuminate\Http\Response
     */
    public function edit(Trailer $trailer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trailer  $trailer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;

        // $this->validate($request,[
        //     'manufacturer' => 'max:50',
        //     'model' => 'max:50',
        //     'contractor_id' => 'required'
        // ],[
        //     'plate_num.required' =>'يرجي كتابة رقم السيارة',
        //     'plate_num.unique' =>'اسم السيارة مسجل مسبقاً'
        // ]);

        $trailers = Trailer::find($id);
        $trailers->update([
            'tplate_num' => $request->tplate_num,
            'trailer_type' => $request->trailer_type,
            'trailer_notes' => $request->trailer_notes,
            'contractor_id' => $request->contractor_id,
            'entry_date' => $request->date('entry_date')
        ]);
        session()->flash('edit','تم تعديل بيانات المقطورة');
        return redirect('/trailer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trailer  $trailer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        Trailer::find($id)->delete();
        session()->flash('delete','تم حذف المقطورة بنجاح');
        return redirect('/trailer');
    }
}
