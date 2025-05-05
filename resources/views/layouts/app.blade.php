<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Math Learning') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .required:after {
                content: " *";
                color: red;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $(document).ready(function() {
                $('.select2').select2({
                    placeholder: "Pilih Paket Soal",
                    allowClear: true
                });
            });

            $(document).ready(function() {
                console.log("Document is ready");

                $('input[required]').each(function() {
                    $(this).parent().find('label').addClass('required');
                });
            });

            // fungsi countdown differensial waktu_mulai waktu_selesai
            function countdown(waktu_mulai, waktu_selesai, element) {
                var waktu_selesai = new Date(waktu_selesai).getTime();

                var x = setInterval(function () {
                    var now = new Date().getTime();
                    var jarak = waktu_selesai - now;

                    if (jarak < 0) {
                        clearInterval(x);
                        $(element).text("WAKTU HABIS");
                        submitLatihan();
                        return;
                    }

                    var jam = Math.floor((jarak % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var menit = Math.floor((jarak % (1000 * 60 * 60)) / (1000 * 60));
                    var detik = Math.floor((jarak % (1000 * 60)) / 1000);

                    // Tambahkan 0 di depan jika < 10
                    jam = jam.toString().padStart(2, '0');
                    menit = menit.toString().padStart(2, '0');
                    detik = detik.toString().padStart(2, '0');

                    $(element).text(jam + " : " + menit + " : " + detik);
                }, 1000);
            }

            function submitLatihan() {
                const url = window.location.origin + '/submit';
                var paket = $('.selesai-btn').data('paket');

                const answeredQuestions = JSON.parse(localStorage.getItem('answeredQuestions_' + paket)) || {};

                const simplified = Object.values(answeredQuestions).map(item => ({
                    soalId: item.soalId,
                    answer: item.answer
                }));

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        paket_soal_id: paket,
                        answers: JSON.stringify(simplified),
                        user_id: "{{ auth()->user()->id }}",
                        submit_id: $('.selesai-btn').data('submit')
                    },
                    success: function (response) {
                        localStorage.removeItem('answeredQuestions_' + paket);
                        localStorage.clear();
                        Swal.fire(
                            'Selesai!',
                            'Latihan kamu sudah disimpan.',
                            'success'
                        ).then(() => {
                            window.location.href = window.location.origin + '/paket';
                        });
                    },
                    error: function (xhr, status, error) {
                        Swal.fire(
                            'Error!',
                            'Terjadi kesalahan saat menyimpan latihan.',
                            'error'
                        );
                        console.error(xhr.responseText);
                    }
                });
            }

             $(document).ready(function () {
                $('.kerjakan-btn').on('click', function (e) {
                    e.preventDefault();
                    const url = $(this).data('href');
                    const urlSubmit = window.location.origin + '/submit/start';
                    var paket = $(this).data('paket');

                    Swal.fire({
                        title: 'Mulai latihan?',
                        text: "Pastikan kamu siap sebelum memulai.",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, mulai!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            console.log('URL:', url);


                            $.ajax({
                                url: urlSubmit,
                                type: 'POST',
                                data: {
                                    paket_soal_id: paket,
                                    user_id: "{{ auth()->user()->id }}",
                                },
                                success: function (response) {

                                    localStorage.setItem('waktu_mulai', response.submit.waktu_mulai)
                                    localStorage.setItem('waktu_selesai', response.submit.waktu_selesai)
                                    localStorage.setItem('data_submit', response.submit.id)
                                    setInterval(() => {
                                        window.location.href = url; //
                                    }, 1000);
                                },
                                error: function (xhr, status, error) {
                                    Swal.fire(
                                        'Error!',
                                        'Terjadi kesalahan saat menyimpan latihan.',
                                        'error'
                                    );
                                    console.error(xhr.responseText);
                                }
                            });
                        }
                    });
                });

            });

            $('body').on('click', '.selesai-btn', function (e) {
                    e.preventDefault();

                    const url = window.location.origin + '/submit'; // Use /submit if this is a web route
                    const paket = $(this).data('paket');

                    Swal.fire({
                        title: 'Selesaikan latihan?',
                        text: "Pastikan kamu sudah menyelesaikan semua soal.",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, selesai!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const answeredQuestions = JSON.parse(localStorage.getItem('answeredQuestions_' + paket)) || {};

                            const simplified = Object.values(answeredQuestions).map(item => ({
                                soalId: item.soalId,
                                answer: item.answer
                            }));

                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: {
                                    paket_soal_id: paket,
                                    answers: JSON.stringify(simplified),
                                    user_id: "{{ auth()->user()->id }}",
                                    submit_id: $('.selesai-btn').data('submit')
                                },
                                success: function (response) {
                                    localStorage.removeItem('answeredQuestions_' + paket);
                                    localStorage.clear();
                                    Swal.fire(
                                        'Selesai!',
                                        'Latihan kamu sudah disimpan.',
                                        'success'
                                    ).then(() => {
                                        window.location.href = window.location.origin + '/paket';
                                    });
                                },
                                error: function (xhr, status, error) {
                                    Swal.fire(
                                        'Error!',
                                        'Terjadi kesalahan saat menyimpan latihan.',
                                        'error'
                                    );
                                    console.error(xhr.responseText);
                                }
                            });
                        }
                    });
                });


        </script>
    </body>
</html>
