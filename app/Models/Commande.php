<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    // Attributs modifiables en masse
    protected $fillable = [
        'client_id', 'offer_id', 'status', 'number_of_licenses', 'description',
        'os_type', 'extended_protection', 'encryption_protection', 'firewall'
    ];

    // Relation : Une commande appartient à un client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Relation : Une commande appartient à une offre
    public function offre()
    {
        return $this->belongsTo(Offre::class, 'offer_id');
    }

    // Relation : Une commande peut avoir plusieurs technologies
    public function technologies()
    {
        return $this->belongsToMany(Technology::class, 'commande_technologie');
    }

    public function calculateRevenue()
    {
        // access the related Offer through the relation
        $offer = $this->offre;

        if (!$offer) {
            return 0;
        }

        // Assuming that revenue includes the installation fee and one month of subscription
        $totalRevenue = $offer->installation_fee + $offer->monthly_fee;

        return $totalRevenue;
    }
}
