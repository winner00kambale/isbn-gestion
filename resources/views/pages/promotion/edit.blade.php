@extends('dashBoard.master.master')

@section('contenu')
    <div class="app-hero-header mb-4">
        <div class="d-flex align-items-center mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <i class="bi bi-house lh-1"></i>
                    <a href="{{ route('dashBoard.index') }}" class="text-decoration-none">Accueil</a>
                </li>
                <li class="breadcrumb-item">Promotion</li>
                <li class="breadcrumb-item" aria-current="page">
                    Modifier
                </li>
            </ol>
        </div>
    </div>

    <div class="app-body">
        <div class="row gx-3">
            <div class="col-xxl-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Modifier la promotion</h5>
                    </div>
                    <form action="{{ route('promotion.update', $promotion->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <!-- Row start -->
                            <div class="row gx-3">
                                <div class="col-lg-5 col-sm-4 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Désignation</label>
                                        <input type="text" name="designation" class="form-control"
                                            value="{{ old('designation', $promotion->designation) }}"
                                            placeholder="Entrer Désignation" required>
                                    </div>
                                </div>

                                <div class="col-lg-5 col-sm-4 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Option</label>
                                        <div class="d-flex align-items-end gap-2">
                                            <select class="form-select" name="code_option" required>
                                                <option value="">Sélectionner</option>
                                                @foreach ($options as $option)
                                                    <option value="{{ $option->id }}"
                                                        {{ $promotion->code_option == $option->id ? 'selected' : '' }}>
                                                        {{ $option->designation }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Row end -->
                        </div>

                        <div class="card-footer">
                            <div class="d-flex gap-2 justify-content-start">
                                <a href="{{ route('promotion.index') }}" type="button"
                                    class="btn btn-outline-secondary">
                                    Annuler
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Mettre à jour
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
                timer: 3000
            });
        </script>
    @endif
@endsection
