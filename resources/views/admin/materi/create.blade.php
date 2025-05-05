<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tambah Materi
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

            <form action="{{ route('admin.materi.store') }}" method="POST" class="bg-white shadow-sm sm:rounded-lg p-6" enctype="multipart/form-data">
                @csrf
                <div>
                    <label>Judul</label>
                    <input type="text" name="title" class="w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="mt-4">
                    <label>Deskripsi</label>
                    <textarea id="myeditor" name="content" class="w-full border-gray-300 rounded-md shadow-sm"></textarea>
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
                </div>
                <div class="mt-4">
                    <label>Jenis Materi</label>
                    <select name="type" class="w-full border-gray-300 rounded-md shadow-sm">
                        <option value="video">Video</option>
                        <option value="text">Teks</option>
                    </select>
                </div>

                <div class="mt-4">
                    <label for="">Adakan Penugasan</label>
                    <input type="checkbox" name="is_penugasan" id="is_penugasan" class="ml-2">
                </div>

                <div class="mt-4 tenggat-waktu" hidden>
                    <label for="">Tenggat Waktu</label>
                    <input type="datetime-local" name="batas_waktu" class="w-full border-gray-300 rounded-md shadow-sm">
                </div>

                {{-- <div class="mt-4">
                    <label for="">Jenis File</label>
                    <select name="file_type" id="file_type" class="w-full border-gray-300 rounded-md shadow-sm select2" multiple >
                        <option value="pdf">PDF</option>
                        <option value="docx">DOCX</option>
                        <option value="pptx">PPTX</option>
                        <option value="mp4">MP4</option>
                        <option value="mp3">MP3</option>
                        <option value="jpg">JPG</option>
                        <option value="png">PNG</option>
                        <option value="xlsx">XLSX</option>
                        <option value="zip">ZIP</option>
                        <option value="rar">RAR</option>
                        <option value="other">Lainnya</option>
                    </select>
                </div> --}}

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
