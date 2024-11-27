<table class="min-w-full border-collapse shadow-lg overflow-hidden rounded-lg bg-white dark:bg-gray-800">
    <thead class="bg-gradient-to-r from-gray-600 to-gray-800 text-white dark:from-gray-900 dark:to-gray-700">
        <tr>
            <th class="border border-gray-300 p-3 text-left font-semibold uppercase">Waktu</th>
            <th class="border border-gray-300 p-3 text-left font-semibold uppercase">Status</th>
        </tr>
    </thead>
    <tbody>
        @for ($hour = 7; $hour <= 23; $hour++)
            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-300">
                <td class="border border-gray-300 p-3 text-gray-800 dark:text-gray-200 font-medium">
                    {{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00
                </td>
                <td class="border border-gray-300 p-3">
                    @php
                        $booking = $bookingsToday->firstWhere(function ($booking) use ($hour) {
                            return (int) \Carbon\Carbon::parse($booking->time)->format('H') === $hour;
                        });
                    @endphp
                    @if ($booking)
                        <span
                            class="bg-green-600 dark:bg-green-500 text-white dark:text-gray-900 px-4 py-2 rounded-full shadow">
                            Booking
                        </span>
                    @else
                        <span
                            class="bg-red-500 dark:bg-red-400 text-white dark:text-gray-900 px-4 py-2 rounded-full shadow">
                            Tersedia
                        </span>
                    @endif
                </td>
            </tr>
        @endfor
    </tbody>
</table>
