<table align="left">
    <thead>
        <tr style="background-color: #106c3b; color: white">
            <th style="background-color: #106c3b; color: white;">ID</th>
            <th style="background-color: #106c3b; color: white;">Name</th>
            <th style="background-color: #106c3b; color: white;">Serial Number</th>
            <th style="background-color: #106c3b; color: white;">Stock</th>
            <th style="background-color: #106c3b; color: white;">Status</th>
            <th style="background-color: #106c3b; color: white;">Location</th>
            <th style="background-color: #106c3b; color: white;">Issue Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($equipments as $equipment)
            <tr>
                <td align="left" width="40">{{ $equipment->id }}</td>
                <td align="left" width="40">{{ $equipment->name }}</td>
                <td align="left" width="40">{{ $equipment->serial_number }}</td>
                <td align="left" width="40">{{ $equipment->stock }}</td>
                <td align="left" width="40">{{ $equipment->status }}</td>
                <td align="left" width="40">{{ $equipment->location ?? 'N/A' }}</td>
                <td align="left" width="40">
                    @if ($equipment->status === 'Under Maintenance')
                        {{ $equipment->issue_description ?? 'N/A' }}
                    @else
                        N/A
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
