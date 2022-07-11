@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination mt-5 d-flex align-items-center justify-content-center">
            <li class="page-item">
                <a class="page-link" href="{{$paginator->previousPageUrl()}}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Prethodna</span>
                </a>
            </li>
            @for($i=1;$i<=$paginator->lastPage();$i++)
                <li class="page-item"><a class="page-link" href="{{$paginator->url($i)}}">{{$i}}</a></li>
            @endfor
            <li class="page-item">
                <a class="page-link" href="{{$paginator->nextPageUrl()}}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Naredna</span>
                </a>
            </li>
        </ul>
    </nav>
@endif
