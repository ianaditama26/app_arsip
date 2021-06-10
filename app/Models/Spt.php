<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Spt extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'spts';

    public static function getSpt()
    {
        $data = DB::table('spts')->select(
            'id','npwp','namaNpwp','alamat','kelKec','jenis_pajak','masa_pajak','tahun_pajak','status_pajak','no_lpad','tgl_lpad','noUrut','noLemari','noBox','catt',
        )->get()->toArray();

        return $data;
    }

    public function sptDetail()
    {
        return $this->hasOne(DetailBorrowingSpt::class);
    }

    public function getStatus()
    {
        if($this->status == 0){
            $status = 'SEDIA';
        } elseif($this->status == 1){
            $status = 'KELUAR';
        } else {

        }

        return $status;
    }
}
