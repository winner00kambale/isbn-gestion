@extends('dashBoard.master.master')

@section('contenu')
<div class="app-body">
    <div class="text-end mb-3">
        <a href="{{ route('inscription.index') }}" class="btn btn-secondary">Retour</a>
        <button onclick="window.print()" class="btn btn-primary">
            <i class="bi bi-printer"></i> Imprimer la carte
        </button>
    </div>

    <div class="d-flex justify-content-center">
        <div class="carte-etudiant">
            
            <!-- Header avec logo -->
            <div class="header">
                <img src="{{ asset('assets/images/logo.jpg') }}" alt="Logo" class="logo">
                <h3>ISBN - BENI</h3>
            </div>
            <h6 style="text-align: center;">CARTE D'ETUDIANT</h6>

            <hr class="divider">

            <!-- Infos + photo en flex -->
            <div class="body d-flex justify-content-between">
                <div class="infos">
                    <p><strong>Nom :</strong> {{ $inscription->etudiant->nom }} {{ $inscription->etudiant->postnom }} {{ $inscription->etudiant->prenom }}</p>
                    <p><strong>Promotion :</strong> {{ $inscription->promotion->designation }}</p>
                    <p><strong>Option :</strong> {{ $inscription->promotion->option->designation }}</p>
                    <p><strong>Année :</strong> {{ $inscription->annee->designation }}</p>
                    <p><strong>ID :</strong> {{ $inscription->id }}</p>
                    <p><strong>Date :</strong> {{ $inscription->created_at->format('d/m/Y') }}</p>
                </div>
                @if($inscription->etudiant->image)
                <div class="image">
                    <img src="{{ asset('storage/' . $inscription->etudiant->image) }}" alt="image Étudiant">
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.carte-etudiant {
    width: 360px;
    border: 2px solid #333;
    border-radius: 10px;
    padding: 15px;
    background: linear-gradient(to bottom, #fdfdfd 0%, #e2e2e2 100%);
    box-shadow: 2px 2px 10px rgba(0,0,0,0.2);
    font-family: 'Arial', sans-serif;
}

/* Header */
.carte-etudiant .header {
    display: flex;
    align-items: center;
    gap: 10px;
}

.carte-etudiant .header .logo {
    width: 60px;
}

/* Divider */
.divider {
    border: 1px solid #333;
    margin: 10px 0;
}

/* Body */
.carte-etudiant .body {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.carte-etudiant .infos p {
    margin: 4px 0;
    font-size: 0.9rem;
}

/* Photo */
.carte-etudiant .image img {
    width: 100px;
    height: 120px;
    object-fit: cover;
    border: 1px solid #333;
    border-radius: 5px;
}

/* Impression */
@media print {
    body * {
        visibility: hidden;
    }
    .carte-etudiant, .carte-etudiant * {
        visibility: visible;
    }
    .carte-etudiant {
        margin: 0 auto;
        border: 2px solid #000;
        box-shadow: none;
    }
    button, a {
        display: none;
    }
}
</style>
@endsection
