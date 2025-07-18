# Inspection Booking System (Laravel 12 Modular HMVC)

## Overview
A modular, multi-tenant inspection booking system built with Laravel 12, featuring:
- Modular HMVC structure (`/Modules`)
- Multi-tenancy (tenant_id scoped)
- Dynamic slot generation
- Team availability management
- Booking with conflict prevention
- API authentication (Sanctum)

---

## Setup Instructions

1. **Clone the repository:**
   ```bash
   git clone <your-repo-url>
   cd inspection-booking-system-main
   ```
2. **Install dependencies:**
   ```bash
   composer install
   ```
3. **Copy and configure `.env`:**
   ```bash
   cp .env.example .env
   # Edit .env for your DB credentials
   ```
4. **Generate app key:**
   ```bash
   php artisan key:generate
   ```
5. **Run migrations and seeders:**
   ```bash
   php artisan migrate:fresh --seed
   ```
6. **Serve the app:**
   ```bash
   php artisan serve
   ```

---

## API Usage

### **Authentication**
- `POST /api/v1/auth/register` — Register a tenant and admin user
- `POST /api/v1/auth/login` — Log in and receive a Sanctum token

### **Tenants**
- `GET /api/v1/tenant` — Get current tenant info (auth required)

### **Teams**
- `GET /api/v1/teams` — List teams
- `POST /api/v1/teams` — Create a team
- `PUT /api/v1/teams/{id}` — Update a team
- `DELETE /api/v1/teams/{id}` — Delete a team
- `POST /api/v1/teams/{id}/availability` — Set recurring weekly availability
- `GET /api/v1/teams/{id}/generate-slots?from=YYYY-MM-DD&to=YYYY-MM-DD` — Generate 1-hour slots (excluding booked)

### **Bookings**
- `GET /api/v1/bookings` — List user bookings
- `POST /api/v1/bookings` — Book a slot
- `DELETE /api/v1/bookings/{id}` — Cancel a booking

---

## Multi-Tenancy
- All data is tenant_id scoped.
- Each user belongs to a tenant; all API calls are restricted to the authenticated user's tenant.

## Dynamic Slot Generation
- Slots are generated on-the-fly based on team availability and exclude already booked times.
- No slots are stored in the database.

---

## Running Tests
```bash
php artisan test
```
(Feature tests are recommended for all endpoints.)

---

## Notes
- Modular structure: All business logic, models, controllers, and routes are in `/Modules`.
- API Resources are used for all responses.
- Seeders provide demo tenants, users, teams, availabilities, and bookings.

---

## (Optional) API Documentation
- You can use Postman or Swagger to document and test the API.

---

## License
MIT
