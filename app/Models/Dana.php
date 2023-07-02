<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dana extends Model
{
    use HasFactory;

    protected $table = 'dana';

    protected $guarded = ['id'];
    protected $dates = ['jadwal_pengambilan', 'tanggal_pengambilan'];
    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
    public function ormawa()
    {
        return $this->belongsTo(Ormawa::class);
    }
}
