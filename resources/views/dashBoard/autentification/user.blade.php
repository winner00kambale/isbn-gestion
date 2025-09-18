@extends('dashBoard.master.master')
@section('contenu')
    <div class="app-hero-header mb-4">
        <div class="d-flex align-items-center mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <i class="bi bi-house lh-1"></i>
                    <a href="{{ route('dashBoard.index') }}" class="text-decoration-none">Acceuil</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">Utilisateur</li>
            </ol>
        </div>
    </div>
    <div class="app-body">
        <div class="row gx-3">
            <div class="col-xxl-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <a data-bs-toggle="modal" href="#exampleModalToggle" role="button"
                                class="btn btn-outline-primary btn-lg">
                                <i class="bi bi-person"></i> Ajouter
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="loader" class="text-center my-4" style="display:none;">
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden">Chargement...</span>
                                </div>
                            </div>
                            <table class="table align-middle table-hover m-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">UserNAme</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($users->isNotEmpty())
                                        @foreach ($users as $user)
                                            <tr class="grd-primary-light">
                                                <th scope="row">{{ $loop->index + 1 }}</th>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->username }}</td>
                                                <td>
                                                    <a class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#editUserModal-{{ $user->id }}">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirmDeleteModal-{{ $user->id }}">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="confirmDeleteModal-{{ $user->id }}"
                                                tabindex="-1" aria-labelledby="confirmDeleteLabel-{{ $user->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="confirmDeleteLabel-{{ $user->id }}">Confirmer la
                                                                suppression</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Fermer"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Êtes-vous sûr de vouloir supprimer l'Utilisateur ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Annuler</button>
                                                            <form action="{{ route('user.destroy', ['id' => $user->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger">Confirmer</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="editUserModal-{{ $user->id }}"
                                                aria-hidden="true" aria-labelledby="editUserModalLabel-{{ $user->id }}"
                                                tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="editUserModalLabel-{{ $user->id }}">
                                                                Modifier l'utilisateur
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <!-- Le formulaire doit pointer vers la route de mise à jour avec l'ID de l'utilisateur -->
                                                        <form action="{{ route('user.update', ['user' => $user->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="name-{{ $user->id }}"
                                                                        class="form-label">Noms</label>
                                                                    <!-- Les champs sont pré-remplis avec les données de l'utilisateur -->
                                                                    <input type="text" class="form-control"
                                                                        id="name-{{ $user->id }}" name="name"
                                                                        placeholder="Entrez le nom"
                                                                        value="{{ old('name', $user->name) }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="username-{{ $user->id }}"
                                                                        class="form-label">Username</label>
                                                                    <input type="text" class="form-control"
                                                                        id="username-{{ $user->id }}" name="username"
                                                                        placeholder="Entrez le username"
                                                                        value="{{ old('username', $user->username) }}"
                                                                        required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="password-{{ $user->id }}"
                                                                        class="form-label">Password</label>
                                                                    <input type="text" class="form-control"
                                                                        id="password-{{ $user->id }}" name="password"
                                                                        placeholder="Laissez vide pour ne pas modifier"
                                                                        value="">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Annuler</button>
                                                                <button type="submit" class="btn btn-primary">Mettre à
                                                                    jour</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" class="text-center">Aucun Utilisateur trouvé.</td>
                                        </tr>
                                    @endif
                                </tbody>

                            </table>

                        </div>
                    </div>
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
                        AJouter l'utilisateur
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('user.create') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="input1" class="form-label">Noms</label>
                            <input type="text" class="form-control" id="input1" name="name"
                                placeholder="Entrez le noms" required>
                        </div>
                        <div class="mb-3">
                            <label for="input2" class="form-label">Username</label>
                            <input type="text" class="form-control" id="input2" name="username"
                                placeholder="Entrez le username" required>
                        </div>
                        <div class="mb-3">
                            <label for="input3" class="form-label">Password</label>
                            <input type="text" class="form-control" id="input3" name="password"
                                placeholder="Entrez le Password" required>
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
                timer: 3000
            });
        </script>
    @endif
@endsection
