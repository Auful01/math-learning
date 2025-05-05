<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tambah Paket Soal
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="bg-red-500 text-white p-4 rounded mb-4">
                    {{ session('error') }}
                </div>

            @endif

        <div class="card bg-white p-4 rounded-md">
            <div class="card-body">
                <form action="{{ route('paket.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="">Judul Paket Soal</label>
                        <input type="text" name="title" class="w-full border-gray-300 rounded-md" required>
                    </div>

                    <div class="mb-4">
                        <label for="">Deskripsi</label>
                        <textarea name="description" class="w-full border-gray-300 rounded-md" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="">Waktu (dalam menit)</label>
                        <input type="number" name="duration" class="w-full border-gray-300 rounded-md" required>
                    </div>

                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">Simpan</button>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
