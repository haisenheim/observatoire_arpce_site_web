<!DOCTYPE html>
<html>
<head>
    <title>Nouveau rapport</title>
</head>
<body>
    <p>Mr/Mme, </p>
    <p>Ceci est une notification de soumission d'un nouveau rapport</p>
    <p><span class="label">Entreprise : </span><span class="value">{{ $report->entreprise->name }}</span></p>
    <p><span class="label">Titre : </span><span class="value">{{ $report->name }}</span></p>
    <p>Veuillez vous connecter a votre espace pour consulter le rapport</p>
    <p>Merci...</p>
    <h5 class="">OBSERVATOIRE DU NUMERIQUE SOUTENABLE</h5>
</body>
</html>
