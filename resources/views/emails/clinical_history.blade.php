<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial Clínico Completo — VetCare</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f5f3ff;
            color: #1f2937;
            padding: 32px 16px;
        }
        .wrapper {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(139, 92, 246, 0.12);
        }
        .header {
            background: linear-gradient(135deg, #6d28d9 0%, #8b5cf6 100%);
            padding: 40px 32px;
            text-align: center;
        }
        .header h1 {
            color: #ffffff;
            font-size: 26px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }
        .header .icon {
            font-size: 48px;
            margin-bottom: 12px;
        }
        .header p {
            color: #ddd6fe;
            font-size: 14px;
            margin-top: 6px;
        }
        .body {
            padding: 36px 32px;
        }
        .greeting {
            font-size: 18px;
            font-weight: 700;
            color: #4c1d95;
            margin-bottom: 12px;
        }
        .intro {
            font-size: 14px;
            color: #374151;
            line-height: 1.7;
            margin-bottom: 28px;
        }
        .card {
            background: #f5f3ff;
            border: 1px solid #ddd6fe;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 28px;
        }
        .card-title {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #7c3aed;
            margin-bottom: 16px;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #ddd6fe;
            font-size: 14px;
        }
        .detail-row:last-child { border-bottom: none; }
        .detail-label { color: #6b7280; font-weight: 500; }
        .detail-value { color: #111827; font-weight: 700; }
        .footer-text {
            font-size: 13px;
            color: #6b7280;
            line-height: 1.7;
            margin-bottom: 8px;
        }
        .footer {
            background: #f9fafb;
            padding: 20px 32px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
            font-size: 12px;
            color: #9ca3af;
        }
        .footer strong { color: #7c3aed; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <div class="icon-circle" style="display:inline-block; border: 3px solid #ffffff; border-radius: 50%; width: 64px; height: 64px; line-height: 58px; font-size: 32px; font-weight: 800; color: #ffffff; margin-bottom: 12px;">H</div>
            <h1>VetCare</h1>
            <p>Historial Clínico Completo</p>
        </div>

        <div class="body">
            <p class="greeting">
                ¡Hola, {{ $pet->owner->name ?? 'Estimado propietario' }}!
            </p>
            <p class="intro">
                Le enviamos adjunto en formato PDF el historial clínico completo de su mascota <strong>{{ $pet->name }}</strong>. 
                En este documento podrá encontrar el detalle de todas sus consultas médicas, diagnósticos, tratamientos y vacunas aplicadas hasta la fecha.
            </p>

            <div class="card">
                <div class="card-title">Resumen del Paciente</div>
                <div class="detail-row">
                    <span class="detail-label">Nombre</span>
                    <span class="detail-value">{{ $pet->name }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Especie / Raza</span>
                    <span class="detail-value">{{ ucfirst($pet->species) }} / {{ $pet->breed }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Edad</span>
                    <span class="detail-value">
                        {{ \Carbon\Carbon::parse($pet->birthdate)->age }} años 
                        ({{ \Carbon\Carbon::parse($pet->birthdate)->format('d/m/Y') }})
                    </span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Último Peso Registrado</span>
                    <span class="detail-value">{{ $pet->weight }} kg</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Propietario</span>
                    <span class="detail-value">{{ $pet->owner->name }}</span>
                </div>
            </div>

            <p class="footer-text">
                Mantener al día el historial de su mascota es de suma importancia para asegurar que reciba un tratamiento óptimo en todo momento.
            </p>
            <p class="footer-text">
                Si tiene alguna consulta técnica o necesita agendar un nuevo chequeo, no dude en contactarnos.
            </p>
            <p class="footer-text">
                ¡Gracias por confiar en <strong style="color:#7c3aed">VetCare</strong> para la salud de su mascota!
            </p>
        </div>

        <div class="footer">
            <strong>VetCare</strong> — Sistema de Gestión Veterinaria<br>
            Este es un correo automático, por favor no responda a esta dirección.
        </div>
    </div>
</body>
</html>
