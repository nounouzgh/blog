<!-- resources/views/components/pagination.blade.php -->
<!-- resources/views/components/pagination-links.blade.php -->

@if ($paginator->hasPages())
    <div class="pagination" style="margin-top: 20px; margin-bottom: 20px; text-align: center;">
        <ul class="pagination-list" style="display: inline-flex; list-style: none; padding: 0; margin: 0;">
            {{-- First Page Link --}}
            <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $paginator->url(1) }}">First</a>
            </li>

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link">Previous</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">Previous</a>
                </li>
            @endif

            {{-- Page Numbers --}}
            @php
                $start = max(1, $paginator->currentPage() - 2);
                $end = min($start + 4, $paginator->lastPage());
            @endphp
            @for ($i = $start; $i <= $end; $i++)
                <li class="page-item {{ $i == $paginator->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">Next</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link">Next</span>
                </li>
            @endif

            {{-- Last Page Link --}}
            <li class="page-item {{ $paginator->currentPage() == $paginator->lastPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">Last</a>
            </li>
        </ul>

        <div class="pagination-info" style="margin-top: 10px; text-align: center; margin-bottom: 20px;">
            <p>Page {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }} - Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results</p>
        </div>
    </div>
@endif



<style>  .pagination-list {
    display: inline-flex;
    list-style: none;
    padding: 0;
    margin: 0;
}

.page-item {
    margin-right: 5px; /* Adjust spacing between pagination items */
}

.page-link {
    display: inline-block;
    padding: 5px 10px; /* Adjust padding as needed */
    text-decoration: none;
    color: #007bff; /* Link color */
    background-color: #fff;
    border: 1px solid #dee2e6;
    border-radius: .25rem;
}

.page-link:hover {
    color: #0056b3; /* Hover color */
    background-color: #e9ecef;
    border-color: #dee2e6;
}

.page-item.disabled .page-link {
    pointer-events: none;
    cursor: not-allowed;
    color: #6c757d;
    background-color: #e9ecef;
    border-color: #07ad39;
    font-size: 15px; /* Adjust the font size as needed */
}

.page-item.active .page-link {
    color: #fff;
    background-color: #007bff; /* Active background color */
    border-color: #007bff;
}

.pagination {
    z-index: 9999;
}
  </style>
  