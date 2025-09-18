<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reçu de Paiement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .receipt {
            width: 600px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            font-size: 14px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .logo-info {
            display: flex;
            align-items: center;
        }

        .logo {
            width: 50px;
            height: 50px;
            margin-right: 15px;
            border-radius: 50%;
        }

        .institute-info p {
            margin: 0;
            line-height: 1.2;
        }

        .receipt-info {
            text-align: right;
            font-size: 12px;
        }

        .title {
            text-align: center;
            margin-bottom: 20px;
        }

        .recu-title {
            background-color: #333;
            color: #fff;
            padding: 5px 20px;
            display: inline-block;
            font-size: 1.5em;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .details .detail-line {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .details .detail-line p {
            margin: 0;
        }

        .details .detail-line p span {
            border-bottom: 1px dotted #000;
            padding: 0 5px;
            display: inline-block;
        }

        .dashed-line {
            border-bottom: 1px dotted #000;
            margin-top: 30px;
            margin-bottom: 20px;
        }

        .signature {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .signature-line {
            text-align: right;
            width: 200px;
        }

        .signature-line p {
            border-top: 1px solid #000;
            padding-top: 5px;
            text-align: center;
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="receipt">
        <div class="header">
            <div class="logo-info">
                <img src="{{ asset('assets/images/logo.jpg') }}" alt="Logo de l'Institut" class="logo">
                <div class="institute-info">
                    <p><strong>INSTITUT SUPERIEUR DU</strong></p>
                    <p><strong>BASSIN DU NIL</strong></p>
                    <p>Email: isbn2011@hotmail.com</p>
                </div>
            </div>
            <div class="receipt-info">
                <p>BENI, {{ \Carbon\Carbon::parse($payement->date)->format('d/m/Y') }}</p>
            </div>
        </div>
        <div class="title">
            <h1 class="recu-title">RECU N° <span>00/{{ $payement->id }}</span></h1>
        </div>
        <div class="details">
            <div class="detail-line">
                <p>Payé par: Mr./Mme <span>{{ $payement->inscription->etudiant->nom }} {{ $payement->inscription->etudiant->postnom }} {{ $payement->inscription->etudiant->prenom }}</span>  <span>{{ $payement->inscription->promotion->designation }}</span> {{ $payement->inscription->promotion->option->designation }}</span></p>
            </div>
            <div class="detail-line">
                <p>MONTANT <span>{{ number_format($payement->montant_chiffre, 0, ',', ' ') }} $</span></p>
            </div>
            <div class="detail-line">
                <p>La somme de: <span>{{ $payement->montant_lettre }}</span></p>
            </div>
            <div class="detail-line">
                <p>En règlement de: <span>{{ $payement->typeFrais->designation }}</span></p>
            </div>
            <div class="dashed-line"></div>
        </div>
        <div class="signature">
            <div class="stamp">
                <p>Par : {{ Auth::user()->name }}</p>
            </div>
            <div class="signature-line">
                <p>Signature</p>
            </div>
        </div>
    </div>
</body>
</html>
