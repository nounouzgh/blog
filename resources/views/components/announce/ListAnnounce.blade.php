<div class="recent-order">
    <h2>List Announce</h2>
    <table>
        <thead>
            <tr>
                <th>Resource Name</th>
                <th>Resource description</th>
                <th>Resource lien</th>
                <th>Resource Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($resources as $resource)
            <tr>
                <td>{{ $resource->name }}</td>
                <td>{{ $resource->description }}</td>
                <td>{{ $resource->lien }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No resources found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination Links -->
    @if ($resources->hasPages())
    <div class="pagination" style="margin-top: 20px; margin-bottom: 20px; text-align: center;">
        <ul class="pagination-list" style="display: inline-flex; list-style: none; padding: 0; margin: 0;">
            {{-- Previous Page Link --}}
            @if ($resources->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link">Previous</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $resources->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">Previous</a>
                </li>
            @endif

            {{-- Page Numbers --}}
            @php
                $start = max(1, $resources->currentPage() - 2);
                $end = min($start + 4, $resources->lastPage());
            @endphp
            @for ($i = $start; $i <= $end; $i++)
                <li class="page-item {{ $i == $resources->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $resources->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            {{-- Next Page Link --}}
            @if ($resources->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $resources->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">Next</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link">Next</span>
                </li>
            @endif

            {{-- Last Page Link --}}
            @if ($resources->currentPage() < $resources->lastPage() - 2)
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">...</span>
                </li>
                <li class="page-item">
                    <a class="page-link" href="{{ $resources->url($resources->lastPage()) }}">{{ $resources->lastPage() }}</a>
                </li>
            @endif
        </ul>
        
        <div class="pagination-info" style="margin-top: 10px; text-align: center; margin-bottom: 20px;">
            <p>Page {{ $resources->currentPage() }} of {{ $resources->lastPage() }} - Showing {{ $resources->firstItem() }} to {{ $resources->lastItem() }} of {{ $resources->total() }} results</p>
        </div>
    </div>
    @endif

    <style>
        /* Pagination styles */
        .pagination-list {
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
            border-color: #dee2e6;
        }

        .page-item.active .page-link {
            color: #fff;
            background-color: #007bff; /* Active background color */
            border-color: #007bff;
        }
    </style>
</div>
