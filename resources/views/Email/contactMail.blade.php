<!DOCTYPE html>
<html>
<head>
    <title>Formulaire de contact</title>
</head>
<body>
    <h1>{{ $testMailData['name'] }}</h1>
    <h6>{{ $testMailData['email'] }}</h6>
    <h4>OBJET :{{ $testMailData['subject']  }}</h4>
    <p>{{ $testMailData['message'] }}</p>
</body>
</html>
