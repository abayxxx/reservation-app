<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responden extends Model
{
    use HasFactory;

    protected $fillable = ["nama", "email", "jenis_kelamin"];


    public function jawaban()
    {
        return $this->hasMany(Jawaban::class);
    }
}
