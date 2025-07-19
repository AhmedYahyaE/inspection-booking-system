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

## Technical Laravel Features Used

This application leverages several advanced Laravel features:

- **API Resource Classes**: All API responses use Laravel API Resources for consistent, transformable output.
- **Eloquent Relationships**: Models use `belongsTo`, `hasMany`, and custom scopes for tenant and team logic.
- **Form Request Validation**: All input is validated using Laravel's validation system for security and data integrity.
- **Sanctum Authentication**: API authentication is handled via Laravel Sanctum for SPA/mobile-friendly token auth.
- **Modular HMVC Structure**: Business logic, models, controllers, and routes are organized in `/Modules` for separation of concerns and scalability.
- **Seeders & Factories**: Database seeding and factories are used for demo data and testing.
- **Custom Services & Repositories**: Service and repository patterns are used for business logic abstraction.
- **Conflict Detection Logic**: Booking logic includes conflict detection using Eloquent queries.
- **Route Model Binding**: Used for cleaner controller methods and automatic model resolution.
- **API Versioning**: Endpoints are versioned (e.g., `/api/v1/`) for future-proofing.
- **Unit & Feature Testing**: Includes tests for booking logic and API endpoints.

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
(Feature and unit tests are included for booking creation and conflict logic.)

---

## API Testing with Postman
- Download the ready-to-use Postman collection: [InspectionBookingSystem.postman_collection.json](./InspectionBookingSystem.postman_collection.json)
- Import it into Postman, set your `base_url` and `token` variables, and test all endpoints easily.
- All requests include the correct headers and inherit Bearer token authentication from the collection.

---

## Notes
- Modular structure: All business logic, models, controllers, and routes are in `/Modules`.
- API Resources are used for all responses.
- Seeders provide demo tenants, users, teams, availabilities, and bookings.
