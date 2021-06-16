<?php

namespace App\Exports;

use App\Models\NonSpt;
use Maatwebsite\Excel\Concerns\FromView;

class NonSptExport implements FromView
{
    protected $noBox;

    public function __construct($noBox)
    {
        return $this->noBox = $noBox;
    }

    public function collection()
    {
        $collection = NonSpt::query()
        ->select('npwp', 'namaNpwp', 'alamat', 'jenis_dokumen', 'no_dokumen', 'noUrut', 'noLemari', 'noBox', 'catt')
        ->whereIn('noBox', [$this->noBox])->get();

        $collection->map(function ($item, $key) {
            $item->npwp = "'" . $item->npwp;
            return $item;
        });
        return $collection;
    }

    public function view(): \Illuminate\Contracts\View\View
    {
        return view('admin.nonSpt.export', [
            'nonSpt' => $this->collection()
        ]);
    }
}
