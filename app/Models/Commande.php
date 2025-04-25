<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_produit',
        'id_panier',
        'quantite',
        'prix_total',
        'address',
        'numero',
    ];
}
