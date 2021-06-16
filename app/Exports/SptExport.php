<?php

namespace App\Exports;

use App\Models\Spt;
use Maatwebsite\Excel\Concerns\FromView;

class SptExport implements FromView 
{
    protected $noBox;

    public function __construct($noBox)
    {
        return $this->noBox = $noBox;
        
    }

    public function collection()
    {
        $collection = Spt::query()
        ->select('npwp', 'namaNpwp', 'jenis_pajak', 'masa_pajak', 'tahun_pajak', 'pembetulan', 'no_lpad', 'tgl_lpad', 'noUrut', 'noLemari', 'noBox', 'catt')
        ->whereIn('noBox', [$this->noBox])->get();

        $collection->map(function ($item, $key) {
            $item->npwp = "'" . $item->npwp;
            return $item;
        });
        return $collection;
    }

    public function view(): \Illuminate\Contracts\View\View
    {
        return view('admin.spt.export', [
            'spt' => $this->collection()
        ]);
    }
}
