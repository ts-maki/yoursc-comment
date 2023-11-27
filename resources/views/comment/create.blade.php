@php
$user_id = Auth::id();
@endphp
<x-layout>
<x-container>
    <h3 class="bg-success p-1 text-white bg-opacity-75 fs-5">返信フォーム</h3>
    @if (session('message'))
    <p>{{ session('message') }}</p>
    @endif
    <div>
        <form action="{{ route('comment.store', $post_id) }}" method="post">
            @csrf
            <div>
                <label for="comment">返信</label>
                <div><textarea name="comment" cols="90" rows="10" id="comment"></textarea></div>
            </div>
            <input type="submit" value="登録" class="btn btn-outline-primary">
        </form>
    </div>
</x-layout>
</x-container>