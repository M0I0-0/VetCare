<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial Clínico - {{ $pet->name }}</title>
    <style>
        @page {
            margin: 1.5cm;
        }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #111827;
            font-size: 11pt;
            line-height: 1.5;
            background-color: #ffffff;
        }
        /* Header Clinic Branding */
        .clinic-header {
            width: 100%;
            border-bottom: 3px solid #0d9488;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .clinic-title {
            font-size: 26pt;
            font-weight: bold;
            color: #115e59;
            margin: 0;
            letter-spacing: -0.5px;
        }
        .clinic-subtitle {
            font-size: 10pt;
            color: #0d9488;
            margin: 3px 0 0 0;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: bold;
        }
        .doc-title {
            font-size: 14pt;
            font-weight: bold;
            color: #0f766e;
            text-align: right;
            margin: 0;
        }
        .doc-date {
            font-size: 9pt;
            color: #6b7280;
            text-align: right;
            margin: 3px 0 0 0;
        }

        /* Two Column Table Layout for Patient & Owner info */
        .dossier-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        .dossier-col {
            width: 50%;
            vertical-align: top;
        }
        .dossier-card {
            background-color: #fbfbf8;
            border: 1.5px solid #e6f4f2;
            border-radius: 12px;
            padding: 15px;
            margin-right: 10px;
        }
        .dossier-card-right {
            background-color: #fbfbf8;
            border: 1.5px solid #e6f4f2;
            border-radius: 12px;
            padding: 15px;
            margin-left: 10px;
        }
        .card-title {
            font-size: 11pt;
            font-weight: bold;
            color: #115e59;
            border-bottom: 1px solid #ccfbf1;
            padding-bottom: 6px;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .info-row {
            margin-bottom: 6px;
            font-size: 9.5pt;
        }
        .info-label {
            font-weight: bold;
            color: #4b5563;
            width: 90px;
            display: inline-block;
        }
        .info-value {
            color: #111827;
        }

        /* Section Headings */
        .section-header {
            font-size: 13pt;
            font-weight: bold;
            color: #115e59;
            border-left: 4px solid #0d9488;
            padding-left: 10px;
            margin-top: 30px;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Lists Tables */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
            border-radius: 8px;
            overflow: hidden;
        }
        .data-table th {
            background-color: #f0fdfa;
            color: #115e59;
            font-weight: bold;
            font-size: 9.5pt;
            text-align: left;
            padding: 10px 12px;
            border-bottom: 2px solid #ccfbf1;
            text-transform: uppercase;
        }
        .data-table td {
            padding: 10px 12px;
            font-size: 9.5pt;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: middle;
        }
        .data-table tr:nth-child(even) {
            background-color: #fbfbfd;
        }

        /* Consultations timeline cards in PDF */
        .record-card {
            border: 1.5px solid #e6f4f2;
            background-color: #ffffff;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 12px;
        }
        .record-meta-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            border-bottom: 1px dashed #e6f4f2;
            padding-bottom: 8px;
        }
        .record-meta-left {
            font-size: 10pt;
            font-weight: bold;
            color: #0d9488;
        }
        .record-meta-right {
            font-size: 9pt;
            color: #4b5563;
            text-align: right;
        }
        .record-body {
            font-size: 9.5pt;
        }
        .record-section-title {
            font-weight: bold;
            color: #115e59;
            margin-top: 8px;
            margin-bottom: 4px;
            font-size: 9.5pt;
        }
        .record-text {
            color: #1f2937;
            white-space: pre-wrap;
            background-color: #fafaf9;
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid #f3f4f6;
            margin-bottom: 5px;
        }
        .treatment-text {
            color: #115e59;
            font-weight: bold;
            white-space: pre-wrap;
            background-color: #f0fdfa;
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid #ccfbf1;
        }

        /* Footer */
        .footer {
            position: fixed;
            bottom: 0px;
            left: 0px;
            right: 0px;
            text-align: center;
            font-size: 8.5pt;
            color: #9ca3af;
            border-top: 1.5px solid #f3f4f6;
            padding-top: 8px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <table class="clinic-header" style="width: 100%;">
        <tr>
            <td style="vertical-align: middle;">
                <h1 class="clinic-title">🐾 VetCare</h1>
                <p class="clinic-subtitle">Sistema de Gestión Veterinaria</p>
            </td>
            <td style="vertical-align: middle; text-align: right;">
                <h2 class="doc-title">Historial Clínico Oficial</h2>
                <p class="doc-date">Fecha de Emisión: {{ date('d/m/Y H:i') }}</p>
            </td>
        </tr>
    </table>

    <!-- Dossier -->
    <table class="dossier-table">
        <tr>
            <!-- Patient dossier -->
            <td class="dossier-col">
                <div class="dossier-card">
                    <div class="card-title">Paciente (Mascota)</div>
                    <div class="info-row">
                        <span class="info-label">Nombre:</span>
                        <span class="info-value" style="font-weight: bold; color: #115e59;">{{ $pet->name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Especie:</span>
                        <span class="info-value">
                            @switch(strtolower($pet->species))
                                @case('perro') Perro 🐶 @break
                                @case('gato') Gato 🐱 @break
                                @case('conejo') Conejo 🐰 @break
                                @case('ave') Ave 🦜 @break
                                @default {{ ucfirst($pet->species) }} 🐾
                            @endswitch
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Raza:</span>
                        <span class="info-value">{{ $pet->breed }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Nacimiento:</span>
                        <span class="info-value">{{ \Carbon\Carbon::parse($pet->birthdate)->format('d/m/Y') }} ({{ \Carbon\Carbon::parse($pet->birthdate)->age }} años)</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Peso Actual:</span>
                        <span class="info-value" style="font-weight: bold; color: #0d9488;">{{ number_format($pet->weight, 2) }} kg</span>
                    </div>
                </div>
            </td>

            <!-- Owner dossier -->
            <td class="dossier-col">
                <div class="dossier-card-right">
                    <div class="card-title">Propietario / Cliente</div>
                    <div class="info-row">
                        <span class="info-label">Nombre:</span>
                        <span class="info-value" style="font-weight: bold;">👤 {{ $pet->owner->name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Email:</span>
                        <span class="info-value">{{ $pet->owner->email }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Teléfono:</span>
                        <span class="info-value">📞 {{ $pet->owner->phone }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Dirección:</span>
                        <span class="info-value">🏠 {{ $pet->owner->address }}</span>
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <!-- Inmunizaciones Cartilla -->
    <div class="section-header">Cartilla de Vacunación</div>
    @if($pet->vaccinations->count() > 0)
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 25%;">Fecha Aplicación</th>
                    <th style="width: 35%;">Vacuna</th>
                    <th style="width: 20%;">Dosis</th>
                    <th style="width: 20%;">Próx. Refuerzo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pet->vaccinations as $vaccine)
                    <tr>
                        <td>📅 {{ \Carbon\Carbon::parse($vaccine->date_applied)->format('d/m/Y') }}</td>
                        <td style="font-weight: bold; color: #115e59;">💉 {{ $vaccine->name }}</td>
                        <td>{{ $vaccine->dose }}</td>
                        <td style="color: {{ $vaccine->next_dose_due ? '#b45309' : '#6b7280' }}; font-weight: {{ $vaccine->next_dose_due ? 'bold' : 'normal' }};">
                            {{ $vaccine->next_dose_due ? '🔔 ' . \Carbon\Carbon::parse($vaccine->next_dose_due)->format('d/m/Y') : 'N/A' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="font-style: italic; color: #6b7280; font-size: 9.5pt; margin-left: 10px;">No se han registrado vacunas en la cartilla de esta mascota.</p>
    @endif

    <!-- Consultas Médicas -->
    <div class="section-header">Consultas y Diagnósticos Clínicos</div>
    @if($pet->medicalRecords->count() > 0)
        @foreach($pet->medicalRecords as $record)
            <div class="record-card">
                <table class="record-meta-table">
                    <tr>
                        <td class="record-meta-left">🩺 Consulta del {{ \Carbon\Carbon::parse($record->created_at)->format('d/m/Y H:i') }}</td>
                        <td class="record-meta-right">
                            Peso: <strong>{{ number_format($record->weight_at_visit, 2) }} kg</strong> &bull;
                            Vet: <strong>👨‍⚕️ {{ $record->veterinarian->name }}</strong>
                        </td>
                    </tr>
                </table>
                <div class="record-body">
                    <div class="record-section-title">Diagnóstico:</div>
                    <div class="record-text">{{ $record->diagnosis }}</div>
                    
                    <div class="record-section-title" style="margin-top: 8px;">Tratamiento y Medicación prescrita:</div>
                    <div class="treatment-text">{{ $record->treatment }}</div>
                </div>
            </div>
        @endforeach
    @else
        <p style="font-style: italic; color: #6b7280; font-size: 9.5pt; margin-left: 10px;">No se han registrado consultas médicas en el historial clínico de esta mascota.</p>
    @endif

    <!-- Footer -->
    <div class="footer">
        VetCare &bull; Tel: (555) 123-4567 &bull; Email: contacto@vetcare.com &bull; Documento Generado de forma Digital
    </div>

</body>
</html>
