<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Daftar Materi
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('admin.materi.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Tambah Materi</a>
            @foreach($materis as $materi)
            <div class="mt-4 bg-white  overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                                <div class="p-3">
                                    <h2 class="text-lg font-semibold">{{ $materi->title }}</h2>
                                    <p>{!! $materi->content !!}</p>
                                    <a href="{{ route('admin.materi.edit', $materi->id) }}" class="text-blue-500">Edit</a> |
                                    <form action="{{ route('admin.materi.destroy', $materi->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                                    </form>
                                </div>

                    </div>
                </div>
                @endforeach
        </div>
    </div>
</x-app-layout>
