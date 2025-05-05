<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tambah Latihan Soal
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="bg-red-500 text-white p-4 rounded mb-4">
                    {{ session('error') }}
                </div>

            @endif

        <div class="card bg-white p-4 rounded-md">
            <div class="card-body">
                <form action="{{ route('latihan.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="paket_soal_id" class="block text-sm font-medium text-gray-700">Paket Soal</label>
                        <select name="paket_soal_id" id="paket_soal_id" class="form-control w-full border-gray-300 rounded-md shadow-sm select2">
                            <option value="">-- Pilih Paket --</option>
                            @foreach ($paket as $packet)
                                <option value="{{ $packet->id }}" {{
                                    (request('paket') == $packet->id) ? 'selected' : ''
                                    }}>{{ $packet->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Pertanyaan</label>
                        <textarea id="pertanyaan" name="question" class="w-full border-gray-300 rounded-md shadow-sm"></textarea>

                        <!-- Tambahkan TinyMCE -->
                        <script src="https://cdn.tiny.cloud/1/sywv9gjyzoegzmsmo679l506ggyxhabjr5i4bastbpn4krdd/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
                        <script>
                          tinymce.init({
                            selector: '#pertanyaan',
                            plugins: 'lists link image table code',
                            toolbar: 'undo redo | bold italic underline | bullist numlist | link image table | code',
                            menubar: false,
                            height: 400,
                          });
                        </script>
                    </div>

                    @foreach (['A', 'B', 'C', 'D'] as $option)
                        <div class="mb-4">
                            <label>Pilihan {{ $option }}</label>
                            <input type="text" name="options[{{ $option }}]" class="w-full border-gray-300 rounded-md" required>
                        </div>
                    @endforeach

                    <div class="mb-4">
                        <label>Jawaban Benar</label>
                        <select name="correct_answer" class="w-full border-gray-300 rounded-md" required>
                            <option value="">Pilih Jawaban</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>

                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">Simpan</button>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
