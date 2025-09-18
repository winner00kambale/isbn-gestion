@extends('dashBoard.master.master')
@section('contenu')
    <div class="app-hero-header mb-4">
        <div class="d-flex align-items-center mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <i class="bi bi-house lh-1"></i>
                    <a href="{{ route('dashBoard.index') }}" class="text-decoration-none">Acceuil</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">Paiements</li>
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
                            <a href="{{ route('payements.create') }}" class="btn btn-outline-primary btn-lg">
                                <i class="bi bi-cash"></i> Nouveau paiement
                            </a>

                            <div class="d-flex align-items-center gap-2">
                                <a href="{{ route('rapport.journal') }}" class="btn btn-success" target="_blank">
                                    <i class="bi bi-printer"></i>
                                </a>

                                <form id="search-form" action="{{ route('payements.index') }}" method="GET"
                                    class="d-flex">
                                    <input type="text" id="search-input" name="search" class="form-control"
                                        placeholder="Rechercher un paiement..." value="{{ request('search') }}">
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle table-hover mb-3">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Montant (lettres)</th>
                                        <th>Montant (chiffres)</th>
                                        <th>Type de frais</th>
                                        <th>Étudiant</th>
                                        <th>Date paiement</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($payements->isNotEmpty())
                                        @foreach ($payements as $payement)
                                            <tr>
                                                <td>{{ $loop->iteration + ($payements->currentPage() - 1) * $payements->perPage() }}</td>
                                                <td>{{ $payement->montant_lettre }}</td>
                                                <td>{{ $payement->montant_chiffre }} $</td>
                                                <td>{{ $payement->typeFrais->designation ?? '-' }}</td>
                                                <td>
                                                    {{ $payement->inscription->etudiant->nom }}
                                                    {{ $payement->inscription->etudiant->postnom }}
                                                    {{ $payement->inscription->etudiant->prenom }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($payement->date_payement)->format('d/m/Y') }}</td>
                                                <td>
                                                    <a class="btn btn-info btn-sm"
                                                        href="{{ route('payements.edit', $payement->id) }}">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('payements.destroy', $payement->id) }}"
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                    <a href="{{ route('payements.recu', $payement->id) }}" class="btn btn-success btn-sm" target="_blank"><i
                                                            class="bi bi-printer"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center">Aucun paiement trouvé.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            @if ($payements->lastPage() > 1)
                                <nav aria-label="Page Navigation">
                                    <ul class="pagination justify-content-start">
                                        <!-- Previous -->
                                        <li class="page-item {{ $payements->onFirstPage() ? 'disabled' : '' }}">
                                            <a class="page-link" href="{{ $payements->previousPageUrl() }}">
                                                <i class="bi bi-arrow-left"></i>
                                            </a>
                                        </li>
                                        @for ($i = 1; $i <= $payements->lastPage(); $i++)
                                            <li class="page-item {{ $payements->currentPage() == $i ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $payements->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                        <!-- Next -->
                                        <li class="page-item {{ !$payements->hasMorePages() ? 'disabled' : '' }}">
                                            <a class="page-link" href="{{ $payements->nextPageUrl() }}">
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
