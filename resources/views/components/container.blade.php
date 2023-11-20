<div class="my-4">
    <div {{ $attributes->merge(['class' => 'container']) }}>
        {{ $slot }}
    </div>
</div>