@php
$user_id = Auth::id();
@endphp
<x-layout>
    <x-container>
        @auth
        <h2>{{ Auth::user()->name }}さんでログイン</h2>
        @endauth
        <h3 class="bg-success p-1 text-white bg-opacity-75 fs-5">投稿一覧</h3>
        @auth
        <div>
            <a href="{{ route('post.create', $user_id) }}" class="text-decoration-underline">投稿フォームへ</a>
        </div>
        @endauth
        @if (session('message'))
        <p>{{ session('message') }}</p>
        @endif
        @if (session('comment_message'))
        <p>{{ session('comment_message') }}</p>
        @endif
        @if (session('like_on_message'))
        <p>{{ session('like_on_message') }}</p>
        @endif
        @if (session('like_off_message'))
        <p>{{ session('like_off_message') }}</p>
        @endif
        @foreach ($posts as $post)
        <div class="my-2 border p-2 rounded">
            <div class="d-flex justify-content-between align-items-start">
                <h3 class="fs-5"><a href="{{ route('post.show', ['post_id' => $post->id]) }}"
                        class="text-decoration-underline">{{ $post->title }}</a></h3>
                <p>by{{ $post->user->name }}</p>
            </div>
            <p>{{ $post->comment }}</p>

            @if ($user_id === $post->user_id)
            <div class="d-flex justify-content-between align-items-start mt-4">
                <a href="{{ route('post.edit', ['post_id' => $post->id]) }}" class="btn btn-outline-primary">編集</a>
                <form method="post" action="{{ route('post.delete', ['post_id' => $post->id]) }}">
                    @csrf
                    @method('delete')
                    <input type="submit" value="削除" class="btn btn-outline-danger">
                </form>
            </div>
            @endif
            @auth
            @if ($user_id !== $post->user_id)
            <div class="mt-2">
                <a href="{{ route('post.comment', ['post_id' => $post->id]) }}"
                    class="btn btn-outline-secondary">コメント</a>
            </div>
            @endif
            @if (!Auth::user()->isfavorite($post->id))
            <button onclick="entryLike({{ $post->id }})" style="border: none; background-color: #F8FAFC"
                class="mt-2"><img src="{{ asset('images/favorite_off.svg') }}" alt="いいね登録ボタン"></button>
            @else
            <button onclick="deleteLike({{ $post->id }})" style="border: none; background-color: #F8FAFC"
                class="mt-2"><img src="{{ asset('images/favorite_on.svg') }}" alt="いいね解除ボタン"></button>
            @endif
            @endauth
            <details>
                <summary>{{ $post->comments->count() }}件のコメント</summary>
                @foreach ($post->comments as $comment)
                <div
                    class="{{ $loop->last ? 'none' : 'border-bottom' }} pt-2">
                    <div class="d-flex justify-content-between align-items-start">
                        <p>{{ $comment->comment }}</p>
                        <p>by&nbsp{{ $comment->user->name }}</p>
                    </div>
                    <div class="d-flex justify-content-between align-items-start pb-2">
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
    //いいね登録
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

    //いいね削除
    const deleteLike = (postId) => {
        fetch(`/post/like/${postId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        })
        .then(response => {
            console.log(`${postId}のpostIDでいいね解除成功`);
            location.reload();
        })
        .catch(error => {
            console.log('いいねの解除でエラーが発生しました', error);
        });
    }
</script>