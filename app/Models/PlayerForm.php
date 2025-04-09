<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'no_ic',
        'no_fon',
        'score',
        'receipt',
        'puzzle_version',
    ];

    protected $casts = [
        'score' => 'integer',
    ];
}
