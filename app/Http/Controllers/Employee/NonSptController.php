<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReqNonSptController;
use App\Imports\NonSptImport;
use App\Models\NonSpt;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Excel;

class NonSptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \view('employee.nonSpt.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.nonSpt.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReqNonSptController $request)
    {
        try {
            NonSpt::create($request->except('_token'));
        } catch (Exception $ex) {
            return $ex->getMessage();
        }

        return \redirect()->route('employee.non-spt.index')->with('message', 'Data Non Spt Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(NonSpt $nonSpt)
    {
        return view('employee.nonSpt.show', [
            'nonSpt' => $nonSpt,
            'users' => User::whereNotIn('id', [1,2])->latest()->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(NonSpt $nonSpt)
    {
        return view('employee.nonSpt.edit', [
            'nonSpt' => $nonSpt
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReqNonSptController $request, NonSpt $nonSpt)
    {
        $nonSpt->update($request->except('_token'));
        return \redirect()->route('employee.non-spt.index')->with('message', 'Data Non Berhasil Spt Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(NonSpt $nonSpt)
    {
        if($nonSpt->status == 1) {
            $success = true;
            $message = 'Data sedang dipinjam, tidak dapat di hapus';
        } else {
            $success = \false;
            $message = 'sip';
            $nonSpt->delete();
        }
        
        return \response()->json([
            'success' => $success,
            'message' => $message
        ]);
    }

    public function dtNonSpt()
    {
        $nonSpt = NonSpt::latest()->get();

        return \datatables()->of($nonSpt)
                ->addColumn('action', function($nonSpt){
                    $btn =  '
                        <a href="/employee/master/non-spt/' .$nonSpt->id. '" class="btn btn-primary">Detail</a>
                        <a href="/employee/master/non-spt/' .$nonSpt->id. '/edit" class="btn btn-warning">Edit</a>
                        
                        <a href="#" data-id="'.$nonSpt->id.'" id="delete" class="btn btn-danger">Hapus</a>
                    ';
                    return $btn;
                })
                ->addColumn('status', function($spt){
                    if($spt->status == 0) {
                        $btn = '<font style="color:blue;font-weight:bold;">SEDIA</font>';
                    } elseif($spt->status == 1){
                        $btn = '<font style="color:red;font-weight:bold;">KELUAR</font>';
                    }
                    return $btn;
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'status'])
                ->toJson();
    }
}
