@if ($paginator->hasPages())
    <div class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="disabled"><span>প্রথম</span></a>
            <a class="disabled"><span>&laquo;</span></a>
        @else
            <a href="{{ $paginator->url(1) }}">প্রথম</a>
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <a href="" class="disabled"><span>{{ $element }}</span></a>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a href="" class="active"><span>{{ fFormatDateEn2Bn($page) }}</span></a>
                    @else
                        <a href="{{ $url }}">{{ fFormatDateEn2Bn($page) }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a>
            <a href="{{ $paginator->url($paginator->lastPage()) }}">শেষ</a>
        @else
            <a class="disabled"><span>&raquo;</span></a>
            <a class="disabled"><span>শেষ</span></a>
        @endif
    </div>
@endif
