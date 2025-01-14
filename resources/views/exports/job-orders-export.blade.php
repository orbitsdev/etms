<table align="left">
    <thead>
        <tr style="background-color: #106c3b; color: white">
            <th style="background-color: #106c3b; color: white">ID</th>
            <th style="background-color: #106c3b; color: white">Requester</th>
            <th style="background-color: #106c3b; color: white">Assigned To</th>
            <th style="background-color: #106c3b; color: white">Title</th>
            <th style="background-color: #106c3b; color: white">Description</th>
            <th style="background-color: #106c3b; color: white">Status</th>
            <th style="background-color: #106c3b; color: white">Request Date</th>
            <th style="background-color: #106c3b; color: white">Updated At</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($jobOrders as $jobOrder)
            <tr>
                <td align="left" width="40">{{ $jobOrder->id }}</td>
                <td align="left" width="40">{{ $jobOrder->user->name ?? 'N/A' }}</td>
                <td align="left" width="40">{{ $jobOrder->assignee_name ?? 'N/A' }}</td>
                <td align="left" width="40">{{ $jobOrder->title }}</td>
                <td align="left" width="40">{{ $jobOrder->description }}</td>
                <td align="left" width="40">{{ $jobOrder->status }}</td>
                <td align="left" width="40">{{ $jobOrder->request_date }}</td>
                <td align="left" width="40">{{ $jobOrder->updated_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
