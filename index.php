<?php
require_once('_connec.php');

// Connexion à la base de données
try {
    $pdo = new PDO(DSN, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    die();
}

// Récupération de la liste des amis
$stmt = $pdo->prepare("SELECT * FROM friend");
$stmt->execute();
$friends = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Affichage de la liste des amis
if (count($friends) > 0) {
    echo '<ul>';
    foreach ($friends as $friend) {
        echo '<li>' . htmlentities($friend['firstname']) . ' ' . htmlentities($friend['lastname']) . '</li>';
    }
    echo '</ul>';
} else {
    echo '<p>Aucun ami pour le moment</p>';
}
?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Liste d'amis</title>
</head>

<body>
    <h1>Liste d'amis</h1>



    <h2>Ajouter un ami</h2>

    <form method="post" action="add_friend.php">
        <label for="firstname">Prénom :</label>
        <input type="text" id="firstname" name="firstname" required maxlength="45"><br>

        <label for="lastname">Nom :</label>
        <input type="text" id="lastname" name="lastname" required maxlength="45"><br>

        <input type="submit" value="Ajouter">
    </form>
</body>

</html>