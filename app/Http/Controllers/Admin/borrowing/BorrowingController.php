<?php

namespace App\Http\Controllers\Admin\borrowing;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\DetailBorrowing;
use App\Models\History;
use App\Models\NonSpt;
use App\Models\Spt;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowingController extends Controller
{
    public function index()
    { 
        return view('admin.borrowing.index');
    }

    public function dtBorrowing()
    {
        $borrowing = Borrowing::with(['user', 'detailBorrowing'])
        ->where('status', 0)->get();

        return \datatables()->of($borrowing)
            ->addColumn('listDetail', function(Borrowing $borrowing){
                
                return view('admin.borrowing.list', [
                    'borrowing' => $borrowing->detailBorrowing
                ]);
            })
            ->addColumn('action', function(Borrowing $borrowing){
                $btn = '
                    <a href="/admin/peminjaman/'.$borrowing->id.'/edit" class="btn btn-primary">Edit</a>

                    <a href="#" data-id="'.$borrowing->id.'" id="delete" class="btn btn-danger">Hapus</a>

                    <a href="#" data-id="'.$borrowing->id.'" id="pengembalian" class="btn btn-success">
                        <span class="fa fa-check"></span>
                    </a>
                ';
                return $btn;
            })
            ->addColumn('date', function(Borrowing $borrowing){
                $dateFormat = Carbon::parse($borrowing->date);
                $date = ''.$dateFormat->format('d-m-Y').' | '.$borrowing->created_at->diffForHumans().'';

                return $date;
            })
            ->rawColumns(['listDetail', 'action', 'date'])
            ->addIndexColumn()
            ->toJson();
    }

    public function show($id)
    {
        # code...
    }

    public function create()
    {  
        return view('admin.borrowing.create',  [
            'users' => User::whereNotIn('id', [1,2])->get(),
            'spts' => Spt::latest()->get(),
            'nonSpts' => NonSpt::latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'date' => 'required',
            'time' => 'required'
        ]);

        $borr = Borrowing::create([
            'user_id' => $request->user_id,
            'date' => $request->date,
            'time' => $request->time,
            'catatan' => $request->catt,
        ]);

        if(!empty($request->spt)){
            foreach ($request->spt as $spt => $v) { 
                $dataSpt = [
                    'borrowing_id' => $borr->id,
                    'npwp' => $request->spt[$spt],
                    'typeSpt' => 'SPT'
                ];
                DB::table('detail_borrowings')->insert($dataSpt);
            }
            //update status spt
            $dataSpt = Spt::whereIn('npwp', $request->spt)->update(['status' => 1]);
        }
        
        if(!empty($request->nonSpt)){
            foreach ($request->nonSpt as $nonSpt => $v) { 
                $dataNonSpt = [
                    'borrowing_id' => $borr->id,
                    'npwp' => $request->nonSpt[$nonSpt],
                    'typeSpt' => 'Non SPT'
                ];
                DB::table('detail_borrowings')->insert($dataNonSpt);
            }

            //update status non spt
            $dataNonSpt = NonSpt::whereIn('npwp', $request->nonSpt)->update(['status' => 1]);
        }

        return \redirect()->route('admin.peminjaman.index')->with('message', 'Berhasil');
    }

    public function edit($id)
    {
        return \view('admin.borrowing.edit', [
            'borrowing' => Borrowing::findOrFail($id),
            'spts' => Spt::latest()->get(),
            'nonSpts' => NonSpt::latest()->get(), 
        ]);
    }

    public function update(Request $request, $id)
    {
        $borrowing = Borrowing::findOrFail($id);
        $borrowing->update($request->only('date', 'time', 'catt'));
        if(!empty($request->spt)){
            foreach ($request->spt as $spt => $v) { 
                $dataSpt = [
                    'borrowing_id' => $borrowing->id,
                    'npwp' => $request->spt[$spt],
                    'typeSpt' => 'SPT'
                ];
                DB::table('detail_borrowings')->insert($dataSpt);
            }
            //update status spt
            $dataSpt = Spt::whereIn('npwp', $request->spt)->update(['status' => 1]);
        }
        
        if(!empty($request->nonSpt)){
            foreach ($request->nonSpt as $nonSpt => $v) { 
                $dataNonSpt = [
                    'borrowing_id' => $borrowing->id,
                    'npwp' => $request->nonSpt[$nonSpt],
                    'typeSpt' => 'Non SPT'
                ];
                DB::table('detail_borrowings')->insert($dataNonSpt);
            }

            //update status non spt
            $dataNonSpt = NonSpt::whereIn('npwp', $request->nonSpt)->update(['status' => 1]);
        }
        return \redirect()->route('admin.peminjaman.index')->with('message', 'Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        $detail = DetailBorrowing::where('borrowing_id', $borrowing->id)->get();
        $npwp = [];
        foreach($detail as $v) {
            $npwp[] = $v->npwp;
        }

        $spt = DB::table('spts')->whereIn('npwp', $npwp)->update(['status' => 0]);
        $nonSpt = DB::table('non_spts')->whereIn('npwp', $npwp)->update(['status' => 0]);
        
        $borrowing->delete();
        return \response()->json(['sukses' => \true]);
    }

    public function destroyFile($id)
    {
        $detailBorrowing = DetailBorrowing::find($id);
        if ($detailBorrowing->typeSpt == 'SPT') {
            DB::table('spts')->where([
                ['npwp', '=', $detailBorrowing->npwp]
            ])->update(['status' => 0]);
        } elseif($detailBorrowing->typeSpt == 'Non SPT') {
            DB::table('non_spts')->where([
                ['npwp', '=', $detailBorrowing->npwp]
            ])->update(['status' => 0]);
        }

        $detailBorrowing->delete();
        return \response()->json(['sukses' => \true]);
    }

    public function kembalikanPerSpt($id)
    {
        $detailBorrowing = DetailBorrowing::findOrFail($id);
        
        // buat history peminjaman
        if ($detailBorrowing->typeSpt == 'Non SPT') {
            History::create([
                'nama' => $detailBorrowing->borrowing->user->name,
                'npwp' => $detailBorrowing->npwp,
                'typeSpt' => $detailBorrowing->typeSpt,
                'date' => Carbon::today()->format('Y-m-d'),
                'time' => Carbon::now()->format('H:s'),
                'catatan' => $detailBorrowing->borrowing->catatan
            ]);
            DB::table('non_spts')->where('npwp', $detailBorrowing->npwp)
            ->update(['status' => 0]);
        } elseif ($detailBorrowing->typeSpt == 'SPT') {
            History::create([
                'nama' => $detailBorrowing->borrowing->user->name,
                'npwp' => $detailBorrowing->npwp,
                'typeSpt' => $detailBorrowing->typeSpt,
                'date' => Carbon::today()->format('Y-m-d'),
                'time' => Carbon::now()->format('H:s'),
                'catatan' => $detailBorrowing->borrowing->catatan
            ]);
            DB::table('spts')->where('npwp', $detailBorrowing->npwp)
            ->update(['status' => 0]);
        } else {
            return \abort(505);
        }
        //hapus detail pinjaman
        $detailBorrowing->delete();

        session()->flash('alert', 'Berhasil');
        return \back();
    }

    public function pengembalian(Request $request)
    {
        $borrowing = Borrowing::find($request->id);

        $npwp = [];
        foreach($borrowing->detailBorrowing as $v) {
            $npwp[] = $v->npwp;
        }

        DB::table('spts')->whereIn('npwp', $npwp)->update(['status' => 0]);
        DB::table('non_spts')->whereIn('npwp', $npwp)->update(['status' => 0]);

        //create history 
        foreach($borrowing->detailBorrowing as $bor => $v) {
            $history = [
                'nama' => $borrowing->user->name,
                'npwp' => $npwp[] = $v->npwp,
                'typeSpt' => $typeSpt[] = $v->typeSpt,
                'date' => Carbon::today()->format('Y-m-d'),
                'time' => Carbon::now()->format('H:s'),
                'catatan' => $borrowing->catatan,
                'created_at' =>  \Carbon\Carbon::now(), # new \Datetime()
                'updated_at' => \Carbon\Carbon::now(),  # new \Datetime()
            ];
            DB::table('histories')->insert($history);
        }
        $borrowing->delete();

        return \response()->json(['sukses' => \true]);
    }

    public function riwayat()
    {
        return view('admin.borrowing.riwayat');
    }

    public function dtRiwayat()
    {
        $history = History::with(['borrowing'])->latest()->get();

        return \datatables()->of($history)
            ->addColumn('date', function(History $history){
                $dateFormat = Carbon::parse($history->date);
                $date = ''.$dateFormat->format('d-m-Y').' | '.$history->created_at->diffForHumans().'';

                return $date;
            })
            ->rawColumns(['date'])
            ->addIndexColumn()
            ->toJson();
    }
}
