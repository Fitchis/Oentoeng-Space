<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-6">
        <div class="mt-8">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Daftar Booking</h2>
            <table class="min-w-full table-auto mt-4 border border-gray-300 rounded-lg overflow-hidden shadow-lg">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-gray-600">Nama Pengguna</th>
                        <th class="px-6 py-3 text-left text-gray-600">Lapangan</th>
                        <th class="px-6 py-3 text-left text-gray-600">Tanggal</th>
                        <th class="px-6 py-3 text-left text-gray-600">Waktu</th>
                        <th class="px-6 py-3 text-left text-gray-600">Status</th>
                        <th class="px-6 py-3 text-left text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr class="border-b hover:bg-gray-100 transition duration-200">
                            <td class="px-6 py-4">{{ $booking->user->name }}</td>
                            <td class="px-6 py-4">{{ $booking->field->name }}</td>
                            <td class="px-6 py-4">{{ $booking->date }}</td>
                            <td class="px-6 py-4">{{ $booking->time }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="text-sm @if ($booking->status == 'confirmed') text-green-500 @elseif ($booking->status == 'canceled') text-red-500 @else text-yellow-500 @endif">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.updateBookingStatus', $booking) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    <select name="status"
                                        class="border border-gray-300 rounded hover:bg-gray-50 transition duration-150">
                                        <option value="pending" @selected($booking->status == 'pending')>Pending</option>
                                        <option value="confirmed" @selected($booking->status == 'confirmed')>Confirmed</option>
                                        <option value="canceled" @selected($booking->status == 'canceled')>Canceled</option>
                                    </select>
                                    <button type="submit"
                                        class="ml-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200 shadow">Update</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Form untuk menambah Booking -->
        <div class="mt-8">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Tambah Booking</h2>
            <form action="{{ route('admin.storeBooking') }}" method="POST"
                class="mt-4 bg-white shadow-md p-6 rounded-lg">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="user_id" class="block text-sm font-medium">Pilih Pengguna</label>
                        <select name="user_id" id="user_id"
                            class="mt-1 block w-full border border-gray-300 rounded hover:bg-gray-50 transition duration-150"
                            required>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="field_id" class="block text-sm font-medium">Pilih Lapangan</label>
                        <select name="field_id" id="field_id"
                            class="mt-1 block w-full border border-gray-300 rounded hover:bg-gray-50 transition duration-150"
                            required>
                            @foreach ($fields as $field)
                                <option value="{{ $field->id }}">{{ $field->name }} - {{ $field->price }} IDR
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="date" class="block text-sm font-medium">Tanggal</label>
                        <input type="date" name="date" id="date"
                            class="mt-1 block w-full border border-gray-300 rounded hover:bg-gray-50 transition duration-150"
                            required>
                    </div>
                    <div>
                        <label for="time" class="block text-sm font-medium">Waktu</label>
                        <input type="time" name="time" id="time"
                            class="mt-1 block w-full border border-gray-300 rounded hover:bg-gray-50 transition duration-150"
                            required>
                    </div>
                </div>
                <button type="submit"
                    class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200 shadow">Tambah
                    Booking</button>
            </form>
        </div>

        <!-- Manajemen Field -->
        <div class="mt-8">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Manajemen Lapangan</h2>

            <!-- Form untuk menambah Field -->
            <form action="{{ route('admin.storeField') }}" method="POST"
                class="mt-4 bg-white shadow-md p-6 rounded-lg">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-sm font-medium">Nama Lapangan</label>
                        <input type="text" name="name" id="name"
                            class="mt-1 block w-full border border-gray-300 rounded hover:bg-gray-50 transition duration-150"
                            required>
                    </div>
                    <div>
                        <label for="price" class="block text-sm font-medium">Harga</label>
                        <input type="number" name="price" id="price"
                            class="mt-1 block w-full border border-gray-300 rounded hover:bg-gray-50 transition duration-150"
                            required>
                    </div>
                    <div class="col-span-2">
                        <label for="description" class="block text-sm font-medium">Deskripsi</label>
                        <textarea name="description" id="description" rows="3"
                            class="mt-1 block w-full border border-gray-300 rounded hover:bg-gray-50 transition duration-150"></textarea>
                    </div>
                </div>
                <button type="submit"
                    class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-200 shadow">Tambah
                    Lapangan</button>
            </form>

            <!-- Daftar Field -->
            <h3 class="text-lg mt-6">Daftar Lapangan</h3>
            <ul class="list-none mt-4">
                @foreach ($fields as $field)
                    <li class="border-b py-2 flex justify-between items-center">
                        <span>{{ $field->name }} - {{ $field->price }} IDR</span>
                        <form action="{{ route('admin.deleteField', $field) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition duration-200 shadow">Hapus</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Modal for Update Booking -->
    <div id="updateModal" class="fixed inset-0 flex items-center justify-center hidden">
        <div class="bg-white rounded shadow-lg p-6 transition-transform transform scale-95">
            <h3 class="text-lg font-bold">Update Booking</h3>
            <form id="updateForm" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="mt-4">
                    <label for="updateStatus" class="block text-sm font-medium">Status</label>
                    <select name="status" id="updateStatus"
                        class="mt-1 block w-full border border-gray-300 rounded hover:bg-gray-50 transition duration-150">
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="canceled">Canceled</option>
                    </select>
                </div>
                <div class="mt-4 flex justify-end">
                    <button type="button" onclick="close Modal()"
                        class="mr-2 bg-gray-300 text-black px-4 py-2 rounded hover:bg-gray-400 transition duration-200">Batal</button>
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-200 shadow">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    </div>

    <script>
        function openModal(bookingId) {
            document.getElementById('updateModal').classList.remove('hidden');
            document.getElementById('updateForm').action = `/admin/bookings/${bookingId}`;
            document.getElementById('updateModal').classList.add('scale-100');
        }

        function closeModal() {
            document.getElementById('updateModal').classList.add('hidden');
        }

        // Add event listeners for buttons to open the modal
        document.querySelectorAll('.open-modal-button').forEach(button => {
            button.addEventListener('click', function() {
                openModal(this.dataset.bookingId);
            });
        });

        // Add loading indicators
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                const button = form.querySelector('button[type="submit"]');
                button.innerHTML = 'Loading...';
                button.disabled = true;
            });
        });
    </script>
</x-app-layout>
