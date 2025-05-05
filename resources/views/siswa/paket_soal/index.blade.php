<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Daftar Paket Soal
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-6">
                @foreach ($pakets as $paket)
                    <div class="p-4 border rounded mb-4 bg-white">
                        <h3 class="text-lg font-bold">{{ $paket->title }}</h3>
                        <p class="mt-2">{{ $paket->description }}</p>
                        <br>
                        <small class="mt-2">Waktu: {{ $paket->duration }} menit</small>
                        <br>
                        <small class="mt-2">Jumlah Soal: {{ $paket->latihan_soals_count }}</small>
                        <a href="{{ route('latihan.index', 'paket='.$paket->id) }}"
                            class="text-blue-500 kerjakan-btn"
                            data-paket ="{{ $paket->id }}"
                            data-href="{{ route('latihan.index', 'paket='.$paket->id) }}">
                            Kerjakan
                         </a>


                    </div>
                @endforeach
            </div>

            {{ $pakets->links() }}
        </div>
    </div>


</x-app-layout>
