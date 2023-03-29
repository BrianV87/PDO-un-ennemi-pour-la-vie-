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

// Vérification des champs obligatoires
if (empty($_POST['firstname']) || empty($_POST['lastname']) || strlen($_POST['firstname']) > 45 || strlen($_POST['lastname']) > 45) {
    die("Erreur : les champs prénom et nom doivent être renseignés et faire moins de 45 caractères");
}

// Insertion du nouvel ami dans la base de données
$stmt = $pdo->prepare("INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)");
$stmt->bindValue(':firstname', htmlspecialchars($_POST['firstname']), PDO::PARAM_STR);
$stmt->bindValue(':lastname', htmlspecialchars($_POST['lastname']), PDO::PARAM_STR);
$stmt->execute();

// Redirection vers la liste des amis
header('Location: index.php');
exit();
