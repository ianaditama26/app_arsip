<?php

namespace App\Http\Controllers\Admin\npwp;

use App\Http\Controllers\Controller;
use App\Imports\NpwpImport;
use App\Models\Npwp;
use Illuminate\Http\Request;
use Excel;
use Exception;

class NpwpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.npwp.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.npwp.create');
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
            'npwp' => 'required|min:15|max:15|unique:npwps',
            'nama' => 'required',
            'alamat' => 'required'
        ]);

        Npwp::create($request->except('_token'));
        return \redirect()->route('admin.master-npwp.index')->with('message', 'Berhasil menambahkan Npwp');
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
        return view('admin.npwp.edit', [
            'npwp' => Npwp::findOrFail($id)
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
            'npwp' => 'required|min:15|max:15',
            'nama' => 'required',
            'alamat' => 'required'
        ]);

        $npwp = Npwp::findOrFail($id);

        $npwp->update($request->except('_token'));
        session()->flash('message', 'Data Berhasil Diubah');
        return \redirect()->route('admin.master-npwp.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $npwp = Npwp::find($id);
        $npwp->delete();
        return \response()->json(['sukses' => true]);
    }

    public function dtNpwp()
    {
        return \datatables()->of(Npwp::latest()->get())
            ->addColumn('action', function(Npwp $npwp){
                $btn =  '
                    <div class="btn btn-group-sm">
                    <a href="/admin/master-npwp/' .$npwp->id. '/edit" class="btn btn-warning">Edit</a>
                    
                    <a href="#" data-id="'.$npwp->id.'" id="delete" class="btn btn-danger">Hapus</a>
                    </div>
                ';
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->tojson();
    }

    public function importNpwp(Request $request)
    {
        try {
            $import = new NpwpImport();
            $import->import(\request()->file('file'));
        } catch (Exception $e) {
            return \back()->withErrors('error', $e->getMessage());
        }

        \session()->flash('message', 'Import Berhasil');
        return \redirect()->route('admin.master-npwp.index');
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
