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
                    Modification
                </li>
            </ol>
        </div>
    </div>
    <div class="app-body">
        <div class="row gx-3">
            <div class="col-xxl-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Mis à jour</h5>
                    </div>
                    <form action="{{ route('etudiant.update', $etudiant) }}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                            <div class="row gx-3">
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Nom</label>
                                        <input type="text" name="nom" class="form-control" placeholder="Entrer nom"
                                            value="{{ old('nom', $etudiant->nom) }}">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">PostNom</label>
                                        <input type="text" name="postnom" class="form-control"
                                            placeholder="Entrer PostNom" value="{{ old('postnom', $etudiant->postnom) }}">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">PreNom</label>
                                        <input type="text" name="prenom" class="form-control"
                                            placeholder="Entrer PreNom" value="{{ old('prenom', $etudiant->prenom) }}">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Genre</label>
                                        <select class="form-select" name="genre">
                                            <option value="M"
                                                {{ old('genre', $etudiant->genre) == 'M' ? 'selected' : '' }}>Masculin</option>
                                            <option value="F"
                                                {{ old('genre', $etudiant->genre) == 'F' ? 'selected' : '' }}>Féminin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Telephone</label>
                                        <input type="text" name="phone" class="form-control"
                                            placeholder="Entrer Telephone"
                                            value="{{ old('phone', $etudiant->phone) }}">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Adresse mail</label>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Adresse mail"
                                            value="{{ old('email', $etudiant->email) }}">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Addresse</label>
                                        <input type="text" name="adresse" class="form-control"
                                            placeholder="Entrer adresse" value="{{ old('adresse', $etudiant->adresse) }}">
                                    </div>
                                </div>                         
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Photo</label>
                                        <input type="file" name="image" class="form-control" id="photo-input"
                                            placeholder="Selectionner photo" accept="image/*">
                                    </div>
                                    <div class="mt-2">
                                        @if ($etudiant->image)
                                            <img id="photo-preview" src="{{ Storage::url($etudiant->image) }}"
                                                alt="Photo actuelle"
                                                style="max-width: 150px; max-height: 150px;">
                                        @else
                                            <img id="photo-preview" src="{{ asset('assets/images/aucune.jpg') }}"
                                                alt="Aperçu de la photo" style="max-width: 150px; max-height: 150px;">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex gap-2 justify-content-start">
                                <a href="{{ route('etudiant.index') }}" type="button" class="btn btn-outline-secondary">
                                    Annuler
                                </a>
                                <button type="submit" class="btn btn-success">
                                    Mettre à jour
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const photoInput = document.getElementById('photo-input');
        const photoPreview = document.getElementById('photo-preview');

        photoInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    photoPreview.src = e.target.result;
                    photoPreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
