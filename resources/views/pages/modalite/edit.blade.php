@extends('dashBoard.master.master')

@section('contenu')
    <div class="app-hero-header mb-4">
        <div class="d-flex align-items-center mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <i class="bi bi-house lh-1"></i>
                    <a href="{{ route('dashBoard.index') }}" class="text-decoration-none">Accueil</a>
                </li>
                <li class="breadcrumb-item">Modalité</li>
                <li class="breadcrumb-item active" aria-current="page">Modification</li>
            </ol>
        </div>
    </div>

    <div class="app-body">
        <div class="row gx-3">
            <div class="col-xxl-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Modifier Modalité de payement</h5>
                    </div>
                    <form action="{{ route('modalite.update', $modalites->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row gx-3">
                                <!-- Promotion -->
                                <div class="col-lg-4 col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Promotion et Option</label>
                                        <select name="code_promotion" class="form-select" required>
                                        <option value="">-- Sélectionner --</option>
                                        @foreach ($promotions as $promotion)
                                            <option value="{{ $promotion->id }}" 
                                                {{ $modalites->code_promotion == $promotion->id ? 'selected' : '' }}>
                                                {{ $promotion->designation }} - {{ $promotion->option->designation }}
                                            </option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row gx-3">
                                <!-- Type des frais -->
                                <div class="col-lg-4 col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Type des frais</label>
                                        <select name="code_type" class="form-select" required>
                                            <option value="">-- Sélectionner --</option>
                                            @foreach ($type as $data)
                                                <option value="{{ $data->id }}"
                                                    {{ $data->id == $modalites->code_type ? 'selected' : '' }}>
                                                    {{ $data->designation }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row gx-3">
                                <!-- Montant -->
                                <div class="col-lg-4 col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Montant</label>
                                        <input type="number" name="montant" class="form-control"
                                            value="{{ $modalites->montant }}" placeholder="Entrer montant">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer">
                            <div class="d-flex gap-2">
                                <a href="{{ route('modalite.index') }}" class="btn btn-outline-secondary">Annuler</a>
                                <button type="submit" class="btn btn-success">Mettre à jour</button>
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
