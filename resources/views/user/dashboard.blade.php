<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container mx-auto py-6">
        <div class="mt-4">
            @if ($bookings->isEmpty())
                <p>Anda belum melakukan booking.</p>
            @else
                <table class="min-w-full bg-white border border-gray-300 mt-4">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">Lapangan</th>
                            <th class="px-4 py-2 text-left">Tanggal</th>
                            <th class="px-4 py-2 text-left">Waktu</th>
                            <th class="px-4 py-2 text-left">Status</th>
                            <th class="px-4 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $booking->field->name }}</td>
                                <td class="px-4 py-2">{{ $booking->date }}</td>
                                <td class="px-4 py-2">{{ $booking->time }}</td>
                                <td class="px-4 py-2">{{ ucfirst($booking->status) }}</td>
                                <td class="px-4 py-2">
                                    @if ($booking->status == 'pending')
                                        <form action="{{ route('cancelBooking', $booking->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="bg-red-500 text-white px-4 py-2 rounded">Batal</button>
                                        </form>
                                    @elseif ($booking->status == 'confirmed')
                                        <button class="bg-green-500 text-white px-4 py-2 rounded"
                                            disabled>Dikonfirmasi</button>
                                    @elseif ($booking->status == 'canceled')
                                        <button class="bg-gray-500 text-white px-4 py-2 rounded"
                                            disabled>Dibatalkan</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>
