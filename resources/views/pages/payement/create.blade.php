@extends('dashBoard.master.master')

@section('contenu')
    <div class="app-hero-header mb-4">
        <div class="d-flex align-items-center mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <i class="bi bi-house lh-1"></i>
                    <a href="{{ route('dashBoard.index') }}" class="text-decoration-none">Accueil</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('payements.index') }}" class="text-decoration-none">Paiements</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Nouveau</li>
            </ol>
        </div>
    </div>

    <div class="app-body">
        <div class="row gx-3">
            <div class="col-xxl-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Nouveau paiement</h5>
                    </div>
                    <form action="{{ route('payements.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row gx-3">
                                <!-- Inscription -->
                                <div class="col-lg-4 col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Inscription</label>
                                        <select name="code_inscription"
                                            class="form-select @error('code_inscription') is-invalid @enderror" required>
                                            <option value="">-- Sélectionner --</option>
                                            @foreach ($inscriptions as $inscription)
                                                <option value="{{ $inscription->id }}"
                                                    {{ old('code_inscription') == $inscription->id ? 'selected' : '' }}>
                                                    {{ $inscription->etudiant->nom }} {{ $inscription->etudiant->postnom }}
                                                    {{ $inscription->etudiant->prenom }}
                                                    - {{ $inscription->promotion->designation }}
                                                    ({{ $inscription->annee->designation }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('code_inscription')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Type de frais</label>
                                        <select name="code_type"
                                            class="form-select @error('code_type') is-invalid @enderror" required>
                                            <option value="">-- Sélectionner --</option>
                                            @foreach ($types as $type)
                                                <option value="{{ $type->id }}"
                                                    {{ old('code_type') == $type->id ? 'selected' : '' }}>
                                                    {{ $type->designation }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('code_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Date du paiement -->
                                <div class="col-lg-4 col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Date du paiement</label>
                                        <input type="date" name="date_payement"
                                            value="{{ old('date_payement', date('Y-m-d')) }}"
                                            class="form-control @error('date_payement') is-invalid @enderror" required>
                                        @error('date_payement')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Montant en chiffres -->
                                <div class="col-lg-4 col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Montant (en chiffres)</label>
                                        <input type="number" name="montant_chiffre" step="0.01"
                                            value="{{ old('montant_chiffre') }}"
                                            class="form-control @error('montant_chiffre') is-invalid @enderror" required>
                                        @error('montant_chiffre')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Montant en lettres -->
                                <div class="col-lg-8 col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Montant (en lettres)</label>
                                        <input type="text" name="montant_lettre" value="{{ old('montant_lettre') }}"
                                            class="form-control @error('montant_lettre') is-invalid @enderror" required>
                                        @error('montant_lettre')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Type de frais -->
                            </div>
                        </div>

                        <div class="card-footer d-flex gap-2">
                            <a href="{{ route('payements.index') }}" class="btn btn-outline-secondary">Annuler</a>
                            <button type="submit" class="btn btn-success">Valider</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Notification succès --}}
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
