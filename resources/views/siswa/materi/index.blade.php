<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Daftar Materi
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach($materis as $materi)
            <div class="mt-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                                <div class="p-3">
                                    <h2 class="text-lg font-semibold">{{ $materi->title }}</h2>
                                    <p>{!! $materi->content !!}</p>
                                    <a href="{{ route('materi.show', $materi->id) }}" class="text-blue-500">Lihat</a>
                                </div>

                    </div>
                </div>
                    @endforeach
        </div>
    </div>
</x-app-layout>
