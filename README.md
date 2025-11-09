# Employee & Department Management API

A secure, token-protected REST API built with **Laravel 10** to manage departments and employees.  
Supports **CRUD operations**, multiple contact numbers & addresses for employees, **ownership-based access**, encrypted IDs, pagination, caching, and token-based authentication using **Laravel Sanctum**.

---

## 🏗️ Project Overview

- Each **employee** belongs to one **department**.
- Each employee can have **multiple contact numbers** and **multiple addresses**.
- Only the **user who created an employee** can update or delete it.
- All IDs exposed in responses are **encrypted using a salt** for security.
- API responses are optimized: **only required columns**, eager-loaded relationships, pagination, and caching.
- Tokens have **expiry** and are validated on every request.

---

## 🛠️ Features

- **Authentication**
  - User registration
  - Login with Sanctum token & expiry (24h default)
  - Logout (revokes token)
- **Departments**
  - Create, read, update, delete
  - Paginated list with caching
  - ID encryption in responses
- **Employees**
  - Create, read, update, delete (ownership-based)
  - Multiple contacts and addresses
  - Search & filter by name, email, contact, department
  - Paginated results
  - ID encryption in responses
  - Optimized queries with eager loading
- **Security**
  - Token expiry validation middleware
  - Encrypted IDs
  - Password hashing with `Hash::make`
  - Ownership enforcement
  - Error handling & sanitized API responses
  - Optional rate-limiting for login endpoints
- **Performance**
  - Caching for lists
  - Optimized database queries
  - Indexes for search-heavy columns
  - Pagination

---

## ⚡ Tech Stack

- **Backend:** Laravel 10 (PHP 8+)
- **Authentication:** Laravel Sanctum
- **Database:** MySQL / MariaDB
- **Caching:** Laravel Cache (Redis recommended in production)
- **Version Control:** GitHub (commit history tracked)
- **Optional Testing:** PHPUnit / Pest

---

## 📦 Project Structure

    app/
    ├── Http/
    │ ├── Controllers/Api/
    │ │ ├── AuthController.php
    │ │ ├── DepartmentController.php
    │ │ └── EmployeeController.php
    │ └── Middleware/EnsureTokenNotExpired.php
    ├── Models/
    │ ├── Department.php
    │ ├── Employee.php
    │ ├── EmployeeContact.php
    │ ├── EmployeeAddress.php
    │ └── User.php
    ├── Requests/
    │ ├── StoreDepartmentRequest.php
    │ ├── StoreEmployeeRequest.php
    │ └── UpdateEmployeeRequest.php
    └── Services/
    └── IdEncrypter.php
    database/
    ├── migrations/
    └── seeders/
    routes/
    └── api.php

## Inside The Applications dbCollection, there is a database file and postman collection is present for refference or use


## ⚙️ Setup & Installation

1. **Clone repository:**
    git clone https://github.com/Pandey-Narendra/employee-management-api.git
    cd employee-management-api

2. **Install dependencies:**
    composer install

3. **Copy .env file and set database & salt:**
    cp .env.example .env

4. **Generate app key:**
    php artisan key:generate

5. **Run migrations & seeders:**
    php artisan migrate --seed

6. **Serve the application:**
    php artisan serve

## For Testing Seed file create everythings, use credential for login to get Token if not registered
   email: test@gmail.com
   password: test@123

# Testing In Postman
    The Seed File would create dummy User For Testing, Employee records with Contact and Address for that User and Departments 

##    API Endpoints

#    All endpoints are under:
        https://your-domain.com/api/


#    All protected endpoints require:
        Authorization: Bearer {sanctum_token}

    IDs are short encrypted strings generated with Hashids.

##    Auth APIs

#    1. Register User

    Endpoint: POST /auth/register

    Headers:

    Content-Type: application/json


    Body:

    {
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
    }


    Response (201 Created):

    {
    "status": true,
    "message": "User registered successfully, please login.",
    "user": {
        "name": "John Doe",
        "email": "john@example.com"
    }
    }


    Error (422 Validation Error):

    {
    "status": false,
    "errors": {
        "email": ["The email has already been taken."]
    }
    }

#    2. Login User

    Endpoint: POST /auth/login

    Headers:

    Content-Type: application/json


    Body:

    {
    "email": "john@example.com",
    "password": "password123"
    }


    Response (200 OK):

    {
    "status": true,
    "message": "Login successful.",
    "token": "YOUR_SANCTUM_TOKEN",
    "token_type": "Bearer",
    "user": {
        "name": "John Doe",
        "email": "john@example.com"
    }
    }


    Error (401 Invalid credentials):

    {
    "status": false,
    "message": "Invalid credentials."
    }

#    3. Logout User

    Endpoint: POST /auth/logout

    Headers:

    Authorization: Bearer YOUR_SANCTUM_TOKEN


    Response (200 OK):

    {
    "status": true,
    "message": "Logged out successfully."
    }

##    Departments APIs

    All department routes require authentication (Bearer token).

#    1. List Departments

    Endpoint: GET /departments

    Query Params (optional):

    per_page=15
    page=1


    Headers:

    Authorization: Bearer YOUR_SANCTUM_TOKEN


    Response (200 OK):

    {
    "status": true,
    "data": {
        "current_page": 1,
        "data": [
        {
            "id": "ENCRYPTED_ID",
            "name": "IT"
        },
        {
            "id": "ENCRYPTED_ID",
            "name": "HR"
        }
        ],
        "per_page": 15,
        "total": 2
    }
    }

#    2. Create Department

    Endpoint: POST /departments

    Headers:

    Authorization: Bearer YOUR_SANCTUM_TOKEN
    Content-Type: application/json


    Body:

    {
    "name": "Finance"
    }


    Response (201 Created):

    {
    "status": true,
    "data": {
        "id": "ENCRYPTED_ID",
        "name": "Finance"
    }
    }

#    3. Show Department

    Endpoint: GET /departments/{id}

    Headers:

    Authorization: Bearer YOUR_SANCTUM_TOKEN


    Response (200 OK):

    {
    "status": true,
    "data": {
        "id": "ENCRYPTED_ID",
        "name": "Finance"
    }
    }


    Error (404 Not Found):

    {
    "status": false,
    "message": "Department not found."
    }

#    4. Update Department

    Endpoint: PUT /departments/{id}

    Headers:

    Authorization: Bearer YOUR_SANCTUM_TOKEN
    Content-Type: application/json


    Body:

    {
    "name": "Marketing"
    }


    Response (200 OK):

    {
    "status": true,
    "data": {
        "id": "ENCRYPTED_ID",
        "name": "Marketing"
    }
    }

#    5. Delete Department

    Endpoint: DELETE /departments/{id}

    Headers:

    Authorization: Bearer YOUR_SANCTUM_TOKEN


    Response (200 OK):

    {
    "status": true,
    "message": "Department deleted."
    }

##    Employees APIs

    All employee routes require authentication (Bearer token).

#    1. List Employees

    Endpoint: GET /employees

    Query Params (optional):

    per_page=15
    page=1
    search=John
    department_id=ENCRYPTED_DEPARTMENT_ID


    Headers:

    Authorization: Bearer YOUR_SANCTUM_TOKEN


    Response (200 OK):

    {
    "status": true,
    "data": {
        "current_page": 1,
        "data": [
        {
            "id": "ENCRYPTED_ID",
            "first_name": "John",
            "last_name": "Doe",
            "email": "john@example.com",
            "department": {
            "id": "ENCRYPTED_ID",
            "name": "IT"
            },
            "created_at": "2025-11-09T10:00:00.000000Z"
        }
        ],
        "per_page": 15,
        "total": 1
    }
    }

#    2. Create Employee

    Endpoint: POST /employees

    Headers:

    Authorization: Bearer YOUR_SANCTUM_TOKEN
    Content-Type: application/json


    Body:

    {
    "first_name": "John",
    "last_name": "Doe",
    "email": "john@example.com",
    "department_id": "ENCRYPTED_DEPARTMENT_ID",
    "contacts": ["1234567890", "9876543210"],
    "addresses": [
        {
        "address_line": "123 Street",
        "city": "City",
        "state": "State",
        "pincode": "123456"
        }
    ]
    }


    Response (201 Created):

    {
    "status": true,
    "data": {
        "id": "ENCRYPTED_ID",
        "first_name": "John",
        "last_name": "Doe",
        "email": "john@example.com"
    }
    }

#    3. Show Employee

    Endpoint: GET /employees/{id}

    Headers:

    Authorization: Bearer YOUR_SANCTUM_TOKEN


    Response (200 OK):

    {
    "status": true,
    "data": {
        "id": "ENCRYPTED_ID",
        "first_name": "John",
        "last_name": "Doe",
        "email": "john@example.com",
        "department": {
        "id": "ENCRYPTED_ID",
        "name": "IT"
        },
        "contacts": ["1234567890", "9876543210"],
        "addresses": [
        {
            "address_line": "123 Street",
            "city": "City",
            "state": "State",
            "pincode": "123456"
        }
        ],
        "created_at": "2025-11-09T10:00:00.000000Z"
    }
    }

#    4. Update Employee

    Endpoint: PUT /employees/{id}

    Headers:

    Authorization: Bearer YOUR_SANCTUM_TOKEN
    Content-Type: application/json


    Body (any field optional):

    {
    "first_name": "Johnny",
    "last_name": "Doe",
    "email": "johnny@example.com",
    "department_id": "ENCRYPTED_DEPARTMENT_ID",
    "contacts": ["1112223333"],
    "addresses": [
        {
        "address_line": "456 New Street",
        "city": "New City",
        "state": "New State",
        "pincode": "654321"
        }
    ]
    }


    Response (200 OK):

    {
    "status": true,
    "data": {
        "id": "ENCRYPTED_ID",
        "first_name": "Johnny",
        "last_name": "Doe",
        "email": "johnny@example.com"
    }
    }

#    5. Delete Employee

    Endpoint: DELETE /employees/{id}

    Headers:

    Authorization: Bearer YOUR_SANCTUM_TOKEN


    Response (200 OK):

    {
    "status": true,
    "message": "Employee deleted."
    }
