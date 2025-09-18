@extends('dashBoard.master.master')
@section('contenu')
    <div class="app-hero-header mb-4">
        <div class="d-flex align-items-center mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <i class="bi bi-house lh-1"></i>
                    <a href="{{ route('dashBoard.index') }}" class="text-decoration-none">Acceuil</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">Inscription</li>
            </ol>
        </div>
    </div>
    <div class="app-body">
        <div class="row gx-3">
            <div class="col-xxl-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Bouton Ajouter -->
                            <a href="{{ route('inscriptions.create') }}" class="btn btn-outline-primary btn-lg">
                                <i class="bi bi-person"></i> Ajouter
                            </a>
                            <div class="d-flex align-items-center gap-2">
                                <a href="#" class="btn btn-success" target="_blank">
                                    <i class="bi bi-printer"></i>
                                </a>
                                <form id="search-form" action="{{ route('inscription.index') }}" method="GET"
                                    class="d-flex">
                                    <input type="text" id="search-input" name="search" class="form-control"
                                        placeholder="Rechercher..." value="{{ request('search') }}">
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle table-hover mb-3">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Étudiant</th>
                                        <th scope="col">Promotion</th>
                                        <th scope="col">Option</th>
                                        <th scope="col">Année académique</th>
                                        <th scope="col">Date inscription</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($inscriptions->isNotEmpty())
                                        @foreach ($inscriptions as $inscription)
                                            <tr>
                                                <td>{{ $loop->iteration + ($inscriptions->currentPage() - 1) * $inscriptions->perPage() }}
                                                </td>
                                                <td>{{ $inscription->nom }} {{ $inscription->postnom }}
                                                    {{ $inscription->prenom }}</td>
                                                <td>{{ $inscription->promotion }}</td>
                                                <td>{{ $inscription->option }}</td>
                                                <td>{{ $inscription->annee }}</td>
                                                <td>{{ \Carbon\Carbon::parse($inscription->created_at)->format('d/m/Y H:i') }}
                                                </td>
                                                <td>
                                                    <a class="btn btn-info btn-sm"
                                                        href="{{ route('inscriptions.edit', $inscription->id) }}">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <a href="{{ route('inscriptions.carte', ['id'=>$inscription->id]) }}" class="btn btn-success btn-sm"><i
                                                            class="bi bi-printer"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center">Aucune inscription trouvée.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>

                            </table>

                            <!-- Pagination -->
                            @if ($inscriptions->lastPage() > 1)
                                <nav aria-label="Page Navigation">
                                    <ul class="pagination justify-content-start">
                                        <!-- Previous -->
                                        <li class="page-item {{ $inscriptions->onFirstPage() ? 'disabled' : '' }}">
                                            <a class="page-link" href="{{ $inscriptions->previousPageUrl() }}">
                                                <i class="bi bi-arrow-left"></i>
                                            </a>
                                        </li>
                                        @for ($i = 1; $i <= $inscriptions->lastPage(); $i++)
                                            <li class="page-item {{ $inscriptions->currentPage() == $i ? 'active' : '' }}">
                                                <a class="page-link"
                                                    href="{{ $inscriptions->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                        <!-- Next -->
                                        <li class="page-item {{ !$inscriptions->hasMorePages() ? 'disabled' : '' }}">
                                            <a class="page-link" href="{{ $inscriptions->nextPageUrl() }}">
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
