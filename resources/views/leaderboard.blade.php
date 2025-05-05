<x-app-layout>
    <x-slot name="header">
        {{-- Ganti Breadcumb --}}

        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            LEADERBOARD
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-6">


            <table class="min-w-full bg-white border border-gray-800 text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border-b">No</th>
                        <th class="px-4 py-2 border-b">Nama Siswa</th>
                        <th class="px-4 py-2 border-b">Skor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td class="px-4 py-2 border-b">{{ $loop->iteration }} </td>
                        <td class="px-4 py-2 border-b">{{ $item->name }} </td>
                        <td class="px-4 py-2 border-b">{{ $item->avg_score }} </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
