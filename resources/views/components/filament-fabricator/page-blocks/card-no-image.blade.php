@props(['items'])
<div {{ $attributes->class('px-4 py-4 md:py-8') }}>
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 md:gap-5 gap-y-5">
            @foreach ($items as $item)
                <a href="{{ $item['link'] }}"
                    class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $item['title'] }}
                    </h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">{{ $item['text'] }}</p>
                </a>
            @endforeach
        </div>
    </div>
</div>
