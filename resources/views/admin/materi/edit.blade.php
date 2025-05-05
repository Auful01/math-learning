<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Materi
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
            <form action="{{ route('admin.materi.update', $materi->id) }}" method="POST" class="bg-white shadow-sm sm:rounded-lg p-6">
                @csrf
                @method('PUT')
                <div>
                    <label>Judul</label>
                    <input type="text" name="title" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ $materi->title }}">
                </div>
                <div class="mt-4">
                    <label>Deskripsi</label>
                    <textarea id="myeditor" name="content" class="w-full border-gray-300 rounded-md shadow-sm">
                    {!! $materi->content !!}
                    </textarea>
                </div>

                <!-- Tambahkan TinyMCE -->
                <script src="https://cdn.tiny.cloud/1/sywv9gjyzoegzmsmo679l506ggyxhabjr5i4bastbpn4krdd/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
                <script>
                  tinymce.init({
                    selector: '#myeditor',
                    plugins: 'lists link image table code',
                    toolbar: 'undo redo | bold italic underline | bullist numlist | link image table | code',
                    menubar: false,
                    height: 400,
                  });
                </script>

                <div class="mt-4">
                    <label>File Materi</label>
                    <input type="file" name="file" class="w-full border-gray-300 rounded-md shadow-sm">
                    @if ($materi->file_url)
                        <p>File saat ini: {{ $materi->file_url }}</p>
                    @endif

                </div>
                <div class="mt-4">
                    <label>Jenis Materi</label>
                    <select name="type" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ $materi->type }}">
                        <option value="video">Video</option>
                        <option value="text">Teks</option>
                    </select>
                </div>
                <div class="mt-4">
                    <label for="">Adakan Penugasan</label>
                    <input type="checkbox" name="is_penugasan" id="is_penugasan" class="ml-2" {{ $materi->is_penugasan ? 'checked' : '' }}>
                </div>
                <div class="mt-4 tenggat-waktu" {{ $materi->is_penugasan ? '' : 'hidden' }}>
                    <label for="">Tenggat Waktu</label>
                    @php
                        $tenggat = \Carbon\Carbon::parse($materi->tenggat_waktu);
                    @endphp

                    <input type="datetime-local"
                        value="{{ $tenggat->format('Y-m-d\TH:i') }}"
                        name="batas_waktu"
                        class="w-full border-gray-300 rounded-md shadow-sm">

                </div>
                <div class="mt-4">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const isPenugasanCheckbox = document.getElementById('is_penugasan');
            const tenggatWaktuDiv = document.querySelector('.tenggat-waktu');

            isPenugasanCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    tenggatWaktuDiv.removeAttribute('hidden');
                } else {
                    tenggatWaktuDiv.setAttribute('hidden', true);
                }
            });
        });
    </script>
</x-app-layout>
