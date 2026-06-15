@if ($paginator->hasPages())
    <nav class="flex items-center justify-center gap-1.5">
        @if ($paginator->onFirstPage())
            <span class="w-9 h-9 flex items-center justify-center text-sm text-gray-400 dark:text-gray-600 border border-gray-200 dark:border-gray-800 rounded-xl cursor-not-allowed">
                <i class="ph-bold ph-caret-left"></i>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="w-9 h-9 flex items-center justify-center text-sm text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-800 rounded-xl hover:bg-emerald-50 dark:hover:bg-gray-800 hover:border-emerald-300 dark:hover:border-emerald-700 transition">
                <i class="ph-bold ph-caret-left"></i>
            </a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="w-9 h-9 flex items-center justify-center text-sm text-gray-400 dark:text-gray-600">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="w-9 h-9 flex items-center justify-center text-sm font-bold text-white bg-emerald-600 rounded-xl shadow-sm">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="w-9 h-9 flex items-center justify-center text-sm text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-800 rounded-xl hover:bg-emerald-50 dark:hover:bg-gray-800 hover:border-emerald-300 dark:hover:border-emerald-700 transition">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="w-9 h-9 flex items-center justify-center text-sm text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-800 rounded-xl hover:bg-emerald-50 dark:hover:bg-gray-800 hover:border-emerald-300 dark:hover:border-emerald-700 transition">
                <i class="ph-bold ph-caret-right"></i>
            </a>
        @else
            <span class="w-9 h-9 flex items-center justify-center text-sm text-gray-400 dark:text-gray-600 border border-gray-200 dark:border-gray-800 rounded-xl cursor-not-allowed">
                <i class="ph-bold ph-caret-right"></i>
            </span>
        @endif
    </nav>
@endif
