<?php

namespace App\Http\Controllers\Admin\taxType;

use App\Http\Controllers\Controller;
use App\Models\TaxType;
use Illuminate\Http\Request;

class TaxTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.taxType.index', [
            'taxTypes' => TaxType::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.taxType.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'taxType' => 'required'
        ]);
        
        try {
            TaxType::create($request->only('taxType'));
        } catch (\Exception $e) {
            return back()->withError('error'. $e->getMessage());
        }

        return \redirect()->route('admin.pajak.index')->with('message', 'Berhasil');
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
        return \view('admin.taxType.edit', [
            'taxType' => TaxType::findOrFail($id)
        ]);
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
        $this->validate($request, [
            'taxType' => 'required'
        ]);

        try {
            $taxType = TaxType::findOrFail($id);
            $taxType->update($request->only('taxType'));
        } catch (\Exception $e) {
            return back()->withError('error'. $e->getMessage());
        }

        return \redirect()->route('admin.pajak.index')->with('message', 'Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $taxType = TaxType::findOrFail($id);
        $taxType->delete();
        return \redirect()->route('admin.pajak.index')->with('message', 'Berhasil');
    }
}
