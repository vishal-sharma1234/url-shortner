# URL Shortener – Laravel Assignment

This project is a role-based URL Shortener system built using **Laravel 12**.

## Features

- Laravel Breeze authentication
- Roles: SuperAdmin, Admin, Member
- Invitation-based user onboarding
- Role-based dashboard access
- Secure (non-public) short URL resolution
- MySQL support
- Pest

---

## Requirements

- PHP 8.1+
- Composer
- MySQL
- Node.js (optional, for UI)

## using seeder create superadmin

- Email:- superadmin@example.com
- Password:- superadmin@123

## Flow of Assignment

### 1. Authentication

Users can register and login with roles:

- Super Admin
- Admin
- Member

### 2. Company Invitation

Super Admin sends invitation to Client (company) using email.

### 3. Member Invitation

Client (Company) Admin invites members who are linked with same client.

### 4. URL Shortening

User enters long URL.
System generates a short code.
Data is stored in database.

#### Note

- Only Admin and Member can generate urls Super admin can not generate urls

### 5. Short URL Redirection

When user opens:
http://localhost:8000/s/{code}

System:

- Finds original URL
- Increases hit count
- Redirects to original URL

### 6. Dashboard

DataTables show:

- Total URLs
- Total Hits
- Users & Clients(Companies)

## Technologies

- Laravel
- MySQL
- Yajra DataTables
- Spatie Roles
- Bootstrap

## Preview

    - Super Admin invite client via email
        - Admin login via same client email And he can invite user with specipic role 'Admin' or 'Member'
           - Admin and Member can be generate urls

    - Show data in table can be download as pdf formate

---

## Local Setup Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/vishal-sharma1234/url-shortner.git
cd url-shortner


```
