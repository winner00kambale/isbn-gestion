@extends('dashBoard.master.master')

@section('contenu')
    <div class="app-hero-header mb-4">
        <div class="d-flex align-items-center mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <i class="bi bi-house lh-1"></i>
                    <a href="{{ route('dashBoard.index') }}" class="text-decoration-none">Accueil</a>
                </li>
                <li class="breadcrumb-item">Option</li>
                <li class="breadcrumb-item active" aria-current="page">
                    Nouvelle Option
                </li>
            </ol>
        </div>
    </div>
    <div class="app-body">
        <div class="row gx-3">
            <div class="col-xxl-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Enregistrer une nouvelle Option</h5>
                    </div>
                    <form action="{{ route('option.store') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="row gx-3">
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Désignation</label>
                                        <input type="text" name="designation" class="form-control" placeholder="Entrer la designation">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex gap-2 justify-content-start">
                                <a href="{{ route('option.index') }}" type="button" class="btn btn-outline-secondary">
                                    Annuler
                                </a>
                                <button type="submit" class="btn btn-success">
                                    Enregistrer
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
