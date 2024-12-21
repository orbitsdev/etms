<table align="left">
    <thead>
        <tr style="background-color: #106c3b; color: white">
            <th  style="background-color: #106c3b; color: white;">ID</th>
            <th  style="background-color: #106c3b; color: white;">Username</th>
            <th  style="background-color: #106c3b; color: white;">Request Date</th>
            <th  style="background-color: #106c3b; color: white;">Pickup Date</th>
            <th  style="background-color: #106c3b; color: white;">Status</th>
            <th  style="background-color: #106c3b; color: white;">Purpose</th>
            <th  style="background-color: #106c3b; color: white;">Equipment Name</th>
            <th  style="background-color: #106c3b; color: white;">Stock</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($requests as $request)
            <tr>
                <td align="left" width="40">{{ $request->id }}</td>
                <td align="left" width="40">{{ $request->user->name ?? 'N/A' }}</td>
                <td align="left" width="40">
                    {{ $request->getFormattedRequestDateAttribute() }}
                </td>
                <td align="left" width="40">
                    {{ $request->getFormattedActualReturnDateAttribute() }}
                </td>
                <td align="left" width="40">{{ $request->status }}</td>
                <td align="left" width="40">{{ $request->purpose }}</td>
                <td align="left" width="40">
                    @foreach ($request->items as $item)
                        {{ $item->equipment->name ?? 'N/A' }}<br>
                    @endforeach
                </td>
                <td align="left" width="40">
                    @foreach ($request->items as $item)
                        {{ $item->equipment->stock ?? 'N/A' }}<br>
                    @endforeach
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
