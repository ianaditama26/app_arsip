<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailBorrowing()
    {
        return $this->hasMany(DetailBorrowing::class, 'borrowing_id');
    }

    public function history()
    {
        return $this->hasOne(History::class, 'borrowing_id');
    }

    protected static function boot()
    {   
        parent::boot();

        static::deleting(function($borrowing){
            $borrowing->detailBorrowing()->delete();
        });
    }
}
