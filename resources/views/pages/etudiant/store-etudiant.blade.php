@extends('dashBoard.master.master')
@section('contenu')
    <div class="app-hero-header mb-4">
        <div class="d-flex align-items-center mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <i class="bi bi-house lh-1"></i>
                    <a href="{{ route('dashBoard.index') }}" class="text-decoration-none">Acceuil</a>
                </li>
                <li class="breadcrumb-item">Etudiant</li>
                <li class="breadcrumb-item" aria-current="page">
                    Nouveau
                </li>
            </ol>
        </div>
    </div>
    <div class="app-body">
        <div class="row gx-3">
            <div class="col-xxl-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Enregistrer le nouveau Etudiant</h5>
                    </div>
                    <form action="{{ route('etudiant.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <!-- Row start -->
                            <div class="row gx-3">
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Nom</label>
                                        <input type="text" name="nom" class="form-control" placeholder="Entrer nom">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">PostNom</label>
                                        <input type="text" name="postnom" class="form-control"
                                            placeholder="Entrer PostNom">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">PreNom</label>
                                        <input type="text" name="prenom" class="form-control"
                                            placeholder="Entrer PreNom">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Genre</label>
                                        <select class="form-select" name="genre">
                                            <option value="M">Masculin</option>
                                            <option value="F">Féminin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Téléphone</label>
                                        <input type="number" name="phone" class="form-control"
                                            placeholder="Entrer Téléphone">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Adresse mail</label>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Entrer email">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Addresse</label>
                                        <input type="text" name="adresse" class="form-control"
                                            placeholder="Entrer adresse">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Photo</label>
                                        <input type="file" name="image" class="form-control" id="photo-input"
                                            placeholder="Selectionner photo" accept="image/*">
                                    </div>
                                    <div class="mt-2">
                                        <img id="photo-preview" src="#" alt="Aperçu de la photo"
                                            style="max-width: 150px; max-height: 150px; display: none;">
                                    </div>
                                </div>
                            </div>
                            <!-- Row end -->
                        </div>
                        <div class="card-footer">
                            <div class="d-flex gap-2 justify-content-start">
                                <a href="{{ route('etudiant.index') }}" type="button" class="btn btn-outline-secondary">
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
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erreur !',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000 // La boîte se ferme après 3 secondes
            });
        </script>
    @endif
@endsection
