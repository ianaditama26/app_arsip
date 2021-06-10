<?php

namespace App\Imports;

use App\Models\Npwp;
use App\Models\Spt;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;

class SptImport implements OnEachRow, WithHeadingRow, WithMultipleSheets
    ,SkipsOnError
    ,WithValidation
    // ,SkipsOnFailure

{
    use Importable, SkipsErrors, SkipsFailures;

    public function onRow(\Maatwebsite\Excel\Row $row)
    {
        $rowIndex = $row->getIndex();
        $row = $row->toArray();
        $rowDate = Date::excelToDateTimeObject($row['tgl_lpad'])->format('Y-m-d');

        $npwp = Npwp::where('npwp', $row['npwp'])->first();

        // \dd($row);
       // if ($npwp != null) {
            $spt = Spt::firstOrCreate([
                'npwp' => $row['npwp'] == '' ? '-' : $row['npwp'],
                'namaNpwp' => $row['nama_wp'] == '' ? '-' : $row['nama_wp'],
                'jenis_pajak' => $row['jenis_pajak'] == '' ? '-' : $row['jenis_pajak'],
                'masa_pajak' => $row['masa_pajak'] == '' ? '-' : $row['masa_pajak'],
                'tahun_pajak' => $row['tahun_pajak'] == '' ? '-' : $row['tahun_pajak'],
                'pembetulan' => $row['pembetulan'] == '' ? '-' : $row['pembetulan'],
                'no_lpad' => $row['no_lpad'] == '' ? '-' : $row['no_lpad'],
                'tgl_lpad' => $rowDate == '' ? '-' : $rowDate,
                'noUrut' => $row['no_urut'],
                'noLemari' => $row['no_lemari'] == '' ? '-' : $row['no_lemari'],
                'noBox' => $row['no_box'] == '' ? '-' : $row['no_box'],
                'catt' =>$row['catt'] == '' ? 'catatan kosong' : $row['catt'],
                'status' => 0
            ]);
        //}
    }

    public function sheets(): array
    {
        return [
            0 => new SptImport()
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
