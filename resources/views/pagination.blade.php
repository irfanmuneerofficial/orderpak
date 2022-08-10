@if ($paginator->hasPages())
<nav aria-label="Page navigation example">
  <ul class="pagination blog-pagination">
    @if ($paginator->onFirstPage())
    <!--<li class="page-item">-->
    <!--  <a class="page-link" href="#" aria-label="Previous">-->
    <!--    <span aria-hidden="true">&laquo;</span>-->
    <!--    <span class="sr-only disabled">Previous</span>-->
    <!--  </a>-->
    <!--</li>-->
    @else
    <li class="page-item">
      <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only disabled">Previous</span>
      </a>
    </li>
    @endif
    @foreach ($elements as $element)
        <!--@if (is_string($element))-->
        <!--<li class="disabled"><span>{{ $element }}</span></li>-->
        <!--@endif-->
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                @else
                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach
    <!--<li class="page-item"><a class="page-link" href="#">1</a></li>-->
    @if ($paginator->hasMorePages())
    <li class="page-item">
      <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
    @else
    <li class="page-item  disabled">
        <span class="sr-only">Next</span>
    </li>
    @endif
  </ul>
</nav>
    <!--<ul class="pager">-->
    <!--    {{-- Previous Page Link --}}-->
    <!--    @if ($paginator->onFirstPage())-->
    <!--        <li class="disabled"><span>? Previous</span></li>-->
    <!--    @else-->
    <!--        <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">? Previous</a></li>-->
    <!--    @endif-->
    <!--    {{-- Pagination Elements --}}-->
    <!--    @foreach ($elements as $element)-->
    <!--        {{-- "Three Dots" Separator --}}-->
    <!--        @if (is_string($element))-->
    <!--            <li class="disabled"><span>{{ $element }}</span></li>-->
    <!--        @endif-->
    <!--        {{-- Array Of Links --}}-->
    <!--        @if (is_array($element))-->
    <!--            @foreach ($element as $page => $url)-->
    <!--                @if ($page == $paginator->currentPage())-->
    <!--                    <li class="active my-active"><span>{{ $page }}</span></li>-->
    <!--                @else-->
    <!--                    <li><a href="{{ $url }}">{{ $page }}</a></li>-->
    <!--                @endif-->
    <!--            @endforeach-->
    <!--        @endif-->
    <!--    @endforeach-->
    <!--    {{-- Next Page Link --}}-->
    <!--    @if ($paginator->hasMorePages())-->
    <!--        <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">Next ?</a></li>-->
    <!--    @else-->
    <!--        <li class="disabled"><span>Next ?</span></li>-->
    <!--    @endif-->
    <!--</ul>-->
@endif