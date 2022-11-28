@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- First Page Link--}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">first</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url(1) }}" rel="prev" aria-label="@lang('pagination.previous')">first</a>
                </li>
            @endif

            {{--Pagination Elements--}}
            <?php
            $first_page = $paginator->currentPage() - floor(env('PAGINATION_DISPLAYED_PAGES_NUM')/2);
            $first_page = $first_page > 0 ? $first_page : 1;
            $last_page = $first_page + env('PAGINATION_DISPLAYED_PAGES_NUM') - 1;

            if ($last_page > $paginator->lastPage())
                {
                    $last_page = $paginator->lastPage();
                    $first_page = $last_page - env('PAGINATION_DISPLAYED_PAGES_NUM') + 1;
                }
            $elements = $paginator->getUrlRange($first_page, $last_page);
            ?>

            @if (is_array($elements))
                @foreach ($elements as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif

            {{--Last Page Link--}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}" rel="next" aria-label="@lang('pagination.next')">last</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">last</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
