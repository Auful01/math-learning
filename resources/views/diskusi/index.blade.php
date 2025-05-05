<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Diskusi
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('diskusi.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Buat Topik Baru</a>

            @foreach($diskusis as $diskusi)
                <div class="bg-white shadow p-4 mb-4 rounded">
                    <h3 class="text-xl font-semibold">{{ $diskusi->title }}</h3>
                    <p class="text-gray-600">{{ Str::limit($diskusi->content, 100) }}</p>
                    <small class="text-gray-500">Dibuat oleh: {{ $diskusi->user->name }} </small>
                    <br>
                    <i>
                        <small>
                            @if($diskusi->created_at->diffInSeconds() < 60)
                                {{ $diskusi->created_at->diffInSeconds() }} detik yang lalu
                            @elseif($diskusi->created_at->diffInMinutes() < 60)
                                {{ $diskusi->created_at->diffInMinutes() }} menit yang lalu
                            @elseif($diskusi->created_at->diffInHours() < 24)
                                {{ $diskusi->created_at->diffInHours() }} jam yang lalu
                            @else
                                {{ $diskusi->created_at->diffInDays() }} hari yang lalu
                            @endif
                        </small>
                    </i>
                    <br>
                    <a href="{{ route('diskusi.show', $diskusi) }}" class="text-blue-500 mt-2 inline-block">Lihat Diskusi</a>
                </div>
            @endforeach

            {{ $diskusis->links() }}
        </div>
    </div>
</x-app-layout>
