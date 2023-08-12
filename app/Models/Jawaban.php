<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;

    protected $fillable = ["pertanyaan_id", "responden_id", "jawaban_pertama", "jawaban_kedua"];


    public function responden()
    {
        return $this->belongsTo(Responden::class);
    }

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class);
    }
}
