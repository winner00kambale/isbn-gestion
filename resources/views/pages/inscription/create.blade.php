@extends('dashBoard.master.master')

@section('contenu')
    <div class="app-hero-header mb-4">
        <div class="d-flex align-items-center mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <i class="bi bi-house lh-1"></i>
                    <a href="{{ route('dashBoard.index') }}" class="text-decoration-none">Accueil</a>
                </li>
                <li class="breadcrumb-item">Inscriptions</li>
                <li class="breadcrumb-item active" aria-current="page">Nouvelle</li>
            </ol>
        </div>
    </div>

    <div class="app-body">
        <div class="row gx-3">
            <div class="col-xxl-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Nouvelle inscription</h5>
                    </div>
                    <form action="{{ route('inscriptions.store') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="row gx-3">
                                <!-- Etudiant -->
                                <div class="col-lg-4 col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Étudiant</label>
                                        <select name="code_etudiant" class="form-select" required>
                                            <option value="">-- Sélectionner --</option>
                                            @foreach ($etudiants as $etudiant)
                                                <option value="{{ $etudiant->id }}">
                                                    {{ $etudiant->nom }} {{ $etudiant->postnom }} {{ $etudiant->prenom }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Promotion -->
                                <div class="col-lg-4 col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Promotion et Option</label>
                                        <select name="code_promotion" class="form-select" required>
                                            <option value="">-- Sélectionner --</option>
                                            @foreach ($promotions as $promotion)
                                                <option value="{{ $promotion->id }}">
                                                    {{ $promotion->promotion }} - {{ $promotion->option }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- Année -->
                                <div class="col-lg-4 col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Année académique</label>
                                        <select name="code_annee" class="form-select" required>
                                            <option value="">-- Sélectionner --</option>
                                            @foreach ($annees as $annee)
                                                <option value="{{ $annee->id }}">
                                                    {{ $annee->designation }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="d-flex gap-2">
                                <a href="{{ route('inscription.index') }}" class="btn btn-outline-secondary">Annuler</a>
                                <button type="submit" class="btn btn-success">Valider</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif
@endsection
