<h2 style="color: #00993c; text-align: left; margin-bottom: 10px;">Equipment Details</h2>
<table align="left" cellspacing="0" cellpadding="8" border="1" style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr style="background-color: #00993c; color: white;">
            <th width="40" style="background-color: #00993c; color: white;">Name</th>
            <th width="40" style="background-color: #00993c; color: white;">Serial Number</th>
            <th width="40" style="background-color: #00993c; color: white;">Stock</th>
            <th width="40" style="background-color: #00993c; color: white;">Status</th>
            <th width="40" style="background-color: #00993c; color: white;">Location</th>
            <th width="40" style="background-color: #00993c; color: white;">Last Updated</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td align="left" width="40">{{ $equipment->name }}</td>
            <td align="left" width="40">{{ $equipment->serial_number }}</td>
            <td align="center" width="40">{{ $equipment->stock }}</td>
            <td align="center" width="40">{{ $equipment->status }}</td>
            <td align="left" width="40">{{ $equipment->location ?? 'N/A' }}</td>
            <td align="center" width="40">
                {{ $equipment->updated_at ? $equipment->updated_at->format('F j, Y h:i A') : 'N/A' }}
            </td>
        </tr>
    </tbody>
</table>

<!-- Stock Logs -->
@if ($equipment->stocksLogs->isNotEmpty())
    <h3 style="color: #b45309; margin-top: 20px;">Stock Logs</h3>
    <table align="left" cellspacing="0" cellpadding="8" border="1" style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr style="background-color: #b45309; color: white;">
                <th width="40" style="background-color: #b45309; color: white;">Change Type</th>
                <th width="40" style="background-color: #b45309; color: white;">Quantity</th>
                <th width="40" style="background-color: #b45309; color: white;">Description</th>
                <th width="40" style="background-color: #b45309; color: white;">Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($equipment->stocksLogs as $log)
                <tr>
                    <td align="center" width="40">{{ $log->change_type }}</td>
                    <td align="center" width="40">{{ $log->quantity }}</td>
                    <td align="left" width="40">{{ $log->reason ?? 'N/A' }}</td>
                    <td align="center" width="40">
                        {{ $log->created_at ? $log->created_at->format('F j, Y h:i A') : 'N/A' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

<!-- Maintenance Logs -->
@if ($equipment->maintenanceLogs->isNotEmpty())
    <h3 style="color: #7B0029; margin-top: 20px;">Maintenance Logs</h3>
    <table align="left" cellspacing="0" cellpadding="8" border="1" style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr style="background-color: #7B0029; color: white;">
                <th width="40" style="background-color: #7B0029; color: white;">Status</th>
                <th width="40" style="background-color: #7B0029; color: white;">Issue Description</th>
                <th width="40" style="background-color: #7B0029; color: white;">Reported Date</th>
                <th width="40" style="background-color: #7B0029; color: white;">Resolved Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($equipment->maintenanceLogs as $log)
                <tr>
                    <td align="center" width="40">{{ $log->status }}</td>
                    <td align="left" width="40">{{ $log->issue_description }}</td>
                    <td align="center" width="40">
                        {{ $log->reported_date ? $log->reported_date->format('F j, Y') : 'N/A' }}
                    </td>
                    <td align="center" width="40">
                        {{ $log->resolved_date ? $log->resolved_date->format('F j, Y') : 'N/A' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

<!-- History Logs -->
@if ($equipment->history->isNotEmpty())
    <h3 style="color: #1d4ed8; margin-top: 20px;">History Logs</h3>
    <table align="left" cellspacing="0" cellpadding="8" border="1" style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr style="background-color: #1d4ed8; color: white;">
                <th width="40" style="background-color: #1d4ed8; color: white;">Type</th>
                <th width="40" style="background-color: #1d4ed8; color: white;">Description</th>
                <th width="40" style="background-color: #1d4ed8; color: white;">Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($equipment->history as $log)
                <tr>
                    <td align="center" width="40">{{ $log->type }}</td>
                    <td align="left" width="40">{{ $log->description }}</td>
                    <td align="center" width="40">
                        {{ $log->created_at ? $log->created_at->format('F j, Y h:i A') : 'N/A' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
