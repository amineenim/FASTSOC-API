<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    // Attributs modifiables en masse
    protected $fillable = ['siren', 'siret', 'legal_name'];

    // Relation : Un client peut avoir plusieurs commandes
    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
}
