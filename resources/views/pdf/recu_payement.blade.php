<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reçu de Paiement</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        td, th { border: 1px solid #000; padding: 6px; text-align: left; }
    </style>
</head>
<body>
    <div class="header">
        <h2>ISBN/BENI</h2>
        <h3>Reçu de Paiement</h3>
    </div>

    <p><strong>Nom :</strong> {{ $payement->inscription->etudiant->nom }} {{ $payement->inscription->etudiant->postnom }} {{ $payement->inscription->etudiant->prenom }}</p>
    <p><strong>Promotion :</strong> {{ $payement->inscription->promotion->designation }} {{ $payement->inscription->promotion->option->designation }}</p>
    <p><strong>Type de frais :</strong> {{ $payement->typeFrais->designation }}</p>
    <p><strong>Montant :</strong> {{ number_format($payement->montant_chiffre, 0, ',', ' ') }} $</p>
    <p><strong>En lettres :</strong> {{ $payement->montant_lettre }}</p>
    <p><strong>Date :</strong> {{ \Carbon\Carbon::parse($payement->date_payement)->format('d/m/Y') }}</p>
</body>
</html>
