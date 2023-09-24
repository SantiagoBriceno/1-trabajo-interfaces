<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    protected $table = 'media';
    public $timestamps = false;
    protected $fillable = [
        'media1',
        'url1',
        'media2',
        'url2',
        'media3',
        'url3',
    ];
}
