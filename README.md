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
    git clone https://github.com/your-username/your-repository-name.git
    cd your-repository-name
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
- Import the Postman collection and environment files (`postman/postman_collection.json` and `postman/postman_environment.json`) into Postman.
- Use the environment to test all endpoints provided in the collection.

## Available Endpoints
Here is a summary of the key endpoints available in this API:

### Clients
- **Create Client:** `POST /api/clients`
- **Get Clients:** `GET /api/clients`
- **Update Client:** `PUT /api/clients/{id}`
- **Delete Client:** `DELETE /api/clients/{id}`

### Commandes
- **Create Commande:** `POST /api/commandes`
- **Get Commandes:** `GET /api/commandes`
- **Update Commande:** `PUT /api/commandes/{id}`

## Notes
- Make sure to have Docker running before executing the commands.
- The project is fully containerized, so there is no need to install PHP, Composer, or MySQL locally.
- The Postman collection includes sample requests for testing each endpoint.
