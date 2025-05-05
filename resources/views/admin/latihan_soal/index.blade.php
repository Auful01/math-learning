<x-app-layout>
    <x-slot name="header">
        {{-- Ganti Breadcumb --}}

        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <a href="{{route('paket.index')}}">{{$paket->title}}</a>
             < Daftar Latihan Soal
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('latihan.create', 'paket='.$paket->id) }}" class="px-4 py-2 bg-blue-500 text-white rounded">Tambah Soal</a>

        <div class="mt-6">
            @foreach ($soals as $soal)
            {{-- Numbering --}}
            @php
                $number = ($soals->currentPage() - 1) * $soals->perPage() + $loop->iteration;
            @endphp


                <div class="p-4 border bg-white rounded mb-4">
                    <div class="flex items-start">
                        <div class="font-bold mr-2">
                            {{ $number }}.
                        </div>
                        <div>
                            {!! $soal->question !!}
                        </div>
                    </div>
                    <p class="mt-2">Jawaban benar: <b>{{ $soal->correct_answer }}</b></p>
                    <div class="mt-2">
                        <a href="{{ route('latihan.edit', $soal) }}" class="text-blue-500">Edit</a> |
                        <form action="{{ route('latihan.destroy', $soal, 'paket=' . $paket->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin mau hapus soal ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $soals->appends(['paket' => $paket->id])->links() }}

    </div>
    </div>
</x-app-layout>
