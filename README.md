# VetCare 🐾
Plataforma Integral de Gestión Veterinaria e Inteligencia Artificial

VetCare es una plataforma web premium de gestión para clínicas veterinarias desarrollada con **Laravel 11**, **Tailwind CSS** y **Blade**. El sistema permite digitalizar por completo el funcionamiento clínico, integrando automatización de notificaciones por WhatsApp, envíos de correo con historiales clínicos en PDF y un potente **Asistente Clínico de Inteligencia Artificial (Groq)** de velocidad ultra-rápida.

---

## 🌟 Características Clave

### 1. 🧠 Asistente Clínico Inteligencia Artificial (Groq)
*   **Asistente de Diagnóstico (IA):** En los formularios de registro clínico, el veterinario puede detallar los síntomas (ej. *"Temblores y falta de apetito"*). Haciendo clic en *"Generar Sugerencias"*, la IA de Groq (`llama-3.3-70b-versatile`) analiza los datos clínicos en menos de 1 segundo y autocompleta el diagnóstico y tratamiento recomendado según la especie, raza y peso de la mascota.
*   **Explicador Empático de Recetas:** Traduce de manera automática la receta médica y terminología técnica del especialista en un mensaje de WhatsApp sumamente cálido, cariñoso y fácil de comprender para el propietario.

### 2. 💬 Notificaciones Inteligentes por WhatsApp (Green-API)
*   Integrado robustamente con **Green-API** (versión de código QR sin costes por mensaje en su plan Developer).
*   Envía automáticamente la receta del chequeo de la mascota junto con la traducción de la IA directamente al móvil del dueño tan pronto como se guarda la consulta.
*   Realiza formateos inteligentes para números internacionales de México (`521...`) asegurando que los mensajes móviles siempre se entreguen.

### 3. 📋 Gestión de Expedientes Clínicos y Cartillas
*   **Historial Clínico Digital:** Registro detallado de peso, observaciones profesionales, diagnóstico y tratamiento.
*   **Exportación PDF:** Genera de manera instantánea el historial clínico completo y profesional en formato PDF (usando DomPDF) listo para imprimir o enviar.
*   **Cartilla de Vacunación:** Registro detallado de vacunas aplicadas, dosis y programación automática de fechas de próximos refuerzos.

### 4. 📅 Agenda de Citas y Recordatorios Automáticos
*   Planificador de visitas con asignación de mascota, veterinario y motivo (consulta, vacunación, cirugía, etc.).
*   Estados de cita dinámicos codificados por colores (Pendiente, Confirmada, Completada, Cancelada).
*   **Cron Jobs de Notificación (Laravel Scheduler):**
    *   **Citas:** Envío diario automático a las 08:00 AM de recordatorios de citas próximas en las siguientes 24 horas por correo.
    *   **Vacunas:** Envío semanal automático cada lunes a las 09:00 AM de recordatorios de dosis pendientes o próximas a vencer en los siguientes 7 días.

---

## 🔐 Control de Acceso por Roles (RBAC)

El sistema cuenta con tres niveles de acceso claramente definidos:

| Módulo / Acción | Administrador | Veterinario | Recepcionista |
| :--- | :---: | :---: | :---: |
| **Panel de Personal (CRUD de Usuarios)** | Sí | No | No |
| **Ver Dueños y Mascotas** | Sí | Sí | Sí |
| **Crear/Editar Dueños y Mascotas** | Sí | No | Sí |
| **Archivar/Restaurar Mascotas** | Sí | No | No |
| **Ver Expedientes Clínicos y Citas** | Sí | Sí | Sí |
| **Crear Consultas y Registrar Vacunas** | Sí | Sí | No |
| **Programar y Cancelar Citas** | Sí | Sí | No *(Solo lectura)* |

---

## 🛠️ Requisitos de Instalación
*   **PHP 8.2+** (con extensiones OpenSSL, PDO, Mbstring, XML, GD)
*   **Composer 2.x**
*   **Node.js 20.x** y **npm**
*   **MySQL 8.x** o SQLite
*   Una cuenta activa de **Green-API** (para WhatsApp) y **Groq** (para Inteligencia Artificial)

---

## 🚀 Instalación y Configuración Paso a Paso

1.  **Clonar el repositorio y entrar a la carpeta**
    ```bash
    git clone <repo-url> vetcare
    cd vetcare
    ```
2.  **Instalar dependencias de PHP**
    ```bash
    composer install
    ```
3.  **Instalar dependencias de frontend**
    ```bash
    npm install && npm run build
    ```
4.  **Configurar archivo de entorno `.env`**
    *   Crea una copia de `.env.example` y configúrala:
        ```bash
        cp .env.example .env
        ```
    *   Edita los datos de conexión a MySQL, Servidor de Correo (Mailtrap recomendado para pruebas), y las credenciales de APIs:
        ```env
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=vetcare_db
        DB_USERNAME=root
        DB_PASSWORD=tu_contraseña

        # Green-API Configuration
        GREEN_API_TOKEN=tu_token_de_greenapi
        GREEN_API_INSTANCE_ID=tu_id_de_instancia

        # Groq AI Configuration
        GROQ_API_KEY=gsk_tu_clave_de_groq_aqui
        ```
5.  **Generar la clave de aplicación de Laravel**
    ```bash
    php artisan key:generate
    ```
6.  **Ejecutar migraciones y seeders de prueba**
    ```bash
    php artisan migrate:fresh --seed
    ```
7.  **Iniciar el servidor de desarrollo**
    ```bash
    php artisan serve
    ```
    Accede al sistema desde `http://localhost:8000`.

---

## 👤 Credenciales de Prueba (Seeders)

| Rol | Correo Electrónico | Contraseña |
| :--- | :--- | :--- |
| **Administrador** | `admin@vetcare.com` | `admin123` |
| **Veterinario** | `vet@vetcare.com` | `vet123` |
| **Recepcionista** | `recep@vetcare.com` | `recep123` |

---

## 📅 Automatización de Tareas (Cron Jobs)

Para habilitar el programador automático de recordatorios de citas y vacunas en tu servidor Linux (producción), añade la siguiente línea a tu crontab ejecutando `crontab -e`:

```cron
* * * * * cd /ruta-de-tu-proyecto-vetcare && php artisan schedule:run >> /dev/null 2>&1
```

### Ejecutar comandos de Cron manualmente en desarrollo:
*   **Enviar recordatorios de citas próximos por correo (24h de anticipación):**
    ```bash
    php artisan vetcare:send-reminders
    ```
*   **Enviar recordatorios de vacunas próximos o vencidos por correo (ventana 7 días):**
    ```bash
    php artisan vetcare:vaccine-reminders
    ```

---

## 📊 Diagrama Entidad‑Relación (ERD)

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
        int user_id FK
        decimal weight_at_visit
        text diagnosis
        text treatment
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
¡VetCare está listo para transformar la experiencia médica de tus pacientes! 🐾✨
