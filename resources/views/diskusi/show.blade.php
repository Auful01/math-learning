<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Diskusi
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow p-4 mb-6 rounded">
            <p>{{ $diskusi->content }}</p>

            <small>

                <i>{{ $diskusi->created_at->diffForHumans()  }} | dibuat oleh : {{ $diskusi->user->name }}
                </small>
        </div>

        <h3 class="text-xl font-semibold mb-4 text-white">Komentar</h3>

        @foreach($diskusi->comments as $comment)
            <div class="bg-gray-100 p-3 mb-3 rounded">
                <strong>{{ $comment->user->name }}</strong>:
                <p>{{ $comment->comment }}</p>
                <br>
                <small>
                    <i>{{ $comment->created_at->diffForHumans() }}</i>
                </small>
            </div>
        @endforeach

        <h4 class="text-lg font-semibold mt-6 mb-2 text-white">Tambah Komentar</h4>

        <form action="{{ route('diskusi.comment', $diskusi) }}" method="POST">
            @csrf
            <textarea name="comment" rows="3" class="w-full border-gray-300 rounded-md shadow-sm" required></textarea>
            <button type="submit" class="mt-2 bg-green-500 text-white px-4 py-2 rounded">Komentar</button>
        </form>
    </div>
    </div>
</x-app-layout>
