<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class livreur extends Model
{
    use HasFactory;
<<<<<<< HEAD
    protected $table = 'comptes';
=======
>>>>>>> 7b90c3555c16ee25bae6338025bc2a1b7295a919
    protected $fillable = [
        'nom',
        'email',
        'mot_de_passe',
<<<<<<< HEAD
        'address',
        'numero',
=======
        'adresse',
        'telephone',
>>>>>>> 7b90c3555c16ee25bae6338025bc2a1b7295a919
        
    ];
}