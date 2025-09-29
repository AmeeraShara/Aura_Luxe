<style>
.pagination-bullets ul {
    padding-left: 0;
    list-style: none;
}

.pagination-bullets li {
    display: inline-block;
}

.pagination-bullets .bullet {
    display: inline-block;
    width: 12px;
    height: 12px;
    background-color: #ddd;
    border-radius: 50%;
    margin: 0 6px;
    text-indent: -9999px; 
    cursor: pointer;
    transition: background-color 0.3s ease;
    border: 1px solid transparent;
}

.pagination-bullets .bullet:hover {
    background-color: #555;
}

.pagination-bullets .bullet.active {
    background-color: #000;
    cursor: default;
    border: 1px solid #333;
}
</style>
@if ($paginator->hasPages())
<nav role="navigation" aria-label="Pagination Navigation" class="pagination-bullets">
    <ul class="pagination justify-content-center list-unstyled d-flex gap-2">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <li>
                        <a href="{{ $url }}" class="bullet @if ($page == $paginator->currentPage()) active @endif" aria-current="{{ $page == $paginator->currentPage() ? 'page' : '' }}">
                            <span class="visually-hidden">Page {{ $page }}</span>
                        </a>
                    </li>
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
            </li>
        @else
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span aria-hidden="true">&rsaquo;</span>
            </li>
        @endif
    </ul>
</nav>
@endif
