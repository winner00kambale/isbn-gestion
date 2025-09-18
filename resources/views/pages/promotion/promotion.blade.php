@extends('dashBoard.master.master')
@section('contenu')
    <div class="app-hero-header mb-4">
        <div class="d-flex align-items-center mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <i class="bi bi-house lh-1"></i>
                    <a href="{{ route('dashBoard.index') }}" class="text-decoration-none">Acceuil</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">Promotion</li>
            </ol>
        </div>
    </div>
    <div class="row gx-3">
        <div class="col-xxl-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="custom-tabs-container">
                        <ul class="nav nav-tabs" id="customTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="tab-one" data-bs-toggle="tab" href="#one" role="tab"
                                    aria-controls="one" aria-selected="true">Promotion</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="customTabContent">
                            <div class="tab-pane fade show active" id="one" role="tabpanel">
                                <div class="p-2 text-start">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <a href="{{ route('promotion.form') }}"
                                                    class="btn btn-outline-primary btn-lg">
                                                    <i class="bi bi-person"></i> Ajouter
                                                </a>
                                                <div class="d-flex align-items-center gap-2">
                                                    <button type="button" class="btn btn-success">
                                                        <i class="bi bi-printer"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <div id="loader" class="text-center my-4" style="display:none;">
                                                    <div class="spinner-border" role="status">
                                                        <span class="visually-hidden">Chargement...</span>
                                                    </div>
                                                </div>

                                                <table class="table align-middle table-hover mb-3">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Désignation</th>
                                                            <th scope="col">Option</th>
                                                            <th scope="col">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if ($promotions->isNotEmpty())
                                                            @foreach ($promotions as $item)
                                                                <tr class="grd-primary-light">
                                                                    <th scope="row">
                                                                        {{ $loop->iteration + ($promotions->currentPage() - 1) * $promotions->perPage() }}
                                                                    </th>
                                                                    <td>{{ $item->designation }}</td>
                                                                    <td>{{ $item->option }}</td>
                                                                    <td>
                                                                        <a class="btn btn-info btn-sm"
                                                                            href="{{ route('promotion.edit', $item->id) }}">
                                                                            <i class="bi bi-pencil"></i>
                                                                        </a>
                                                                        <button type="button" class="btn btn-danger btn-sm"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#confirmDeleteModal">
                                                                            <i class="bi bi-trash"></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="4" class="text-center">Aucun élément trouvé.
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>

                                                <!-- Pagination -->
                                                @if ($promotions->lastPage() > 1)
                                                    <nav aria-label="Page Navigation">
                                                        <ul class="pagination">
                                                            <!-- Previous -->
                                                            <li
                                                                class="page-item {{ $promotions->onFirstPage() ? 'disabled' : '' }}">
                                                                <a class="page-link"
                                                                    href="{{ $promotions->previousPageUrl() }}"
                                                                    aria-label="Previous">
                                                                    <i class="bi bi-arrow-left"></i>
                                                                </a>
                                                            </li>

                                                            <!-- Pages -->
                                                            @for ($i = 1; $i <= $promotions->lastPage(); $i++)
                                                                <li
                                                                    class="page-item {{ $promotions->currentPage() == $i ? 'active' : '' }}">
                                                                    <a class="page-link"
                                                                        href="{{ $promotions->url($i) }}">{{ $i }}</a>
                                                                </li>
                                                            @endfor

                                                            <!-- Next -->
                                                            <li
                                                                class="page-item {{ !$promotions->hasMorePages() ? 'disabled' : '' }}">
                                                                <a class="page-link"
                                                                    href="{{ $promotions->nextPageUrl() }}"
                                                                    aria-label="Next">
                                                                    <i class="bi bi-arrow-right"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </nav>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Succès !',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endif
@endsection
