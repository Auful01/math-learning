<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Buat Diskusi Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form action="{{ route('diskusi.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block font-medium">Isi Diskusi</label>
                <textarea name="content" rows="5" class="w-full border-gray-300 rounded-md shadow-sm" required></textarea>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Kirim</button>
        </form>
        </div>
    </div>
</x-app-layout>
