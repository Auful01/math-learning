<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Daftar Paket Soal
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('paket.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded">Tambah Paket Soal</a>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4 mt-5">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4 mt-5">
                {{ session('error') }}
            </div>

        @endif
        <div class="mt-6">
            @foreach ($pakets as $paket)
                <div class="p-4 border bg-white rounded mb-4">
                    <h3 class="text-lg font-bold">{{ $paket->title }}</h3>
                    <p class="mt-2">{{ $paket->description }}</p>
                    <br>
                    <small class="mt-2">Waktu: {{ $paket->duration }} menit</small>
                    <br>
                    <small class="mt-2">Jumlah Soal: {{ $paket->latihan_soals_count }}</small>
                    <div class="mt-2">
                        <a href="{{ route('paket.edit', $paket) }}" class="text-blue-500">Edit</a> |
                        <a href="{{ route('latihan.index', 'paket='.$paket->id) }}" class="text-green">Paket Soal</a> |
                        <form action="{{ route('paket.destroy', $paket) }}" method="POST" class="inline" onsubmit="return confirm('Yakin mau hapus soal ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $pakets->links() }}
    </div>
    </div>
</x-app-layout>
