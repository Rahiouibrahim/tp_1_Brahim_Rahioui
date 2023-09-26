<?php
$host = "localhost"; // Adresse du serveur de base de données MySQL
$db = "tp_1"; // Nom de la base de données
$user = "root"; // Nom d'utilisateur MySQL
$password = ""; // Mot de passe MySQL

$dsn = "mysql:host=$host;dbname=$db;charset=UTF8"; // Chaîne de connexion PDO

try {
    $oPDO = new PDO($dsn, $user, $password); // Créer une instance de PDO pour la connexion à la base de données

    if ($oPDO) {
        echo "Connecté à la base de données $db avec succès !";
    }
} catch (PDOException $e) {
    echo $e->getMessage(); // En cas d'erreur de connexion, afficher le message d'erreur
}

require_once "class/Adresse.php"; // Inclure la classe Adresse depuis le fichier externe

$adresse = new Adresse; // Créer une instance de la classe Adresse
echo "<br>";
echo "<br>";

// Récupérer tous les adresses

$adresse = $adresse->getAllAdresse();


// Affichage sous forme de tableau HTML
echo "<table border='1'>";
echo "<tr><th>ID</th><th>nom</th><th>prenom</th><th>adresse</th><th>code_postal</th></tr>";

foreach ($adresse as $adresse) {
    echo "<tr>";
    echo "<td>{$adresse['id']}</td>";
    echo "<td>{$adresse['lastName']}</td>";
    echo "<td>{$adresse['firstName']}</td>";
    echo "<td>{$adresse['adress']}</td>";
    echo "<td>{$adresse['code_postal']}</td>";
    echo "</tr>";
}

echo "</table>";

$adresse = new Adresse; // Créer une nouvelle instance de la classe adresse

$adresse_to_insert = [
    'lastName' => "rahioui",
    'firstName' => "brahim",
    'adress' => "2013 PIX",
    'code_postal' => 1520,
];

$adresse_added = $adresse->addRefAdresse($adresse_to_insert);

$adresse1 = new Adresse; // Créer une autre instance de la classe Adresse

$adresse = $adresse->getRefAdresse(1); // Obtenir la Adresse avec l'identifiant 1

$adresse['lastName'] = "Kanzari";
$adresse['firstName'] = "jong";
$adresse['adress'] = "3345 Goin";
$adresse['code_postal'] = 3400;


$adresse1->updateRefAdresse($adresse['id'], $adresse);

// Obtenir la Adresse avec l'identifiant 1 après la mise à jour
var_dump($adresse1->getRefAdresse(1));

$adresse1->deleteRefAdresse(10);
?>


