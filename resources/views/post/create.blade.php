@php
$user_id = Auth::id();
@endphp
<x-layout>
    <x-container>
        <h3 class="bg-success p-1 text-white bg-opacity-75 fs-5">投稿フォーム</h3>
        @if (session('message'))
        <p>{{ session('message') }}</p>
        @endif
        <div>
            <form action="{{ route('post.store', $user_id) }}" method="post">
                @csrf
                <div>
                    <label for="title">タイトル</label>
                    <div><input type="text" name="title" id="title"></div>
                </div>
                <div class="mt-2">
                    <label for="comment">内容</label>
                    <div><textarea name="comment" cols="90" rows="10" id="comment" class="w-100"></textarea></div>
                </div>
                <input type="submit" value="登録" class="btn btn-outline-primary">
            </form>
        </div>
    </x-container>
</x-layout>