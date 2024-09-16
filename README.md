# Fuel Track Application

## Introduction

This is a Laravel application for managing fuel requests and tracking vehicle fuel consumption.

## Installation

**Prerequisites:**

* PHP 8.1 or higher
* Composer
* MySQL database
* Node.js and npm

**Steps:**

1. **Clone the repository:**

   ```bash
   git clone https://github.com/hasin0/fueltrack.git

2. Navigate to the project directory:

   cd fueltrack

3. Install dependencies:

    composer install
    npm install

4. Create a copy of the environment file:

    cp .env.example .env

5. Configure the environment file:

    Update the database credentials in the .env file.

    Set the application URL.

    Generate an application key:

    php artisan key:generate


6. Run migrations and seeders:

    php artisan migrate --seed




7. Start the development server:

    php artisan serve


7. Access the application:

Open your web browser and visit http://localhost:8000.




Option 2 Using Docker


## Installation

**Prerequisites:**

* Docker
* Docker Compose

**Steps:**

1. **Clone the repository:**

   ```bash
   git clone https://github.com/hasin0/fueltrack.git

2. Navigate to the project directory:

   cd fueltrack

3. **Build and run the Docker containers:**

   ```bash
   docker-compose up -d --build

4.Generate an application key:

    docker-compose exec app php artisan key:generate

5.Run migrations and seeders

 docker-compose exec app php artisan migrate --seed







Usage
Login: Use the default credentials provided in the seeders or create new users.
'email' => 'admin@gmail.com',
'password'=> 1111,
Manage Vehicles: Add, edit, or delete vehicle information.
Create Fuel Requests: Submit fuel requests for specific vehicles.
Approve Fuel Requests: Approve or reject fuel requests based on roles.
Track Fuel Consumption: View reports and analyze fuel usage patterns.
