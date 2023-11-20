@if (Route::has('login'))
<div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
    @auth
    <a href="{{ url('/dashboard') }}"
        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
    @else
    <a href="{{ route('login') }}"
        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
        in</a>

    @if (Route::has('register'))
    <a href="{{ route('register') }}"
        class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
    @endif
    @endauth
</div>
@endif
<x-layout>
    <x-container>
        <h3 class="text-bg-warning">投稿の詳細</h3>
        <div class="my-2 border p-2">
            <h3 class="">{{ $post->title }}</h3>
            <p>{{ $post->comment }}</p>
            <p>by{{ $post->user->name }}</p>
        </div>
    </x-container>
</x-layout>