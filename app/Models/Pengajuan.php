<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;
    protected $table = 'pengajuan';

    protected $guarded = ['id'];
    public function persetujuan()
    {
        return $this->belongsTo(Persetujuan::class);
    }
    public function dana()
    {
        return $this->hasOne(Dana::class);
    }
    public function ormawa()
    {
        return $this->belongsTo(Ormawa::class);
    }
}
