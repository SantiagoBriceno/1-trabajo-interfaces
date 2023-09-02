<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colors extends Model
{
    use HasFactory;
    protected $table = 'colors';
    public $timestamps = false;
    protected $fillable = [
        'color1',
        'color2',
        'color3',
        'color4',
        'color5',
        'file'
    ];

}
