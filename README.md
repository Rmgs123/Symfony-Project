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
