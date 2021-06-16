<?php

namespace App\Imports;

use App\Models\NonSpt;
use App\Models\Npwp;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Row;

class NonSptImport implements OnEachRow, WithHeadingRow, WithMultipleSheets
    ,SkipsOnError
    ,SkipsOnFailure
    // ,WithValidation
{
    use Importable, SkipsErrors, SkipsFailures;

    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row = $row->toArray();

        $npwp = Npwp::where('npwp', $row['npwp'])->first();

       // if ($npwp != null) {
            $nonSpt = NonSpt::firstOrCreate([
                'npwp' => $row['npwp'] == '' ? '-' : $row['npwp'],
                'namaNpwp' => $row['nama_wp'] == '' ? '-' : $row['nama_wp'],
                'alamat' => $row['alamat'] == '' ? '-' : $row['alamat'],
                'jenis_dokumen' => $row['jenis_dokumen'] == '' ? '-' : $row['jenis_dokumen'],
                'no_dokumen' => $row['nomor_dokumen'] == '' ? '-' : $row['nomor_dokumen'],
                'noUrut' => $row['no_urut'] == '' ? '-' : $row['no_urut'],
                'noLemari' => $row['nomor_lemari'] == '' ? '-' : $row['nomor_lemari'],
                'noBox' =>$row['no_box'] == '' ? '-' : $row['no_box'],
                'catt' =>$row['catt'] == '' ? 'catatan kosong' : $row['catt'],
                'status' => 0
            ]);
       // }
    }

    public function sheets(): array
    {
        return [
            0 => new NonSptImport()
        ];
    }

    public function rules(): array
    {
        return [
            'npwp' => ['required', 'min:15', 'max:15'],
            '*.nama_wp' => ['required'],
            '*.catt' => ['nullable'],
        ];
    }
}
