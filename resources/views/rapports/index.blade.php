@extends('dashBoard.master.master')
@section('contenu')
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
                        <div class="table-responsive">
                            <table class="table align-middle table-hover m-0">
                                <tbody>
                                    <tr class="grd-primary-light">
                                        <td><a href="{{ route('rapport.journal') }}" target="_blank"
                                                class="text-decoration-none">Journal de Perception</a></td>
                                    </tr>
                                    <tr class="grd-primary-light">
                                        <td><a href="#" target="_blank"
                                                class="text-decoration-none">Liste de paye par promotion et option</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
