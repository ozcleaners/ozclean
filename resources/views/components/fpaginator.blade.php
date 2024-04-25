<nav aria-label="Page navigation example ">
    <ul class="pagination justify-content-first pagination-sm">
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link">
                    &laquo;
                </a>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" tabindex="-1">
                    &laquo;
                </a>
            </li>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="page-item disabled"><a href="#" class="page-link">{{ $element }}</a></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><a href="#" class="page-link">{{ $page }}</a></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
                    &raquo;
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <a class="page-link">
                    &raquo;
                </a>
            </li>
        @endif
    </ul>

</nav>
