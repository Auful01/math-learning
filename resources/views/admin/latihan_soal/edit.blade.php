<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Latihan Soal
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="card bg-white p-4 rounded-md">
            <div class="card-body">
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="bg-red-500 text-white p-4 rounded mb-4">
                    {{ session('error') }}
                </div>

            @endif
                <form action="{{ route('latihan.update', $latihan) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label>Pertanyaan</label>
                        <textarea id="pertanyaan" name="question" class="w-full border-gray-300 rounded-md shadow-sm">
                            {{ $latihan->question }}
                        </textarea>

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

                    @php
                        $options = json_decode($latihan->options, true);
                    @endphp

                    @foreach (['A', 'B', 'C', 'D'] as $option)
                        <div class="mb-4">
                            <label>Pilihan {{ $option }}</label>
                            <input type="text" name="options[{{ $option }}]" class="w-full border-gray-300 rounded-md" required value="{{ $options[$option] }}">
                        </div>
                    @endforeach

                    <div class="mb-4">
                        <label>Jawaban Benar</label>
                        <select name="correct_answer" class="w-full border-gray-300 rounded-md" required>
                            <option value="">Pilih Jawaban</option>
                            @foreach (['A', 'B', 'C', 'D'] as $option)
                                <option value="{{ $option }}" @if ($latihan->correct_answer == $option) selected @endif>{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Update</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
