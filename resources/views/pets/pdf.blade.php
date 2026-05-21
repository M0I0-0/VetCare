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
            color: #1e293b;
            font-size: 11pt;
            line-height: 1.5;
        }
        /* Header Clinic Branding */
        .clinic-header {
            width: 100%;
            border-bottom: 2px solid #10b981;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .clinic-title {
            font-size: 24pt;
            font-weight: bold;
            color: #0f172a;
            margin: 0;
        }
        .clinic-subtitle {
            font-size: 10pt;
            color: #64748b;
            margin: 3px 0 0 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .doc-title {
            font-size: 14pt;
            font-weight: bold;
            color: #059669;
            text-align: right;
            margin: 0;
        }
        .doc-date {
            font-size: 9pt;
            color: #64748b;
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
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 15px;
            margin-right: 10px;
        }
        .dossier-card-right {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 15px;
            margin-left: 10px;
        }
        .card-title {
            font-size: 11pt;
            font-weight: bold;
            color: #0f172a;
            border-bottom: 1px solid #cbd5e1;
            padding-bottom: 5px;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .info-row {
            margin-bottom: 6px;
            font-size: 9.5pt;
        }
        .info-label {
            font-weight: bold;
            color: #475569;
            width: 90px;
            display: inline-block;
        }
        .info-value {
            color: #0f172a;
        }

        /* Section Headings */
        .section-header {
            font-size: 13pt;
            font-weight: bold;
            color: #0f172a;
            border-left: 4px solid #10b981;
            padding-left: 8px;
            margin-top: 25px;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Lists Tables */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .data-table th {
            background-color: #f1f5f9;
            color: #475569;
            font-weight: bold;
            font-size: 9pt;
            text-align: left;
            padding: 8px 10px;
            border-bottom: 2px solid #cbd5e1;
            text-transform: uppercase;
        }
        .data-table td {
            padding: 10px;
            font-size: 9.5pt;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: top;
        }
        .data-table tr:nth-child(even) {
            background-color: #f8fafc;
        }

        /* Consultations timeline cards in PDF */
        .record-card {
            border: 1px solid #e2e8f0;
            background-color: #ffffff;
            padding: 12px 15px;
            margin-bottom: 12px;
            border-radius: 6px;
        }
        .record-meta-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
            border-bottom: 1px dashed #e2e8f0;
            padding-bottom: 5px;
        }
        .record-meta-left {
            font-size: 9.5pt;
            font-weight: bold;
            color: #059669;
        }
        .record-meta-right {
            font-size: 9pt;
            color: #64748b;
            text-align: right;
        }
        .record-body {
            font-size: 9.5pt;
            margin-top: 5px;
        }
        .record-section-title {
            font-weight: bold;
            color: #475569;
            margin-top: 4px;
            margin-bottom: 2px;
        }
        .record-text {
            color: #0f172a;
            white-space: pre-wrap;
        }

        /* Footer */
        .footer {
            position: fixed;
            bottom: 0px;
            left: 0px;
            right: 0px;
            text-align: center;
            font-size: 8pt;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
            padding-top: 5px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <table class="clinic-header" style="width: 100%;">
        <tr>
            <td style="vertical-align: middle;">
                <h1 class="clinic-title">VetCare</h1>
                <p class="clinic-subtitle">Sistema de Gestión Veterinaria</p>
            </td>
            <td style="vertical-align: middle; text-align: right;">
                <h2 class="doc-title">Historial Clínico Digital</h2>
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
                        <span class="info-value" style="font-weight: bold;">{{ $pet->name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Especie:</span>
                        <span class="info-value">{{ ucfirst($pet->species) }}</span>
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
                        <span class="info-value" style="font-weight: bold; color: #059669;">{{ number_format($pet->weight, 2) }} kg</span>
                    </div>
                </div>
            </td>

            <!-- Owner dossier -->
            <td class="dossier-col">
                <div class="dossier-card-right">
                    <div class="card-title">Propietario / Cliente</div>
                    <div class="info-row">
                        <span class="info-label">Nombre:</span>
                        <span class="info-value" style="font-weight: bold;">{{ $pet->owner->name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Email:</span>
                        <span class="info-value">{{ $pet->owner->email }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Teléfono:</span>
                        <span class="info-value">{{ $pet->owner->phone }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Dirección:</span>
                        <span class="info-value">{{ $pet->owner->address }}</span>
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
                        <td>{{ \Carbon\Carbon::parse($vaccine->date_applied)->format('d/m/Y') }}</td>
                        <td style="font-weight: bold; color: #0f172a;">{{ $vaccine->name }}</td>
                        <td>{{ $vaccine->dose }}</td>
                        <td style="color: {{ $vaccine->next_dose_due ? '#d97706' : '#64748b' }}; font-weight: {{ $vaccine->next_dose_due ? 'bold' : 'normal' }};">
                            {{ $vaccine->next_dose_due ? \Carbon\Carbon::parse($vaccine->next_dose_due)->format('d/m/Y') : 'N/A' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="font-style: italic; color: #64748b; font-size: 9.5pt; margin-left: 10px;">No se han registrado vacunas en la cartilla de esta mascota.</p>
    @endif

    <!-- Consultas Médicas -->
    <div class="section-header">Consultas y Diagnósticos Clínicos</div>
    @if($pet->medicalRecords->count() > 0)
        @foreach($pet->medicalRecords as $record)
            <div class="record-card">
                <table class="record-meta-table">
                    <tr>
                        <td class="record-meta-left">Consulta del {{ \Carbon\Carbon::parse($record->created_at)->format('d/m/Y H:i') }}</td>
                        <td class="record-meta-right">
                            Peso: <strong>{{ number_format($record->weight_at_visit, 2) }} kg</strong> &bull;
                            Vet: <strong>{{ $record->veterinarian->name }}</strong>
                        </td>
                    </tr>
                </table>
                <div class="record-body">
                    <div class="record-section-title">Diagnóstico:</div>
                    <div class="record-text">{{ $record->diagnosis }}</div>
                    
                    <div class="record-section-title" style="margin-top: 8px;">Tratamiento y Medicación:</div>
                    <div class="record-text" style="color: #0369a1; font-weight: bold;">{{ $record->treatment }}</div>
                </div>
            </div>
        @endforeach
    @else
        <p style="font-style: italic; color: #64748b; font-size: 9.5pt; margin-left: 10px;">No se han registrado consultas médicas en el historial clínico de esta mascota.</p>
    @endif

    <!-- Footer -->
    <div class="footer">
        VetCare &bull; Tel: (555) 123-4567 &bull; Email: contacto@vetcare.com &bull; Historial Clínico Oficial
    </div>

</body>
</html>
