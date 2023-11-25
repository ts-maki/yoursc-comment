<x-layout>
    <x-container>
        <h3 class="bg-success p-1 text-white bg-opacity-75 fs-5">投稿の詳細</h3>
        <div class="my-2 border p-2">
            <h3 class="">{{ $post->title }}</h3>
            <p>{{ $post->comment }}</p>
            <p>by{{ $post->user->name }}</p>
        </div>
    </x-container>
</x-layout>