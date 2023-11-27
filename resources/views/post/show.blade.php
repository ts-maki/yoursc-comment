<x-layout>
    <x-container>
        <h3 class="bg-success p-1 text-white bg-opacity-75 fs-5">投稿の詳細</h3>
        <div class="my-2 border p-2">
           <div class="d-flex justify-content-between align-items-start">
                <h3 class="fs-5 text-decoration-underline">{{ $post->title }}</h3>
                <p>by{{ $post->user->name }}</p>
           </div>
            <p>{{ $post->comment }}</p>
        </div>
    </x-container>
</x-layout>