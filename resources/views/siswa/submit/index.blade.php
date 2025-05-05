<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Daftar Hasil Latihan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-6">

            <div class="mb-4">
                <div class="form-group">
                    <label for="paket_soal" class="block text-white font-bold mb-2">Pilih Paket Soal:</label>
                    <select id="paket_soal" name="paket_soal" class="form-control w-full border-gray-300 rounded-md select2">
                        <option value="">Semua Paket Soal</option>
                        @foreach ($pakets as $paket)
                            <option value="{{ $paket->id }}" {{ request('paket_soal') == $paket->id ? 'selected' : '' }}>
                                {{ $paket->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <table class="min-w-full bg-white border border-gray-800 text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border-b">No</th>
                        @if (auth()->user()->role == 'admin')
                            <th class="px-4 py-2 border-b">Nama Siswa</th>
                        @endif
                        <th class="px-4 py-2 border-b">Nama Paket</th>
                        <th class="px-4 py-2 border-b">Skor</th>
                        <th class="px-4 py-2 border-b">Terbilang</th>
                        <th class="px-4 py-2 border-b">Waktu Dikerjakan</th>
                        <th class="px-4 py-2 border-b">Waktu Selesai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($submits as $item)
                    @php
                        $nilaiTerbilang = "";
                        if ($item->score >= 80) {
                            $nilaiTerbilang = "Baik Sekali";
                        } elseif ($item->score >= 70) {
                            $nilaiTerbilang = "Baik";
                        } elseif ($item->score >= 60) {
                            $nilaiTerbilang = "Cukup";
                        } elseif ($item->score >= 50) {
                            $nilaiTerbilang = "Kurang";
                        } else {
                            $nilaiTerbilang = "Sangat Kurang";
                        }
                    @endphp
                        <tr class="odd:bg-gray-50">
                            <td class="px-4 py-2 border-b">{{ $loop->iteration }}</td>
                            @if (auth()->user()->role == 'admin')
                                <td class="px-4 py-2 border-b">{{ $item->user->name }}</td>
                            @endif
                            <td class="px-4 py-2 border-b">{{ $item->paketSoal->title }}</td>
                            <td class="px-4 py-2 border-b">{{ $item->score }}/100</td>
                            <td class="px-4 py-2 border-b">{{ $nilaiTerbilang }}</td>
                            <td class="px-4 py-2 border-b">{{ $item->waktu_mulai ?? 0 }} </td>
                            <td class="px-4 py-2 border-b">{{ $item->waktu_selesai ?? 0 }} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $submits->links() }}
            </div>
        </div>
    </div>


</x-app-layout>
