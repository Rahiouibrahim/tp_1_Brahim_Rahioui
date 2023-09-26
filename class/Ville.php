<?php
// Définition de l'interface Ville (Create, Read, Update, Delete) en PHP

interface Ville {
    // Méthode pour récupérer tous les adresse
    public function getAllAdresse();

    // Méthode pour récupérer une adresse par son identifiant
    public function getRefAdresse($id);

    // Méthode pour ajouter un nouveau adresse
    public function addRefAdresse($data);

    // Méthode pour mettre à jour les informations d'une adresse
    public function updateRefAdresse($id, $data);

    // Méthode pour supprimer une adresse par son identifiant
    public function deleteRefAdresse($id);
}
?>

