@php
$user_id = Auth::id();
@endphp
<x-layout>
    <x-container>
        <h3 class="bg-success p-1 text-white bg-opacity-75 fs-5">コメントの編集</h3>
        <div>
            <form action="{{ route('comment.update', $comment->id) }}" method="post">
                @method('PUT')
                @csrf
                <div>
                    <label for="comment"></label>
                    <div><textarea name="comment" cols="90" rows="10"
                            id="comment" class="w-100">{{ old('comment', $comment->comment) }}</textarea></div>
                </div>
                <input type="submit" value="登録" class="btn btn-outline-primary">
            </form>
        </div>
    </x-container>
</x-layout>