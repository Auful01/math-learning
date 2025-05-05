<x-app-layout>
    <x-slot name="header">
        {{-- Ganti Breadcumb --}}

        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <a href="{{route('paket.index')}}">{{$paket->title}}</a>
             < Daftar Latihan Soal
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex gap-8">
            <!-- Sidebar Nomor Soal -->
            <!-- Sidebar Nomor Soal -->
            <div class="w-1/6">
                <div class="bg-white shadow p-4 mb-4 mt-6 rounded sticky top-6">
                    <h3 class="text-xl font-semibold">Nomor Soal</h3>
                    <p class="text-gray-600">Pilih nomor soal untuk menjawab</p>
                    <p >
                        Durasi:
                        <span id="timer" class="font-bold text-red-500">
                        </span>
                    </p>
                    <hr class="my-4">
                    <div class="grid grid-cols-5 gap-2">
                        @foreach ($soals as $index => $soal)
                            @php
                                $globalIndex = ($soals->currentPage() - 1) * $soals->perPage() + $index;
                            @endphp
                            <button
                                id="soalBtn-{{ $globalIndex }}"
                                class="w-full h-6 border rounded flex items-center justify-center bg-gray-200"
                            >
                                {{ $globalIndex + 1 }}
                            </button>
                        @endforeach
                    </div>
                    {{-- Submit Button Selesai --}}
                    <div class="mt-4">
                        {{-- <form action="{{ route('latihan.store', $paket->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="paket_id" value="{{ $paket->id }}">
                            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded" class="">Selesai</button>
                        </form> --}}
                        <button class="w-full bg-blue-500 text-white py-2 rounded selesai-btn" id="selesaiBtn" data-paket="{{$paket->id}}" data-submit="">
                            Selesai
                        </button>
                    </div>
                </div>
            </div>

            <!-- Soal dan Jawaban -->
            <div class="w-5/6">
                <div class="mt-6">
                    @foreach ($soals as $index => $soal)
                            @php
                                $globalIndexSoal = ($soals->currentPage() - 1) * $soals->perPage() + $index + 1;
                            @endphp
                        <div class="bg-white p-4 border rounded-lg mb-6" id="soal-{{ $globalIndexSoal }}">
                            <div class="flex items-start">
                                <div class="font-bold mr-2">
                                    {{ $globalIndexSoal}}.
                                </div>
                                <div>
                                    {!! $soal->question !!}
                                </div>
                            </div>

                            <ul>
                                @php
                                    $options = json_decode($soal->options, true);
                                @endphp
                                @foreach ($options as $key => $option)
                                    <li class="mt-2">
                                        <label class="flex items-center space-x-2">
                                            <input
                                                type="radio"
                                                name="answer_{{ $globalIndexSoal }}"
                                                id="{{ $globalIndexSoal + 1 . '_' . $key }}"
                                                value="{{ $key }}"
                                                data-soal-id="{{$soal->id}}"
                                                onchange="markAnswered({{ $globalIndexSoal }})"
                                            >
                                            <span>{{ $option }}</span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>

                {{ $soals->appends(['paket' => $paket->id])->links() }}
            </div>
        </div>
    </div>

    <!-- Tambahkan script kecil untuk tandai soal -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const answeredQuestions = JSON.parse(localStorage.getItem('answeredQuestions_' + {{$paket->id}})) || {};

            countdown(localStorage.getItem('waktu_mulai'), localStorage.getItem('waktu_selesai'), "#timer")
            $('.selesai-btn').attr('data-submit', localStorage.getItem('data_submit'));

            // Saat halaman load, tandai soal yang sudah dijawab
            Object.keys(answeredQuestions).forEach(index => {
                console.log(answeredQuestions[index]);
                // Tandai button soal to int
                const button = document.getElementById('soalBtn-' +(
                    parseInt(answeredQuestions[index].questionId) - 1
                ));
                if (button) {
                    button.classList.remove('bg-gray-200');
                    button.classList.add('bg-green-400', 'text-white');
                }
                const radio = document.querySelector('input[name="answer_' + index + '"][value="' + answeredQuestions[index].answer + '"]');
                if (radio) {
                    radio.checked = true;
                }
            });
        });

        function markAnswered(index) {
            const button = document.getElementById('soalBtn-' + (parseInt(index) - 1));
            if (button) {
                button.classList.remove('bg-gray-200');
                button.classList.add('bg-green-400', 'text-white');
            }

            // Simpan ke localStorage
            let answeredQuestions = JSON.parse(localStorage.getItem('answeredQuestions_' + {{$paket->id}})) || {};
            answeredQuestions[index] = {
                answered: true,
                questionId: index,
                soalId: document.querySelector('input[name="answer_' + index + '"]').dataset.soalId,
                answer: document.querySelector('input[name="answer_' + index + '"]:checked') ? document.querySelector('input[name="answer_' + index + '"]:checked').value : null
            };
            localStorage.setItem('answeredQuestions_'+ {{$paket->id}}, JSON.stringify(answeredQuestions));
        }


    </script>


</x-app-layout>
