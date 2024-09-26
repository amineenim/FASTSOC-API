<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    // Attributs modifiables en masse
    protected $fillable = ['name', 'offer_id'];

    // Relation : Une technologie appartient à une offre
    public function offre()
    {
        return $this->belongsTo(Offre::class);
    }

    // Relation : Une technologie peut être liée à plusieurs commandes
    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'commande_technologie');
    }
}
