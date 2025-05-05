{{-- DETAIL OF MATERY --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <a href="{{route('materi.index')}}">Daftar Materi</a> <span class="text-gray-500">/</span> {{$materi->title}}
        </h2>
    </x-slot>

    <div class="pb-6 pt-12" {{ $materi->is_penugasan == false || $materi->is_penugasan == null ? 'hidden' : '' }}>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
            {{-- Kumpulkan Tugas --}}
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="bg-red-500 text-white p-4 rounded mb-4">
                    {{ session('error') }}
                </div>

            @endif
                    @if ($materi->is_penugasan)
                    <form action="{{ route('materi.submit', $materi->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-4">
                            {{-- File yang telah dikumpulkan --}}
                            <label for="file_tugas" class="block text-sm font-medium text-white">File yang telah dikumpulkan</label>
                            @if ($penugasan != null && $penugasan->file)
                                <p class="text-sm text-gray-500">{{ basename($penugasan->file) }}</p>
                                <a href="{{ asset( $penugasan->file) }}" target="_blank" class="text-blue-500 underline">Lihat File</a>
                            @else
                                <p class="text-sm text-gray-500">Belum ada file yang dikumpulkan</p>
                            @endif
                        </div>
                        <div class="mt-4">
                            <label for="file_tugas" class="block text-sm font-medium text-white">Kumpulkan Tugas</label>
                            <input type="file" name="file" id="file_tugas" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required {{ $materi->is_penugasan && $materi->batas_waktu > now() ? '' : 'disabled' }}>
                            @error('file_tugas')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" {{ $materi->is_penugasan && $materi->batas_waktu > now() ? '' : 'disabled' }}>
                                {{ $penugasan != null && $penugasan->file ? 'Perbarui' : 'Kumpulkan' }}
                            </button>
                        </div>
                        <div class="mt-4">
                            <p class="text-sm text-gray-500">
                                Batas waktu pengumpulan:
                                {{ $materi->batas_waktu ? \Carbon\Carbon::parse($materi->batas_waktu)->diffForHumans() : 'Tidak ada batas waktu' }}
                              </p>


                        </div>
                    </form>
                @endif
                </div>
            </div>
        </div>
    </div>
    <div class="pt-6 pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- @foreach($materis as $materi) --}}
                        <div class="mb-4">
                                <div class="p-3">
                                    <h2 class="text-lg font-semibold">{{ $materi->title }}</h2>
                                    <p>{!! $materi->content !!}</p>
                                </div>

                                {{-- Preview File --}}
                                <p>{{basename($materi->file_url)}}</p>




                                @if ($materi->file_url)
                                    <div class="mt-4">
                                        <h3 class="text-md font-semibold mb-2">File Materi:</h3>

                                        @php
                                            $fileExtension = pathinfo($materi->file_url, PATHINFO_EXTENSION);
                                        @endphp

                                        @if (strtolower($fileExtension) == 'pdf')
                                            <iframe
                                                src="{{ asset('storage/' . $materi->file_url) }}"
                                                width="100%"
                                                height="1000px"
                                                style="border:1px solid #ccc;">
                                            </iframe>
                                        @elseif (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']))
                                            <img
                                                src="{{ asset('storage/' . $materi->file_url) }}"
                                                alt="Materi File"
                                                class="w-full max-w-3xl mx-auto" />
                                        @else
                                            <a href="{{ asset('storage/' . $materi->file_url) }}" target="_blank" class="text-blue-500 underline">
                                                Download {{ basename($materi->file_url) }}
                                            </a>
                                        @endif
                                    </div>
                                @endif

                        </div>

                    {{-- @endforeach --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
