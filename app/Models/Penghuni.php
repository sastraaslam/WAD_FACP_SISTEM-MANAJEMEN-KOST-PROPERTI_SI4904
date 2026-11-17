<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penghuni extends Model
{
    protected $table = 'penghuni';

    protected $fillable = ['user_id', 'nama', 'nik', 'jk', 'pekerjaan', 'kontakdarurat'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}