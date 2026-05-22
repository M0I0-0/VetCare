# VetCare 🐾

## Descripción del sistema
VetCare es una plataforma web de gestión veterinaria desarrollada con **Laravel 11**. Permite registrar dueños y sus mascotas, manejar historiales clínicos, vacunas, programar citas, enviar recordatorios automáticos por email y generar PDF de informes. La UI está construida con **Blade** y **Tailwind CSS**, ofreciendo una experiencia premium y responsive.

---

## Requisitos
- PHP 8.2+ (con extensiones OpenSSL, PDO, Mbstring, etc.)
- Composer 2.x
- Node.js 20.x y npm 10.x
- MySQL 8.x (base de datos: `vetcare_db`)
- Mailtrap (para pruebas de envío de email)

---

## Instalación paso a paso
1. **Clonar el repositorio**
   ```bash
   git clone <repo-url> vetcare
   cd vetcare
   ```
2. **Instalar dependencias de PHP**
   ```bash
   composer install
   ```
3. **Instalar dependencias de frontend**
   ```bash
   npm install && npm run build
   ```
4. **Configurar el archivo `.env`**
   - Copiar el ejemplo y ajustar la conexión a MySQL:
     ```bash
     cp .env.example .env
     ```
   - Editar los valores:
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=vetcare_db
     DB_USERNAME=root
     DB_PASSWORD=your_password

     MAIL_MAILER=smtp
     MAIL_HOST=sandbox.smtp.mailtrap.io
     MAIL_PORT=2525
     MAIL_USERNAME=your_mailtrap_username
     MAIL_PASSWORD=your_mailtrap_password
     MAIL_FROM_ADDRESS="noreply@vetcare.com"
     MAIL_FROM_NAME="VetCare Sistema"
     ```
5. **Generar la clave de aplicación**
   ```bash
   php artisan key:generate
   ```
6. **Ejecutar migraciones y seeders**
   ```bash
   php artisan migrate:fresh --seed
   ```
7. **Levantar el servidor de desarrollo**
   ```bash
   php artisan serve
   ```
   Acceder a `http://localhost:8000`.

---

## Credenciales de prueba (Seeder)
| Rol | Email | Contraseña |
|-----|---------------------|------------|
| **Admin** | `admin@vetcare.com` | `admin123` |
| **Veterinario** | `vet@vetcare.com` | `vet123` |
| **Recepcionista** | `recep@vetcare.com` | `recep123` |

---

## Activación del Cron (Scheduler)
Para que los recordatorios de citas y vacunas se envíen automáticamente, habilite el scheduler de Laravel en el crontab del servidor:
```cron
* * * * * cd /ruta/a/tu/proyecto && php artisan schedule:run >> /dev/null 2>&1
```
- **Citas**: se envían diariamente a las 08:00 AM (`vetcare:send-reminders`).
- **Vacunas**: se envían cada lunes a las 09:00 AM (`vetcare:vaccine-reminders`).

---

## Diagrama Entidad‑Relación (ERD)
```mermaid
---
  title VetCare ER Diagram
  erDiagram
    USER {
        int id PK
        string name
        string email
        enum role "admin|veterinario|recepcionista"
    }
    OWNER {
        int id PK
        string name
        string email
        string phone
        string address
    }
    PET {
        int id PK
        int owner_id FK
        string name
        string species
        string breed
        date birthdate
        decimal weight
        string photo
        datetime deleted_at
    }
    APPOINTMENT {
        int id PK
        int pet_id FK
        int user_id FK
        datetime scheduled_at
        enum reason "consulta_general|vacunacion|revision_post_operatoria|otro"
        text notes
        enum status "pendiente|confirmada|completada|cancelada"
        bool reminder_sent
    }
    MEDICAL_RECORD {
        int id PK
        int pet_id FK
        text description
        date record_date
    }
    VACCINATION {
        int id PK
        int pet_id FK
        string name
        string dose
        date date_applied
        date next_dose_due
    }
    NOTIFICATION_LOG {
        int id PK
        int appointment_id FK
        string type "reminder|confirmation"
        string recipient_email
        enum status "sent|failed"
        text notes
        datetime sent_at
    }
    USER ||--o{ APPOINTMENT : "crea"
    PET ||--o{ APPOINTMENT : "tiene"
    OWNER ||--o{ PET : "posee"
    PET ||--o{ MEDICAL_RECORD : "tiene"
    PET ||--o{ VACCINATION : "tiene"
    APPOINTMENT ||--o{ NOTIFICATION_LOG : "genera"
```
---

## `.gitignore`
El archivo ya incluye las exclusiones recomendadas (`.env`, `vendor/`, `node_modules/`, `storage/logs/`, etc.).

---

¡Todo listo! 🎉
