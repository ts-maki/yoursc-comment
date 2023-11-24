@php
$user_id = Auth::id();
@endphp
@if (Route::has('login'))
<div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
    @auth
    <a href="{{ url('/dashboard') }}"
        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">設定</a>
    @else
    <a href="{{ route('login') }}"
        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">ログイン</a>

    @if (Route::has('register'))
    <a href="{{ route('register') }}"
        class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">設定</a>
    @endif
    @endauth
</div>
@endif
<x-layout>
    <x-container>
        <h2>{{ Auth::user()->name }}さんでログイン</h2>
        <h3 class="text-bg-warning">掲示板</h3>
        @auth
        <div>
            <a href="{{ route('post.create', $user_id) }}">投稿フォームへ</a>
        </div>
        @endauth
        @if (session('message'))
        <p>{{ session('message') }}</p>
        @endif
        @if (session('comment_message'))
        <p>{{ session('comment_message') }}</p>
        @endif
        @if (session('like_message'))
        <p>{{ session('like_message') }}</p>
        @endif
        @foreach ($posts as $post)
        <div class="my-2 border p-2">
            <div>

            </div>
            <h3><a href="{{ route('post.show', ['post_id' => $post->id]) }}">{{ $post->title }}</a></h3>
            <p>{{ $post->comment }}</p>
            <p>by{{ $post->user->name }}</p>
            @if ($user_id === $post->user_id)
            <div class="d-flex justify-content-between align-items-start">
                <a href="{{ route('post.edit', ['post_id' => $post->id]) }}" class="btn btn-outline-primary">編集</a>
                <form method="post" action="{{ route('post.delete', ['post_id' => $post->id]) }}">
                    @csrf
                    @method('delete')
                    <input type="submit" value="削除" class="btn btn-outline-danger">
                </form>
            </div>
            @endif
            @auth
            <div class="d-flex justify-content-between align-items-start">
                @if ($user_id !== $post->user_id)
                <a href="{{ route('post.comment', ['post_id' => $post->id]) }}"
                    class="btn btn-outline-secondary">コメント</a>
                @endif
                @if (!Auth::user()->isfavorite($post->id))
                <button onclick="entryLike({{ $post->id }})" style="border: none; background-color: #F8FAFC"><img src="{{ asset('images/favorite_off.svg') }}" alt="いいね登録ボタン"></button>
                @else
                <a href=""><img src="{{ asset('images/favorite_on.svg') }}" alt="いいね解除ボタン"></a>
                @endif
            </div>
            @endauth
            <details>
                <summary>{{ $post->comments->count() }}件のコメント</summary>
                @foreach ($post->comments as $comment)
                <div
                    class="d-flex justify-content-between align-items-start {{ $loop->last ? 'none' : 'border-bottom' }}">
                    <p>{{ $comment->comment }}</p>
                    <div>
                        <p>by&nbsp{{ $comment->user->name }}</p>
                        @if ($user_id == $comment->user->id)
                        <a href="{{ route('comment.edit', ['comment_id' => $comment->id]) }}"
                            class="btn btn-outline-primary">編集</a>
                        <form method="post" action="{{ route('comment.delete', ['comment_id' => $comment->id]) }}">
                            @csrf
                            @method('delete')
                            <input type="submit" value="削除" class="btn btn-outline-danger">
                        </form>
                        @endif
                    </div>
                </div>
                @endforeach
            </details>
        </div>
        @endforeach
    </x-container>
</x-layout>
<script>
    const entryLike = (postId) => {
        fetch(`/post/like/${postId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        })
        .then(response => {
            console.log(`${postId}のpostIDでいいね登録成功`);
            location.reload();
        })
        .catch(error => {
            console.log('いいねの登録でエラーが発生しました', error);
        });
    }
</script>