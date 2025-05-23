<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'localisation',
        'description',
        'image',
        'id_admin',
        'id_categorie',
    ];
  
}