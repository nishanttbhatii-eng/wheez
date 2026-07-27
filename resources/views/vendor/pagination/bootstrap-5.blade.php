@if ($paginator->hasPages())
    <nav class="admin-pagination d-flex flex-column flex-sm-row align-items-sm-center justify-content-sm-between gap-3" role="navigation" aria-label="@lang('Pagination Navigation')">
        <p class="small text-muted mb-0">
            {!! __('Showing') !!}
            <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
            {!! __('to') !!}
            <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
            {!! __('of') !!}
            <span class="fw-semibold">{{ $paginator->total() }}</span>
            {!! __('results') !!}
        </p>

        <ul class="pagination mb-0">
            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link page-link--icon" aria-hidden="true">
                        <svg class="pagination-chevron" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="2.75" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link page-link--icon" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                        <svg class="pagination-chevron" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="2.75" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link page-link--icon" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        <svg class="pagination-chevron" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2.75" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link page-link--icon" aria-hidden="true">
                        <svg class="pagination-chevron" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2.75" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
