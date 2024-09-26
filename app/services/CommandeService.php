<?php

namespace App\Services;

use App\Models\Commande;
use App\Enums\FilterParameter;
use Illuminate\Http\Exceptions\HttpResponseException;


class CommandeService
{
    /**
     * Filter orders based on request parameters.
     */
    public function filterCommandes($request)
    {
        $query = Commande::query();

        // Eager load offer and client data
        $query->with(['offre', 'client']);
        
        // Array of valid filter parameters
        $validParameters = [
            FilterParameter::OFFER_ID->value,
            FilterParameter::TECHNOLOGY_ID->value,
            FilterParameter::CLIENT_ID->value,
            FilterParameter::STATUS->value,
        ];

        // Check for invalid parameters
        foreach ($request->all() as $key => $value) {
            if (!in_array($key, $validParameters)) {
                throw new HttpResponseException(
                    response()->json([
                        'message' => "Invalid parameter: '$key'",
                    ], 422)
                );
            }
        }

        // Filter by offer
        if ($request->has(FilterParameter::OFFER_ID->value)) {
            $query->where('offer_id', $request->input(FilterParameter::OFFER_ID->value));
        }

        // Filter by technology
        if ($request->has(FilterParameter::TECHNOLOGY_ID->value)) {
            $query->whereHas('technologies', function ($q) use ($request) {
                $q->where('technology_id', $request->input(FilterParameter::TECHNOLOGY_ID->value));
            });
        }

        // Filter by client
        if ($request->has(FilterParameter::CLIENT_ID->value)) {
            $query->where('client_id', $request->input(FilterParameter::CLIENT_ID->value));
        }

        // Filter by status
        if ($request->has(FilterParameter::STATUS->value)) {
            $query->where('status', $request->input(FilterParameter::STATUS->value));
        }

        $commandes = $query->get();

        // Check if there are no results
        if ($commandes->isEmpty()) {
            throw new HttpResponseException(
                response()->json([
                    'message' => 'No matching records found for the provided filters.',
                ], 404)
            );
        }

        // Add additional data to each commande
        $commandes->each(function ($commande) {
            $commande->total_revenue = $commande->calculateRevenue();
        });

        return $commandes;
    }

    /**
     * Create a new order.
     */
    public function createCommande(array $data)
    {
        $commande = Commande::create([
            'client_id' => $data['client_id'],
            'offer_id' => $data['offer_id'],
            'status' => $data['status'],
            'number_of_licenses' => $data['number_of_licenses'],  // Use the correct key here
            'description' => $data['description'] ?? null,
        ]);

        // Attach technologies to the order
        $commande->technologies()->attach($data['technology_ids']);

        return $commande;
    }


    /**
     * Update an existing order.
     */
    public function updateCommande(Commande $commande, array $data)
    {
        // Check if the status is 'completed'
        if ($commande->status === 'completed') {
            return null;
        }

        $commande->update($data);
        return $commande;
    }
}
