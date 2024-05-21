@if ($paginator->hasPages())
    <nav style="height: 38px">
        <ul class="pagination">
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">{!! __('messages.previous') !!}</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}"
                       rel="prev">{!! __('messages.previous') !!}</a>
                </li>
            @endif

            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}"
                       rel="next">{!! __('messages.next') !!}</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">{!! __('messages.next') !!}</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
