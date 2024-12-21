<table align="left">
    <thead>
        <tr style="background-color: #106c3b; color: white">
            <th style="background-color: #106c3b; color: white;">#</th>
            <th style="background-color: #106c3b; color: white;">Equipment Name</th>
            <th style="background-color: #106c3b; color: white;">Usage Count</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($topPopularEquipment as $index => $equipment)
        <tr>
            <td align="left" width="40">{{ $index + 1 }}</td>
            <td align="left" width="40">{{ $equipment->name }}</td>
            <td align="left" width="40">{{ $equipment->usage_count }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
