# Flat-Bill-System

A multi-tenant system to manage buildings, flats, and bills. The system supports multiple house owners, each owning one or more buildings, and allows Admins to manage tenants across all buildings.

---

## Features

- **Multi-tenant support:** Manage multiple buildings and flats for different house owners.
- **Tenant management:** Create, update, and delete tenants.
- **Bill management:** Create bills, track due amounts, and record payments.
- **Payment management:** Record payments for bills and automatically update bill status.
- **Email notifications:** Notify house owners when a bill is created or paid.
- **Role-based access:**
  - **Super Admin:** Can view all buildings, flats, tenants, bills, and payments.
  - **House Owner:** Can manage their own buildings, flats, tenants, and bills.

---

## Tech Stack

- **Backend:** Laravel 12
- **Frontend:** Blade (with Tailwind CSS)
- **Database:** MySQL
- **Email:** Mailtrap for development/testing
- **Queue:** Laravel queues for email notifications

---

## Installation

1. **Clone the repository**

```bash
1. git clone https://github.com/furiousnur/Flat-Bill-System.git
2. cd Flat-Bill-System
3. composer install
4. npm install
5. npm run dev
6. cp .env.example .env
7. php artisan key:generate
8. **Set up database credentials:**
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=flat_bill_system
DB_USERNAME=root
DB_PASSWORD=

9. php artisan migrate --seed
10. php artisan serve
11. npm run dev
12. php artisan queue:work

3. **Set up database credentials:**
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=no-reply@example.com
MAIL_FROM_NAME="Flat Bill System"


**Usage
Access the system at http://localhost:8000.
Super Admin can manage all buildings, flats, tenants, bills, and payments.
House Owners can manage only their own resources.
Email notifications are sent to house owners when a bill is created or paid.

**Project Structure**
app/
 ├─ Http/
 │   ├─ Controllers/
 │   │   ├─ Owner/
 │   │   └─ Admin/
 │   └─ Requests/
 ├─ Models/
 ├─ Repositories/
 ├─ Mail/
 └─ Notifications/
database/
 ├─ migrations/
 └─ seeders/
resources/
 ├─ views/
 │   ├─ emails/
 │   └─ admin/
 └─ css/


**User Credentials 
1. House Owner: Email - houseowner@example.com, Password: password
2. Supper Admin: Email - admin@example.com, Password: password
