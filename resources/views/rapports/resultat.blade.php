<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Rapport des irrégularités</title>
    <style>
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 100px; /* tu peux ajuster la taille */
            height: auto;
            margin-bottom: 10px;
        }
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 5px;
            text-align: left;
        }

        h2 {
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('assets/images/logo.jpg') }}" alt="Logo">
        <h2>ISBN-BENI</h2>
    </div>
    <h1 style="text-align:center;">Rapport de payements</h1>

    <h2>1. Les Étudiants qui ont payé</h2>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Promotion et Option</th>
                <th>Type de frais</th>
                <th>Montant</th>
                <th>Reste</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($payes as $p)
                @php
                    $modalite = $modalites->firstWhere('code_promotion', $p->inscription->code_promotion);
                    $montantAttendu = $modalite->montant ?? 0;
                    $resteAPayer = $montantAttendu - $p->montant_chiffre;
                @endphp
                <tr>
                    <td>{{ $p->inscription->etudiant->id }}</td>
                    <td>{{ $p->inscription->etudiant->nom ?? '' }} {{ $p->inscription->etudiant->postnom ?? '' }}
                        {{ $p->inscription->etudiant->prenom ?? '' }}</td>
                    <td>{{ $p->inscription->promotion->designation ?? '' }} /
                        {{ $p->inscription->promotion->option->designation ?? '' }}</td>
                    <td>{{ $p->typeFrais->designation ?? '' }}</td>
                    <td>{{ $p->montant_chiffre }} $</td>
                    <td>{{ $resteAPayer }} $</td>
                    <td>{{ $p->date_payement }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center;">Aucun paiement trouvé</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h2>2. Les Étudiants qui n'ont pas payé</h2>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Promotion et Option</th>
                <th>Montant à payer</th>
            </tr>
        </thead>
        <tbody>
            @forelse($nonPayes as $np)
                <tr>
                    <td>{{ $np->etudiant->id }}</td>
                    <td>{{ $np->etudiant->nom ?? '' }} {{ $np->etudiant->postnom ?? '' }}
                        {{ $np->etudiant->prenom ?? '' }}</td>
                    <td>{{ $np->promotion->designation ?? '' }} {{ $np->promotion->option->designation ?? '' }}</td>
                    <td>{{ $montantAttendu ?? '' }} $</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center;">Aucune donnée trouvée</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
