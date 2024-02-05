@if ($paginator->hasPages())
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center mb-3">
            <li class="page-item {{$paginator->onFirstPage()?'disabled':''}}">
                <a class="page-link" href="{{$paginator->onFirstPage()?'':$paginator->previousPageUrl()}}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">@lang('pagination.previous')</span>
                </a>
            </li>
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
{{--                    <li class="page-item active"><a class="page-link" href="#">{{ $element }}</a></li>--}}
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li class="page-item {{$page == $paginator->currentPage()?'active':''}}"><a class="page-link" href="{{ $page == $paginator->currentPage()?'':$url }}">{{ $page }}</a></li>
                    @endforeach
                @endif
            @endforeach
            <li class="page-item {{$paginator->hasMorePages()?'':'disabled'}}">
                <a class="page-link" href="{{$paginator->hasMorePages()?$paginator->nextPageUrl():''}}" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">@lang('pagination.next')</span>
                </a>
            </li>
        </ul>
    </nav>
@endif
