<?php

namespace App\Imports;

use App\Models\Npwp;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Row;

class NpwpImport implements OnEachRow, WithHeadingRow, WithMultipleSheets, SkipsOnError
{
    use Importable, SkipsErrors;

    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row = $row->toArray();
        // \dd($row);
        Npwp::firstOrCreate([
            'npwp' => $row['npwp'] == '' ? '-' : $row['npwp'],
            'nama' => $row['nama'] == '' ? '-' : $row['nama'],
            'alamat' => $row['alamat'] == '' ? '-' : $row['alamat']
        ]);
    }

    public function sheets(): array
    {
        return [
            0 => new NpwpImport()
        ];
    }

    public function rules(): array
    {
        return [
            '*.npwp' => 'required|numeric',
            '*.nama' => 'required|string',
        ];
    }
}
