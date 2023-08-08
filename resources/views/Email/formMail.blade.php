<!DOCTYPE html>
<html>
<head>
    <title>Nouvelle fiche</title>
</head>
<body>
    <p>Mr/Mme, </p>
    <p>Ceci est une notification de soumission d'une nouvelle de fiche de collecte d'informations</p>
    <p><span class="label">Entreprise : </span><span class="value">{{ $fiche->entreprise->name }}</span></p>
    <p><span class="label">Annee : </span><span class="value">{{ $fiche->annee }}</span></p>
    <p>Veuillez vous connecter a votre espace pour consulter la fiche ou l'extraire au format excel</p>
    <p>Merci...</p>
    <h5 class="">OBSERVATOIRE DU NUMERIQUE SOUTENABLE</h5>
</body>
</html>
