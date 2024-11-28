<x-app-layout>
    <div class="container mx-auto py-6 px-4 text-gray-900 dark:text-gray-100">


        <section
            class="bg-gradient-to-r from-gray-600 to-gray-800 text-white py-2 mb-10 rounded-xl relative overflow-hidden">
            <!-- Animasi partikel dekoratif -->
            <div class="absolute inset-0 -z-10">
                <div class="w-3 h-3 bg-yellow-400 rounded-full opacity-80 animate-bounce absolute top-10 left-10"></div>
                <div class="w-2 h-2 bg-blue-400 rounded-full opacity-70 animate-pulse absolute top-20 left-1/3"></div>
                <div class="w-4 h-4 bg-green-400 rounded-full opacity-60 animate-spin absolute bottom-10 right-20"></div>
            </div>

            <div class="container mx-auto text-center relative">
                <!-- Teks Selamat Datang -->
                <h2 class="text-5xl font-extrabold mb-6 animate__animated animate__zoomIn animate__delay-1s">
                    Selamat Datang di <span class="text-yellow-400">Oentoeng Space</span>
                </h2>
        </section>


        @if (session('success'))
            <div class="bg-gray-500 text-white p-4 rounded mb-4 transition duration-300 transform hover:scale-105">
                {{ session('success') }}
            </div>
        @endif

        <!-- Menampilkan Jadwal Lapangan Hari Ini -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Jadwal Lapangan Hari Ini</h2>

            <!-- Tanggal Picker dan Filter -->
            <div class="flex justify-between items-center mb-4">
                <p class="text-lg font-medium" id="date-detail">
                    <strong class="text-gray-700 dark:text-gray-300">Hari Ini:</strong>
                    {{ \Carbon\Carbon::now()->format('l, d/m/Y') }}
                </p>
                <div class="flex items-center space-x-4">
                    <label for="datepicker" class="text-lg text-gray-700 dark:text-gray-300">Pilih Tanggal:</label>
                    <input type="date" id="datepicker" name="date" onchange="filterBookings()"
                        class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-gray-500 bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-gray-100 transition duration-300 transform hover:scale-105">
                </div>
            </div>

            <!-- Tabel Booking Hari Ini -->
            <div id="booking-table" class="overflow-hidden bg-white dark:bg-gray-800 shadow-md rounded-lg">
                <table
                    class="min-w-full border-collapse table-auto shadow-md overflow-hidden rounded-lg bg-white dark:bg-gray-800">
                    <thead class="bg-gray-700 text-white dark:bg-gray-700 dark:text-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-center text-lg font-medium uppercase">Hari</th>
                            <th class="px-6 py-4 text-center text-lg font-medium uppercase">Tanggal</th>
                            <th class="px-6 py-4 text-center text-lg font-medium uppercase">Waktu</th>
                            <th class="px-6 py-4 text-center text-lg font-medium uppercase">Pengguna</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookingsToday as $booking)
                            <tr
                                class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-300 ease-in-out transform hover:scale-105">
                                <td class="px-6 py-4 text-center text-lg font-medium text-gray-800 dark:text-gray-100">
                                    {{ \Carbon\Carbon::parse($booking->date)->format('l') }}
                                </td>
                                <td class="px-6 py-4 text-center text-lg font-medium text-gray-800 dark:text-gray-100">
                                    {{ \Carbon\Carbon::parse($booking->date)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 text-center text-lg font-medium text-gray-800 dark:text-gray-100">
                                    {{ $booking->time }}
                                </td>
                                <td class="px-6 py-4 text-center text-lg font-medium text-gray-800 dark:text-gray-100">
                                    {{ $booking->user->name }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
        <!-- Tabel Waktu 07:00 - 23:00 -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Jadwal Waktu Lapangan (07:00 -
                23:00)</h2>
            <div id="time-table" class="overflow-hidden bg-white dark:bg-gray-800 shadow-md rounded-lg">
                <table class="min-w-full border-collapse table-auto">
                    <thead
                        class="bg-gradient-to-r from-gray-600 to-gray-800 text-white dark:from-gray-900 dark:to-gray-700">
                        <tr>
                            <th class="px-6 py-4 text-center text-lg font-medium uppercase">Hari</th>
                            <th class="p-4 text-center font-semibold text-lg tracking-wide uppercase">Waktu</th>
                            <th class="p-4 text-center font-semibold text-lg tracking-wide uppercase">Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        @for ($hour = 7; $hour <= 23; $hour++)
                            <tr
                                class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-300 ease-in-out transform hover:scale-105">
                                {{-- <td class="px-6 py-4 text-center text-lg font-medium text-gray-800 dark:text-gray-100">
                                    {{ \Carbon\Carbon::parse($booking->date)->format('l') }}
                                </td> --}}
                                <td
                                    class="p-4 text-gray-800 dark:text-gray-200 text-center font-medium border-b border-gray-300 dark:border-gray-600">
                                    {{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00
                                </td>
                                <td class="p-4 text-center border-b border-gray-300 dark:border-gray-600">
                                    @php
                                        $booking = $bookingsToday->firstWhere(function ($booking) use ($hour) {
                                            return (int) \Carbon\Carbon::parse($booking->time)->format('H') === $hour;
                                        });
                                    @endphp
                                    @if ($booking)
                                        <span
                                            class="bg-red-500 dark:bg-red-400 text-white dark:text-gray-900 px-3 py-1 rounded-full shadow-md">
                                            Booking
                                        </span>
                                    @else
                                        <span
                                            class="bg-green-600 dark:bg-green-500 text-white dark:text-gray-900 px-3 py-1 rounded-full shadow-md">
                                            Tersedia
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>

        </div>

        <!-- Form Booking Lapangan -->
        @auth
            <div class="mt-6">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-4">Booking Lapangan</h2>
                <form action="{{ route('bookings.store') }}" method="POST"
                    class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg transition duration-300 transform hover:scale-105">
                    @csrf
                    <input type="hidden" name="field_id" value="{{ $field->id }}">

                    <div class="relative mt-4">
                        <input type="date" name="date"
                            class="block w-full border border-gray-300 rounded-lg p-3 bg-gray-100 dark:bg-gray-700 dark:text-gray-100 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 peer"
                            required>
                        <label for="date"
                            class="absolute left-3 top-2 text-gray-500 transform transition-all duration-200 scale-75 origin-[0] peer-placeholder-shown:top-3 peer-placeholder-shown:left-3 peer-placeholder-shown:text-gray-400 peer-focus:-top-1 peer-focus:left-3 peer-focus:text-blue-500"></label>
                    </div>

                    <div class="relative mt-4">
                        <input type="time" name="time"
                            class="block w-full border border-gray-300 rounded-lg p-3 bg-gray-100 dark:bg-gray-700 dark:text-gray-100 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 peer"
                            required>
                        <label for="time"
                            class="absolute left-3 top-2 text-gray-500 transform transition-all duration-200 scale-75 origin-[0] peer-placeholder-shown:top-3 peer-placeholder-shown:left-3 peer-placeholder-shown:text-gray-400 peer-focus:-top-1 peer-focus:left-3 peer-focus:text-blue-500"></label>
                    </div>

                    <button type="submit"
                        class="mt-6 bg-gray-500 text-white hover:bg-gray-300 px-6 py-3 rounded-lg shadow-lg transition duration-300 transform hover:scale-105">
                        Booking Sekarang
                    </button>
                </form>
            </div>
        @endauth

        <!-- Pesan jika pengguna adalah guest -->
        @guest
            <p class="mt-4 text-red-500">Silakan login untuk melakukan booking lapangan.</p>
        @endguest
    </div>

    <script>
        function filterBookings() {
            const selectedDate = document.getElementById('datepicker').value;

            // Kirim AJAX request untuk mendapatkan data booking berdasarkan tanggal yang dipilih
            fetch(`/api/bookings?date=${selectedDate}`)
                .then(response => response.json())
                .then(data => {
                    // Update tabel booking dan time dengan data yang diterima
                    document.getElementById('booking-table').innerHTML = data.bookingTable;
                    document.getElementById('time-table').innerHTML = data.timeTable;
                    document.getElementById('date-detail').innerText = `Tanggal: ${data.selectedDate}`;

                    // Periksa apakah tidak ada booking untuk hari yang dipilih
                    if (data.bookings.length === 0) {
                        document.getElementById('booking-table').innerHTML += `
                            <tr class="border-b">
                                <td colspan="4" class="text-center p-4 text-yellow-500">Tidak ada booking untuk hari ini.</td>
                            </tr>
                        `;
                    }
                });
        }

        function fetchBookings(date) {
            fetch(`/api/bookings?date=${date}`)
                .then(response => response.json())
                .then(data => {
                    // Perbarui tabel booking dengan data baru
                    document.getElementById('booking-table').innerHTML = data.bookingTable;
                    document.getElementById('time-table').innerHTML = data.timeTable;
                    document.getElementById('date-detail').innerText = `Tanggal: ${data.selectedDate}`;
                });
        }
    </script>
</x-app-layout>
