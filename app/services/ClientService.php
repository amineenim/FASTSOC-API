<?php

namespace App\Services;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ClientService
{
    /**
     * Filter clients based on request parameters.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Database\Eloquent\Collection
     */
    public function filterClients(Request $request)
    {
        $allowedParams = ['legal_name', 'siren', 'siret'];
        $query = Client::query();

        // Check for invalid parameters
        foreach ($request->query() as $key => $value) {
            if (!in_array($key, $allowedParams)) {
                return response()->json(['message' => "Invalid parameter: $key"], 404);
            }
        }

        // Filter by legal name
        if ($request->has('legal_name')) {
            $query->where('legal_name', 'like', '%' . $request->input('legal_name') . '%');
        }

        // Filter by SIREN
        if ($request->has('siren')) {
            $query->where('siren', $request->input('siren'));
        }

        // Filter by SIRET
        if ($request->has('siret')) {
            $query->where('siret', $request->input('siret'));
        }

        $clients = $query->get();

        // Check if no clients found
        if ($clients->isEmpty()) {
            return response()->json(['message' => 'No clients found matching the criteria.'], 404);
        }

        return $clients;
    }
}
