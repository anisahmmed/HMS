<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Appointments - {{ $doctor->user->name }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #2563eb;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .hospital-name {
            font-size: 24px;
            font-weight: bold;
            color: #2563eb;
            margin-bottom: 5px;
        }
        .report-title {
            font-size: 18px;
            color: #666;
            margin-bottom: 10px;
        }
        .doctor-info {
            background-color: #f8fafc;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .doctor-name {
            font-size: 20px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 5px;
        }
        .doctor-details {
            color: #6b7280;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #e5e7eb;
            padding: 10px;
            text-align: left;
            font-size: 12px;
        }
        th {
            background-color: #f9fafb;
            font-weight: bold;
            color: #374151;
        }
        tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .serial-number {
            font-weight: bold;
            color: #2563eb;
        }
        .status {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-scheduled { background-color: #fef3c7; color: #92400e; }
        .status-confirmed { background-color: #d1fae5; color: #065f46; }
        .status-completed { background-color: #dbeafe; color: #1e40af; }
        .status-cancelled { background-color: #fee2e2; color: #991b1b; }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            font-size: 10px;
            color: #9ca3af;
        }
        .summary {
            background-color: #f8fafc;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-around;
        }
        .summary-item {
            text-align: center;
        }
        .summary-number {
            font-size: 24px;
            font-weight: bold;
            color: #2563eb;
        }
        .summary-label {
            font-size: 12px;
            color: #6b7280;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="hospital-name">Hospital Management System</div>
        <div class="report-title">Doctor Appointments Report</div>
        <div>Generated on: {{ now()->format('F j, Y \a\t g:i A') }}</div>
    </div>

    <div class="doctor-info">
        <div class="doctor-name">{{ $doctor->user->name }}</div>
        <div class="doctor-details">
            Specialization: {{ $doctor->specialization }} |
            BMDC Number: {{ $doctor->bmdc_registration_number }} |
            Experience: {{ $doctor->experience_years ?? 'N/A' }} years
        </div>
    </div>

    <div class="summary">
        <div class="summary-item">
            <div class="summary-number">{{ $appointments->count() }}</div>
            <div class="summary-label">Total Appointments</div>
        </div>
        <div class="summary-item">
            <div class="summary-number">{{ $appointments->where('status', 'scheduled')->count() }}</div>
            <div class="summary-label">Scheduled</div>
        </div>
        <div class="summary-item">
            <div class="summary-number">{{ $appointments->where('status', 'confirmed')->count() }}</div>
            <div class="summary-label">Confirmed</div>
        </div>
        <div class="summary-item">
            <div class="summary-number">{{ $appointments->where('status', 'completed')->count() }}</div>
            <div class="summary-label">Completed</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Serial #</th>
                <th>Patient Name</th>
                <th>Hospital ID</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Phone</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @forelse($appointments as $appointment)
            <tr>
                <td>
                    <span class="serial-number">{{ $appointment->serial_number }}</span>
                </td>
                <td>{{ $appointment->patient->user->name }}</td>
                <td>{{ $appointment->patient->hospital_id }}</td>
                <td>{{ \Carbon\Carbon::parse($appointment->date)->format('M j, Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($appointment->time)->format('g:i A') }}</td>
                <td>
                    <span class="status status-{{ $appointment->status }}">
                        {{ ucfirst($appointment->status) }}
                    </span>
                </td>
                <td>{{ $appointment->patient->user->phone ?? 'N/A' }}</td>
                <td>{{ $appointment->notes ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align: center; color: #9ca3af;">
                    No appointments found for this doctor.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>This report was generated automatically by the Hospital Management System.</p>
        <p>Confidential medical information - For authorized personnel only.</p>
    </div>
</body>
</html>