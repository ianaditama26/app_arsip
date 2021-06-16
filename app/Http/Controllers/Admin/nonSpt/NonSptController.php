<?php

namespace App\Http\Controllers\Admin\nonSpt;

use App\Exports\NonSptExport;
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
        $nonSpt = NonSpt::orderBy('noBox', 'asc')->get();
        $noBoxNonSpt = $nonSpt->pluck('noBox');
        return \view('admin.nonSpt.index', [
            'noBox' => \collect($noBoxNonSpt)->unique()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.nonSpt.create');
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

        return \redirect()->route('admin.non-spt.index')->with('message', 'Data Non Spt Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(NonSpt $nonSpt)
    {
        return view('admin.nonSpt.show', [
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
        return view('admin.nonSpt.edit', [
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
        return \redirect()->route('admin.non-spt.index')->with('message', 'Data Non Spt Berhasil Diubah');
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
                        <a href="/admin/master/non-spt/' .$nonSpt->id. '" class="btn btn-primary">Detail</a>
                        <a href="/admin/master/non-spt/' .$nonSpt->id. '/edit" class="btn btn-warning">Edit</a>
                        
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

    public function importNonSpt()
    {
        try {
            Excel::import(new NonSptImport, request()->file('file'));
        } catch (Exception $ex) {
            return \back()->withError('error'. $ex->getMessage());
        }

        return \redirect()->route('admin.non-spt.index')->with('message', 'Import Berhasil');
    }

    public function exportNonSpt(Request $request)
    {
        try {
            return Excel::download(new NonSptExport($request->noBox), 'data_nonSPT_box_'.$request->noBox.'.xlsx');
        } catch (Exception $e) {
            return back()->withError('error'. $e->getMessage());
        }
    }
}
