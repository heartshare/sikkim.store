<section {{ $attributes->merge(['class'=>'py-4 md:py-6 bg-white']) }}>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row md:items-center justify-between">
        <div>
            <p class="text-gray-800">{{ $heading }}</p>
            <p class="text-gray-400 text-xs">{{ $subheading ?? null }}</p>
        </div>
        {{ $action ?? null }}
    </div>
</section>
<section class="pt-2 sm:pt-4 lg:pt-8 bg-gray-200 pb-8 md:pb-16">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        {{ $slot }}
    </div>
    @isset($link)
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-2">
            {{ $link }}
        </div>
    @endif
</section>
