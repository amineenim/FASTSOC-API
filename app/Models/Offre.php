<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    use HasFactory;
     // Specify the table name
     protected $table = 'offres';
    // Attributs modifiables en masse
    protected $fillable = ['name', 'monthly_fee', 'installation_fee'];

    // Relation : Une offre peut avoir plusieurs technologies
    public function technologies()
    {
        return $this->hasMany(Technology::class);
    }

    // Relation : Une offre peut avoir plusieurs commandes
    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
}
