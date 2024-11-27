<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold">Booking Lapangan</h1>
        <form action="{{ route('bookings.store') }}" method="POST" class="mt-6">
            @csrf
            <div class="mb-4">
                <label for="field_id" class="block text-sm font-medium text-gray-700">Pilih Lapangan</label>
                <select name="field_id" id="field_id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @foreach ($fields as $field)
                        <option value="{{ $field->id }}">{{ $field->name }} - Rp
                            {{ number_format($field->price, 0) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="date" class="block text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" name="date" id="date"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="time" class="block text-sm font-medium text-gray-700">Jam</label>
                <input type="time" name="time" id="time"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
            <button type="submit"
                class="bg-indigo-600 text-black px-4 py-2 rounded-md shadow hover:bg-indigo-700">Pesan</button>
        </form>
    </div>
</x-app-layout>
