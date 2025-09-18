<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Journal de paye</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 80px; /* tu peux ajuster la taille */
            height: auto;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 6px;
            text-align: left;
        }
    </style>
</head>
<body>
    <!-- En-tête avec logo -->
    <div class="header">
        <img src="{{ public_path('assets/images/logo.jpg') }}" alt="Logo">
        <h2>Journal de payement</h2>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Noms des Étudiants</th>
                <th>Promotion</th>
                <th>Type de frais</th>
                <th>Montant (chiffres)</th>
                <th>Montant (lettres)</th>
                <th>Date paiement</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payement as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->inscription->etudiant->nom }} {{ $p->inscription->etudiant->postnom }} {{ $p->inscription->etudiant->prenom }}</td>
                    <td>{{ $p->inscription->promotion->designation }} {{ $p->inscription->promotion->option->designation }}</td>
                    <td>{{ $p->typeFrais->designation }}</td>
                    <td>{{ number_format($p->montant_chiffre, 0, ',', ' ') }} $</td>
                    <td>{{ $p->montant_lettre }}</td>
                    <td>{{ \Carbon\Carbon::parse($p->date)->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
