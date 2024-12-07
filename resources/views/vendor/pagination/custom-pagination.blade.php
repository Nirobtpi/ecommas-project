@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">

        <div class="pagination">
            <div class="pagination-area">
                <div class="pagination-list">
                    <ul class="list-inline">
                        @if ($paginator->onFirstPage())
                            <li class="disabled"><a href="#" tabindex="-1"><i class="las la-arrow-left"></i></a></li>
                        @else
                            <li><a href="{{ $paginator->previousPageUrl() }}"><i class="las la-arrow-left"></i></a></li>
                        @endif

                        @foreach ($elements as $element)
                            @if (is_string($element))
                                <li class="page-item disabled">{{ $element }}</li>
                            @endif

                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $paginator->currentPage())
                                        <li><a href="#" class="active">{{ $page }}</a></li>
                                    @else
                                        <li class="page-item">
                                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        @if ($paginator->hasMorePages())
                            <li class="page-item">
                            <li><a href="{{ $paginator->nextPageUrl() }}"><i class="las la-arrow-right"></i></a></li>
                            </li>
                        @else
                            
                            <li class="disabled"><a href="#"><i class="las la-arrow-right"></i></a></li>
                           
                        @endif
                    </ul>
                </div>
            </div>
        </div>

    </nav>
@endif
