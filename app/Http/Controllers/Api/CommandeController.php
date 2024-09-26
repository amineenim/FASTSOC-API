<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCommandeRequest;
use App\Http\Requests\UpdateCommandeRequest;
use App\Http\Requests\FilterCommandeRequest;
use App\Services\CommandeService;
use App\Models\Commande;

class CommandeController extends Controller
{
    protected $commandeService;

    public function __construct(CommandeService $commandeService)
    {
        $this->commandeService = $commandeService;
    }


    /**
     * Get a list of orders with optional filtering.
     */
    public function index(FilterCommandeRequest $request)
    {
        try {
            $commandes = $this->commandeService->filterCommandes($request);
            return response()->json($commandes, 200);
        } catch (\Illuminate\Http\Exceptions\HttpResponseException $e) {
            return $e->getResponse();
        }
    }

        /**
     * Create a new order.
     */
    public function store(StoreCommandeRequest $request)
    {
        $data = $request->validated();
        $commande = $this->commandeService->createCommande($data);

        return response()->json($commande, 201);
    }

    /**
     * Update an existing order.
     */
    public function update(UpdateCommandeRequest $request, $id)
    {
        try {
            $commande = Commande::findOrFail($id);

            // Check if the status is 'completed'
            if ($commande->status === 'completed') {
                return response()->json(['message' => 'Cannot update a completed order.'], 403);
            }

            $updatedCommande = $this->commandeService->updateCommande($commande, $request->validated());

            return response()->json($updatedCommande, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Order not found.'], 404);
        }
    }

}
