<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Reçu de paiement</title>
</head>

<body>
    <h2>Bonjour {{ $payement->inscription->etudiant->nom }} {{ $payement->inscription->etudiant->postnom }}</h2>
    <p>Nous avons bien reçu votre paiement.</p>
    <ul>
        <li><strong>Montant :</strong> {{ number_format($payement->montant_chiffre, 2, ',', ' ') }} $</li>
        <li><strong>En lettres :</strong> {{ $payement->montant_lettre }}</li>
        <li><strong>Frais :</strong> {{ $payement->typeFrais->libelle }}</li>
        <li><strong>Date :</strong> {{ $payement->date_payement }}</li>
    </ul>
    <p>Merci pour votre confiance.</p>
</body>

</html>
