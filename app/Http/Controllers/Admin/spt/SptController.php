<?php

namespace App\Http\Controllers\Admin\spt;

use App\Exports\SptExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReqSptController;
use App\Imports\SptImport;
use App\Models\NonSpt;
use App\Models\Npwp;
use App\Models\Spt;
use App\Models\TaxType;
use App\Models\User;
use Illuminate\Http\Request;
use Excel;
use Exception;

class SptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spt = Spt::orderBy('noBox', 'asc')->get();
        $noBoxSpt = $spt->pluck('noBox')->toArray();
        return view('admin.spt.index', [
            'noBox' => \array_unique($noBoxSpt) 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('admin.spt.create', [
            'taxTypes' => TaxType::orderBy('taxType', 'desc')->get() 
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReqSptController $request)
    {
        try {
            $data = $request->except('_token');
            Spt::create($data);
        } catch (Exception $e) {
            return back()->withError('error'. $e->getMessage());
        }
        session()->flash('message', 'Data berhasil ditambahkan');
        return \redirect()->route('admin.spt.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Spt $spt)
    {
        return view('admin.spt.show', [
            'spt' => $spt,
            'users' => User::whereNotIn('id', [1,2])->latest()->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Spt $spt)
    {
        return view('admin.spt.edit', [
            'spt' => $spt,
            'taxTypes' => TaxType::orderBy('taxType', 'desc')->get() 
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spt $spt)
    {
        $spt->update($request->except('_token'));
        \session()->flash('message', 'Data Berhasil di Ubah');
        return view('admin.spt.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spt $spt)
    {
        if($spt->status == 1) {
            $success = true;
            $message = 'Data sedang dipinjam, tidak dapat di hapus';
        } else {
            $success = \false;
            $message = 'sip';
            $spt->delete();
        }
        
        return \response()->json([
            'success' => $success,
            'message' => $message
        ]);
    }

    public function dtSpt()
    {
        $spt = Spt::latest()->get();

        return\datatables()->of($spt)
            ->addColumn('action', function($spt){
                $btn =  '
                    <a href="/admin/master/spt/' .$spt->id. '" class="btn btn-primary">Detail</a>
                    <a href="/admin/master/spt/' .$spt->id. '/edit" class="btn btn-warning">Edit</a>
                    
                    <a href="#" data-id="'.$spt->id.'" id="delete" class="btn btn-danger">Hapus</a>
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

    public function import(Request $request)
    {
        try {
            $import = new SptImport();
            $import->import(\request()->file('file'));
        } catch (Exception $e) {
            $failures = $e->failures();
            return \view('admin.spt.failures', \compact('failures'));
            return back()->withError('error'. $e->getMessage());
        }

        \session()->flash('message', 'Import Berhasil');
        return \redirect()->route('admin.spt.index');
    }

    public function export(Request $request)
    {
        try {
            return Excel::download(new SptExport($request->noBox), 'dataSPT_box_'.$request->noBox.'.xlsx');
        } catch (Exception $e) {
            return back()->withError('error'. $e->getMessage());
        }
    }

    public function checkNpwp(Request $request)
    {   
        $npwp = Npwp::where('npwp', $request->npwp)->first();
        if ($npwp) {
            $message = 'Npwp ada';
            $success = true;
            $data = $npwp;
        } else {
            $message = 'Npwp tidak ada !!!';
            $success = \false;
            $data = '';
        }
        return \response()->json([
            'message' => $message,
            'success' => $success,
            'npwp' => $data
        ]);
    }
}
