@extends('dashBoard.master.master')
@section('contenu')
    <style>
    </style>
    <div class="app-hero-header mb-4">
        <div class="d-flex align-items-center mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <i class="bi bi-house lh-1"></i>
                    <a href="{{ route('dashBoard.index') }}" class="text-decoration-none">Acceuil</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">Rapports</li>
            </ol>
        </div>
    </div>
    <div class="app-body">
        <div class="row gx-3">
            <div class="col-xxl-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header">
                                <h5>Générer un rapport d'irrégularités</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('rapport.generate') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label>Promotion</label>
                                        <select name="promotion_id" class="form-select" required>
                                            <option value="">-- Sélectionner --</option>
                                            @foreach ($promotions as $promo)
                                                <option value="{{ $promo->id }}">{{ $promo->designation }} {{ $promo->option->designation }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Type de frais</label>
                                        <select name="type_id" class="form-select" required>
                                            <option value="">-- Sélectionner --</option>
                                            @foreach ($types as $t)
                                                <option value="{{ $t->id }}">{{ $t->designation }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-success">Générer le PDF</button>
                                </form>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table align-middle table-hover m-0">
                                        <tbody>
                                            <tr class="grd-primary-light">
                                                <td><a href="{{ route('rapport.journal') }}" target="_blank"
                                                        class="text-decoration-none">Journal de Perception</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
