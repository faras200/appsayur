<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persetujuan extends Model
{
    use HasFactory;
    protected $table = 'persetujuan';

    protected $guarded = ['id'];

    public function scopenotapprove($query){
        if(auth()->user()->role == 'baak' ){
            return $query->where( auth()->user()->role , '=', 1 )->where('warek', '=' ,2)->orwhere(function($query) {
                $query->where('warek', '=' ,0)
                      ->where(auth()->user()->role , '=', 1);
            });
        }
        if(auth()->user()->role == 'warek' ){
            return $query->where( auth()->user()->role , '=', 1 )->where('bem', '=' ,2)->orwhere(function($query) {
                $query->where('bem', '=' ,0)
                      ->where(auth()->user()->role , '=', 1);
            });
        }
        if(auth()->user()->role == 'bem' ){
            return $query->where( auth()->user()->role , '=', 1 )->where('dema', '=' ,2)->orwhere(function($query) {
                $query->where('dema', '=' ,0)
                      ->where(auth()->user()->role , '=', 1);
            });
        }
        if(auth()->user()->role == 'dema' ){
            return $query->where( auth()->user()->role , '=', 1 );
        }
        
    }

    public function scopeapprove($query)
    {
        return $query->where( auth()->user()->role , '=', 2 );
        //return $query->where('baak' , 2)->where('warek' , 2)->where('bem', 2)->where('dema' , 2);
    }
}
