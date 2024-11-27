<table class="min-w-full mt-4 border-collapse border  bg-white dark:bg-gray-800 border-gray-300">
    <thead>
        <tr class="bg-gray-100">
            <th class="border border-gray-300 p-2">Hari</th>
            <th class="border border-gray-300 p-2">Tanggal</th>
            <th class="border border-gray-300 p-2">Waktu</th>
            <th class="border border-gray-300 p-2">Pengguna</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($bookingsToday as $booking)
            <tr>
                <td class="border border-gray-300 p-2">{{ \Carbon\Carbon::parse($booking->date)->format('l') }}</td>
                <td class="border border-gray-300 p-2">{{ \Carbon\Carbon::parse($booking->date)->format('d/m/Y') }}</td>
                <td class="border border-gray-300 p-2">{{ $booking->time }}</td>
                <td class="border border-gray-300 p-2">{{ $booking->user->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
