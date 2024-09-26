# Laravel API Project with Docker

This project is a Laravel-based API designed to manage client orders. It is fully containerized using Docker for easy setup and testing.

## Features
- CRUD operations for clients and orders.
- Order filtering by various criteria (offer, technology, client, status).
- Validation for requests using Laravel Form Requests.
- Dockerized environment for easy setup and consistent testing.

## Requirements
- Docker and Docker Compose installed on the system.
- Postman for API testing (collection and environment files provided).

## Setup Instructions
1. **Clone the repository:**
    ```bash
    git clone https://github.com/amineenim/FASTSOC-API.git
    cd amine
    ```

2. **Copy the `.env.example` file to `.env` and set the environment variables:**
    ```bash
    cp .env.example .env
    ```

3. **Build and start the Docker containers:**
    ```bash
    docker-compose up --build -d
    ```

4. **Run the database migrations and seeders:**
    ```bash
    docker-compose exec app php artisan migrate --seed
    ```

5. The application will be accessible at `http://localhost:8000`.

## Testing the API
- Import the Postman collection and environment files (located at the root of the project inside postman/) into Postman.
- Use the environment to test all endpoints provided in the collection.

## Available Endpoints
Clients
Create: POST /api/clients – Creates a new client with details like siren, siret, and legal_name.
Get All: GET /api/clients – Retrieves a list of clients. Supports filtering by legal_name, siren and siret using query parameters (e.g., ?legal_name=Example).
Get by ID: GET /api/clients/{id} – Retrieves client details by ID.
Update: PUT /api/clients/{id} – Updates client information. Returns validation errors in JSON if any issues are detected.
Delete: DELETE /api/clients/{id} – Deletes a client. Returns 404 if the client is not found.

Commandes
Create: POST /api/commandes – Creates a new order with fields like client_id, offer_id, status, and technology_ids. Validates input and returns errors in JSON if invalid.
Get All: GET /api/commandes – Retrieves all commandes. Supports filtering by offer_id, technology_id, client_id, and status.
Update: PUT /api/commandes/{id} – Updates an order. The status must not be "completed" for updates to be allowed.

Filtering: Endpoints like GET /api/clients and GET /api/commandes support filtering using query parameters. Invalid parameters return a 400 Bad Request with an error message.


## Notes
- Make sure to have Docker running before executing the commands.
- The project is fully containerized, so there is no need to install PHP, Composer, or MySQL locally.
- The Postman collection includes sample requests for testing each endpoint.( u should have postman locally or authenticate on postman website)
