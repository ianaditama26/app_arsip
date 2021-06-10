<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonSpt extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function detailBorrowingNonSpt()
    {
        return $this->belongsTo(DetailBorrowingNonSpt::class);
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
