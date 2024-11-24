# Event Management System
A simple web application for managing events. The system allows users to view and RSVP for events, while administrators can create, edit, and delete events. The system includes user management functionality for assigning roles such as "admin" and "user".


----------

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Clone the repository

    git clone https://github.com/issamox/Event-Management-System.git

Switch to the repo folder

    cd Event-Management-System

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate


Run the database seeder

    php artisan migrate

Run the database migrations  (**Set the database connection in .env before migrating**)

    php artisan db:seed

Install all the frontend Dependencies

    npm install

Compile the front-end assets

    npm run dev

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000


## Features

- **User Authentication**: Users can sign up, log in, and manage their profiles.
- **Role-based Access Control**: Different access levels for users (admin and normal users).
- **Event Management**: Admin users can create, edit, and delete events.
- **RSVP for Events**: Users can view events and make reservations (RSVP).
- **Event Sorting & Filtering**: Events can be sorted by date and location.
- **User Management**: Admin users can manage other users.

## Role-based Access Control
- **Admins** can create, edit, delete events, and manage users.
- **Users** can only view events and make reservations.

## Routes
- **/dashboard** - Admin and user dashboard
- **/events** - Event list (users can view and RSVP, admins can manage)
- **/users** - User management (admin only)
- **/profile** - User profile settings


