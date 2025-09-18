@extends('dashBoard.master.master')
@section('contenu')
    <div class="app-hero-header mb-4">
        <div class="d-flex align-items-center mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <i class="bi bi-house lh-1"></i>
                    <a href="{{ route('dashBoard.index') }}" class="text-decoration-none">Acceuil</a>
                </li>
                <li class="breadcrumb-item">Promotion</li>
                <li class="breadcrumb-item" aria-current="page">
                    Nouvelle
                </li>
            </ol>
        </div>
    </div>
    <div class="app-body">
        <div class="row gx-3">
            <div class="col-xxl-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Enregistrer une nouvelle</h5>
                    </div>
                    <form action="{{ route('promotion.store') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <!-- Row start -->
                            <div class="row gx-3">
                                <div class="col-lg-5 col-sm-4 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Designation</label>
                                        <input type="text" name="designation" class="form-control" placeholder="Entrer Designation" required>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-sm-4 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Option</label>
                                        <div class="d-flex align-items-end gap-2">
                                            <select class="form-select" name="code_option">
                                                <option value="">Sélectionner</option>
                                                @foreach ($options as $option)
                                                    <option value="{{ $option->id }}">
                                                        {{ $option->designation }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <a class="btn btn-outline-info" data-bs-toggle="modal"
                                                href="#exampleModalToggle" role="button"><i
                                                    class="bi bi-plus-square"></i></a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Row end -->
                        </div>
                        <div class="card-footer">
                            <div class="d-flex gap-2 justify-content-start">
                                <a href="{{ route('promotion.index') }}" type="button" class="btn btn-outline-secondary">
                                    Annuler
                                </a>
                                <button type="submit" class="btn btn-success">
                                    Valider
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">
                        AJouter une option
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('store.option') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="input1" class="form-label">Désignation</label>
                            <input type="text" class="form-control" id="input1" name="designation"
                                placeholder="Entrez la Désignation" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
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
                timer: 3000 // La boîte se ferme après 3 secondes
            });
        </script>
    @endif
@endsection
