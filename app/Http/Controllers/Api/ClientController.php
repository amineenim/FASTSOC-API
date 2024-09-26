<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Services\ClientService;
use App\Models\Client;

class ClientController extends Controller
{
    protected $clientService;

    // Inject ClientService into the controller
    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }
    //
    public function store(StoreClientRequest $request)
    {
        $client = Client::create($request->validated());

        return response()->json($client, 201);
    }

    public function index(Request $request)
    {
        $clients = $this->clientService->filterClients($request);
    
        // If the service returns a JSON response (e.g., 404), return it directly
        if ($clients instanceof JsonResponse) {
            return $clients;
        }
    
        // Otherwise, return the list of clients
        return response()->json($clients);
    }

    public function update(UpdateClientRequest $request, $id)
    {
        try {
            // Find the client by ID
            $client = Client::findOrFail($id);
    
            // Perform the update with validated data
            $client->update($request->validated());
    
            // Return the updated client as a JSON response
            return response()->json($client, 200);
        } catch (ValidationException $e) {
            // Return validation errors with a 422 status code
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Return a 404 error if the client is not found
            return response()->json(['message' => 'Client not found.'], 404);
        }
    }

    public function show($id)
    {
        try {
            $client = Client::findOrFail($id);
            return response()->json($client, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Client not found.'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $client = Client::findOrFail($id);
            $client->delete();
            return response()->json(['message' => 'Client deleted successfully.'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Client not found.'], 404);
        }
    }

}


