@if ($paginator->hasPages())
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                {{-- Results Information --}}
                <div class="text-muted mb-2 mb-md-0">
                    <small>
                        Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} 
                        of {{ $paginator->total() }} results
                    </small>
                </div>

                {{-- Pagination Navigation --}}
                <nav aria-label="Page Navigation">
                    <ul class="pagination pagination-sm mb-0">
                        {{-- Previous Page Link --}}
                        @if ($paginator->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">
                                    <i class="bi bi-chevron-left"></i>
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                                    <i class="bi bi-chevron-left"></i>
                                </a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <li class="page-item disabled">
                                    <span class="page-link">{{ $element }}</span>
                                </li>
                            @endif

                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $paginator->currentPage())
                                        <li class="page-item active">
                                            <span class="page-link">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($paginator->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">
                                    <i class="bi bi-chevron-right"></i>
                                </span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    {{-- Enhanced Styling for Cards --}}
    <style>
        .pagination {
            --bs-pagination-padding-x: 0.5rem;
            --bs-pagination-padding-y: 0.25rem;
            --bs-pagination-font-size: 0.8rem;
            --bs-pagination-color: #6c757d;
            --bs-pagination-bg: #fff;
            --bs-pagination-border-width: 1px;
            --bs-pagination-border-color: #dee2e6;
            --bs-pagination-border-radius: 0.25rem;
            --bs-pagination-hover-color: #495057;
            --bs-pagination-hover-bg: #f8f9fa;
            --bs-pagination-hover-border-color: #dee2e6;
            --bs-pagination-focus-color: #495057;
            --bs-pagination-focus-bg: #f8f9fa;
            --bs-pagination-focus-box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
            --bs-pagination-active-color: #fff;
            --bs-pagination-active-bg: #667eea;
            --bs-pagination-active-border-color: #667eea;
            --bs-pagination-disabled-color: #adb5bd;
            --bs-pagination-disabled-bg: #fff;
            --bs-pagination-disabled-border-color: #dee2e6;
        }
        
        .pagination .page-link {
            transition: all 0.15s ease-in-out;
            font-weight: 500;
        }
        
        .pagination .page-link:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.08);
        }
        
        .pagination .page-item.active .page-link {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-color: #667eea;
            box-shadow: 0 2px 4px rgba(102, 126, 234, 0.25);
            font-weight: 600;
        }
        
        .pagination .page-item.disabled .page-link {
            opacity: 0.5;
        }
        
        .card-footer .pagination {
            margin-bottom: 0;
        }
        
        .card-footer {
            padding: 0.75rem 1.25rem;
            background-color: #f8f9fa !important;
            border-top: 1px solid rgba(0,0,0,0.05);
        }

        @media (max-width: 576px) {
            .pagination {
                --bs-pagination-padding-x: 0.375rem;
                --bs-pagination-padding-y: 0.1875rem;
                --bs-pagination-font-size: 0.75rem;
            }
            
            .d-flex.justify-content-between {
                flex-direction: column;
                align-items: center !important;
                gap: 0.5rem;
            }
        }
    </style>
@endif
