@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item text-center disabled w-25" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">&laquo; Previous</span>
            </li>
        @else
            <li class="page-item text-center w-25">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&laquo; Previous</a>
            </li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item text-center w-25">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">Next &raquo;</a>
            </li>
        @else
            <li class="page-item disabled text-center w-25" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">Next &raquo;</span>
            </li>
        @endif
    </ul>
@else
<ul class="pagination disable">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item text-center disabled w-25" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">&laquo; Previous</span>
            </li>
        @else
            <li class="page-item text-center w-25">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&laquo; Previous</a>
            </li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item text-center w-25">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">Next &raquo;</a>
            </li>
        @else
            <li class="page-item disabled text-center w-25" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">Next &raquo;</span>
            </li>
        @endif
    </ul>
@endif
