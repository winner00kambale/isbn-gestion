@extends('dashBoard.master.master')
@section('contenu')
    <div class="app-hero-header mb-4">
        <div class="d-flex align-items-center mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <i class="bi bi-house lh-1"></i>
                    <a href="#" class="text-decoration-none">Acceuil</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">Etudiant</li>
            </ol>
        </div>
    </div>
    <div class="app-body">
        <div class="row gx-3">
            <div class="col-xxl-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('form.store') }}" class="btn btn-outline-primary btn-lg">
                                <i class="bi bi-person"></i> Ajouter
                            </a>
                            <div class="d-flex align-items-center gap-2">
                                <a href="#" class="btn btn-success" target="_blank"><i class="bi bi-printer"></i></a>

                                <form id="search-form" action="{{ route('etudiant.index') }}" method="GET" class="d-flex">
                                    <input type="text" id="search-input" name="search" class="form-control"
                                        placeholder="Rechercher un Etudiant..." value="{{ request('search') }}">
                                </form>
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
                                        <th scope="col">Id</th>
                                        <th scope="col">Photo</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">PostNom</th>
                                        <th scope="col">Prénom</th>
                                        <th scope="col">Genre</th>
                                        <th scope="col">email</th>
                                        <th scope="col">Téléphone</th>
                                        <th scope="col">adresse</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($etudiants->isNotEmpty())
                                        @foreach ($etudiants as $etudiant)
                                            <tr class="grd-primary-light">
                                                <th scope="row">{{ $loop->index + 1 }}</th>
                                                <td>
                                                    @if ($etudiant->image)
                                                        <img class="rounded-circle img-3x me-2"
                                                            src="{{ asset('storage/' . $etudiant->image) }}" alt="Photo">
                                                    @else
                                                        <img class="rounded-circle img-3x me-2"
                                                            src="assets/images/aucune.jpg" alt="Pas de photo">
                                                    @endif
                                                </td>
                                                <td>{{ $etudiant->nom }}</td>
                                                <td>{{ $etudiant->postnom }}</td>
                                                <td>{{ $etudiant->prenom }}</td>
                                                <td>{{ $etudiant->genre }}</td>
                                                <td>{{ $etudiant->email }}</td>
                                                <td>{{ $etudiant->phone }}</td>
                                                <td>{{ $etudiant->adresse }}</td>
                                                <td>
                                                    <a class="btn btn-info btn-sm"
                                                        href="{{ route('etudiant.edit', ['etudiant' => $etudiant->id]) }}">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center">Aucun etudiant trouvé.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            @if ($etudiants->lastPage() > 1)
                                <nav aria-label="Page Navigation">
                                    <ul class="pagination">
                                        <!-- Lien "Previous" -->
                                        <li class="page-item {{ $etudiants->currentPage() == 1 ? 'disabled' : '' }}">
                                            <a class="page-link" href="{{ $etudiants->previousPageUrl() }}"
                                                aria-label="Previous">
                                                <span aria-hidden="true">
                                                    <i class="bi bi-arrow-left"></i>
                                                </span>
                                            </a>
                                        </li>

                                        <!-- Liens numériques des pages -->
                                        @for ($i = 1; $i <= $etudiants->lastPage(); $i++)
                                            <li class="page-item {{ $etudiants->currentPage() == $i ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $etudiants->url($i) }}">
                                                    {{ $i }}
                                                </a>
                                            </li>
                                        @endfor

                                        <!-- Lien "Next" -->
                                        <li
                                            class="page-item {{ $etudiants->currentPage() == $etudiants->lastPage() ? 'disabled' : '' }}">
                                            <a class="page-link" href="{{ $etudiants->nextPageUrl() }}" aria-label="Next">
                                                <span aria-hidden="true">
                                                    <i class="bi bi-arrow-right"></i>
                                                </span>
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
