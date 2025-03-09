# Symfony Project

This project is a Symfony-based application containerized using Docker. It includes containers for PHP, Nginx, and PostgreSQL, ensuring a reproducible development environment for local development and deployment.

## Prerequisites

- **Git** – for version control.
- **Docker & Docker Compose** – for containerization.
- **PHP & Composer** – (optional, if you want to run Composer locally).
- **Symfony CLI** – (optional, but recommended for Symfony project management).

## Getting Started

### 1. Clone the Repository

Clone the repository from GitHub to your local machine:

```bash
git clone https://github.com/Rmgs123/Symfony-Project.git
```

### 2. Environment Setup

Create your environment file:

- Copy the sample environment file or create your own `.env` file in the root directory.
- Edit the `.env` file to include your database and app settings. For example:

```dotenv
APP_ENV=dev
APP_SECRET=your_app_secret_here
DATABASE_URL="postgresql://symfony:symfony@db:5432/symfony?serverVersion=15&charset=utf8"
```

### 3. Install PHP Dependencies

Install the necessary PHP dependencies using Composer:

```bash
composer install
```

### 4. Build and Run Containers

This project uses Docker to create an isolated environment. The Docker configuration includes:

- **docker-compose.yml:** Defines services for PHP, Nginx, and PostgreSQL.
- **Dockerfile-php:** Builds the PHP container with necessary extensions and Composer.
- **docker/nginx/default.conf:** Configures Nginx to serve the Symfony application.
  
**Build the Docker images with:**

```bash
docker-compose build
```

Then, start the containers in detached mode:

```bash
docker-compose up -d
```

### 5. Verify the Setup

- **Web Server:**  
  Open your browser and go to [http://localhost](http://localhost). You should see the Symfony welcome page or your application’s default route.
  
- **Database Connectivity:**  
  Don't forget to verify that the PostgreSQL container is working.
 
 <br><br>
 
## API Usage Examples

Below are examples of how to test the API endpoints using `curl`. These commands assume your application is running locally at `http://localhost`.

## 1. List Available Cottages

**Endpoint:** `GET /api/cottages`

```bash
curl -X GET "http://localhost/api/cottages"
```

This command retrieves a JSON list of all available cottages.

---

## 2. List All Bookings

**Endpoint:** `GET /api/bookings`

```bash
curl -X GET "http://localhost/api/bookings"
```

This command retrieves a JSON list of all current bookings.

---

## 3. Create a New Booking

**Endpoint:** `POST /api/bookings`  
**Parameters:**
- `phone`: Client's phone number  
- `cottageId`: ID of the cottage  
- `comment`: Optional comment

**Example using URL-encoded form data:**

```bash
curl -X POST "http://localhost/api/bookings" -H "Content-Type: application/x-www-form-urlencoded" -d "phone=+123456789&cottageId=2&comment=Need a quiet place"
```

**Or using multipart/form-data:**

```bash
curl -X POST "http://localhost/api/bookings" -F "phone=+123456789" -F "cottageId=2" -F "comment=Need a quiet place"
```

This command creates a new booking record. After running it, you can verify the new booking by checking the CSV file or using the GET bookings endpoint.

---

## 4. Update an Existing Booking

**Endpoint:** `PUT /api/bookings/{id}` (replace `{id}` with the actual booking ID)  
**Parameter:**
- `comment`: New comment for the booking

**Example using JSON data:**

```bash
curl -X PUT "http://localhost/api/bookings/1" -H "Content-Type: application/json" -d "{\"comment\":\"Hello\"}"
```

This command updates the booking with ID `1` by changing its comment to "Hello". Verify the update by listing bookings or checking the CSV file.

---
