<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    //Defino a que tabla estara asociado
    protected $table = 'empresa';
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'name',
        'rif',
        'email',
        'email2',
        'phone',
        'phone2',
        'pais',
        'estado',
        'direccion'
    ];
}
