<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in! ". Auth::user()->role . "") }}
                </div>
            </div>
        </div>

        {{-- Role jika admin --}}
        @if (Auth::user()->role === 'admin')
            <div class="mt-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <a href="{{ route('admin.materi.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-6 rounded-lg text-center">
                        Kelola Materi
                    </a>
                    <a href="{{ route('paket.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-4 px-6 rounded-lg text-center">
                        Kelola Latihan
                    </a>
                </div>
            </div>
        @endif

        {{-- Role jika siswa --}}
        @if (Auth::user()->role === 'siswa')
            <div class="mt-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <a href="{{ route('materi.index') }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-4 px-6 rounded-lg text-center">
                        Lihat Materi
                    </a>
                    <a href="{{ route('paket.index') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-4 px-6 rounded-lg text-center">
                        Mulai Latihan
                    </a>
                    <a href="{{ route('diskusi.index') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-4 px-6 rounded-lg text-center">
                        Forum Diskusi
                    </a>
                    <a href="{{ route('leaderboard.index') }}" class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-4 px-6 rounded-lg text-center">
                        Leaderboard
                    </a>
                </div>
            </div>
        @endif

        {{-- Role jika guru --}}
        @if (Auth::user()->role === 'guru')
            <div class="mt-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <a href="{{ route('admin.materi.index') }}" class="bg-blue-400 hover:bg-blue-600 text-white font-bold py-4 px-6 rounded-lg text-center">
                        Tambah / Hapus Materi
                    </a>
                    <a href="{{ route('paket.index') }}" class="bg-green-400 hover:bg-green-600 text-white font-bold py-4 px-6 rounded-lg text-center">
                        Buat Soal Latihan
                    </a>
                    <a href="{{ route('leaderboard.index') }}" class="bg-teal-400 hover:bg-teal-600 text-white font-bold py-4 px-6 rounded-lg text-center">
                        Lihat Leaderboard
                    </a>
                    <a href="{{ route('diskusi.index') }}" class="bg-pink-400 hover:bg-pink-600 text-white font-bold py-4 px-6 rounded-lg text-center">
                        Forum Diskusi
                    </a>
                </div>
            </div>
        @endif

    </div>
</x-app-layout>
