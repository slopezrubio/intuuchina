@if ($paginator->hasPages())
    <div class="ui items-pagination menu" data-scope="{{ $paginator->onEachSide }}" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="icon items-pagination__link disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <i class="fas fa-chevron-left"></i><span>{{ __('pagination.previous') }}</span>
            </a>
        @else
            <a class="icon items-pagination__link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                <i class="fas fa-chevron-left"></i><span>{{ __('pagination.previous') }}</span>
            </a>
        @endif

        @foreach ($paginator->getUrlRange(($paginator->currentPage() - $paginator->onEachSide), ($paginator->currentPage() + $paginator->onEachSide)) as $page => $url)
            @if ($page > 0)
                @if ($loop->first && $page > 1)
                    <a class="items-pagination__link--splitter disabled" aria-disabled="true">{{ __('pagination....') }}</a>
                @endif

                @if ($page == $paginator->currentPage())
                    <a class="items-pagination__link active" href="{{ $url }}" aria-current="page">{{ $page }}</a>
                @else
                    @if ($page <= $paginator->lastPage())
                        <a class="items-pagination__link" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endif

                @if ($loop->last && $page < $paginator->lastPage())
                    <a class="items-pagination__link--splitter disabled" aria-disabled="true">{{ __('pagination....') }}</a>
                @endif
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="icon items-pagination__link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                <span>{{ __('pagination.next') }}</span><i class="fas fa-chevron-right"></i>
            </a>
        @else
            <a class="icon items-pagination__link disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span>{{ __('pagination.next') }}</span><i class="fas fa-chevron-right"></i>
            </a>
        @endif
    </div>
@endif
