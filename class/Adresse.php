<?php
// Inclure le fichier "Crud.php" qui définit l'interface Crud.
require_once('Ville.php');

// La classe adresse implémente l'interface Crud.
class Adresse implements Ville {

    // Méthode pour obtenir tous les adresse.
    public function getAllAdresse() {
        global $oPDO; // Utilisation de la variable globale $oPDO (PDO).

        // Prépare une requête SQL pour sélectionner tous les adresse, triés par ID.
        $oPDOStatement = $oPDO->query("SELECT id, lastName, firstName, adress, code_postal FROM adresses ORDER BY id ASC");

        // Récupère tous les adresse sous forme d'un tableau associatif.
        $adresse = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
        return $adresse;
    }

    // Méthode pour obtenir un adresse par son ID.
    public function getRefAdresse($id) {
        global $oPDO; // Utilisation de la variable globale $oPDO (PDO).

        // Prépare une requête SQL pour sélectionner adresse par son ID.
        $oPDOStatement = $oPDO->prepare('SELECT id, lastName, firstName, adress, code_postal FROM adresses WHERE id=:id');

        // Lie la valeur de l'ID en tant que paramètre.
        $oPDOStatement->bindParam(':id', $id, PDO::PARAM_INT);

        // Exécute la requête.
        $oPDOStatement->execute();

        // Récupère le adresse en tant que tableau associatif.
        $adresse = $oPDOStatement->fetch(PDO::FETCH_ASSOC);
        return $adresse;
    }

    // Méthode pour ajouter un adresse.
    public function addRefAdresse($data) {
        global $oPDO; // Utilisation de la variable globale $oPDO (PDO).

        // Prépare une requête SQL pour insérer un nouveau adresse avec les données fournies.
        $oPDOStmt = $oPDO->prepare('INSERT INTO adresses SET adress=:adress, lastName=:lastName, firstName=:firstName,code_postal=:code_postal;');

        // Lie les données fournies en tant que paramètres.
        $oPDOStmt->bindParam(':adress', $data['adress'], PDO::PARAM_STR);
        $oPDOStmt->bindParam(':lastName', $data['lastName'], PDO::PARAM_STR);
        $oPDOStmt->bindParam(':firstName', $data['firstName'], PDO::PARAM_STR);
        $oPDOStmt->bindParam(':code_postal', $data['code_postal'], PDO::PARAM_INT);
        // Exécute la requête.
        $oPDOStmt->execute();

        // Vérifie le lastNamebre de lignes affectées.
        if ($oPDOStmt->rowCount() <= 0) {
            return false;
        }

        // Retourne l'ID du dernier élément inséré.
        return $oPDO->lastInsertId();
    }

    // Méthode pour mettre à jour un adresse.
    public function updateRefAdresse($id, $data) {
        global $oPDO; // Utilisation de la variable globale $oPDO (PDO).

        // Prépare une requête SQL pour mettre à jour un adresse avec les nouvelles données.
        $oPDOStmt = $oPDO->prepare('UPDATE adresses SET adress=:adress, lastName=:lastName, firstName=:firstName,code_postal=:code_postal WHERE id=:id ;');

        // Lie les nouvelles données en tant que paramètres.
        $oPDOStmt->bindParam(':adress', $data['adress'], PDO::PARAM_STR);
        $oPDOStmt->bindParam(':lastName', $data['lastName'], PDO::PARAM_STR);
        $oPDOStmt->bindParam(':firstName', $data['firstName'], PDO::PARAM_STR);
        $oPDOStmt->bindParam(':code_postal', $data['code_postal'], PDO::PARAM_INT);
        $oPDOStmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Exécute la requête.
        $oPDOStmt->execute();

        return $oPDOStmt;
    }

    // Méthode pour supprimer un adresse par son ID.
    public function deleteRefAdresse($id) {
        // Obtient les détails du adresse par son ID.
        $adresse = $this->getRefAdresse($id);

        if($adresse){
            global $oPDO; // Utilisation de la variable globale $oPDO (PDO).

            // Prépare une requête SQL pour supprimer le adresse avec l'ID spécifié.
            $oPDOStmt = $oPDO->prepare('DELETE FROM adresses WHERE id=:id ;');

            // Lie l'ID en tant que paramètre.
            $oPDOStmt->bindParam(':id', $id, PDO::PARAM_INT);

            // Exécute la requête de suppression.
            $result = $oPDOStmt->execute();

            return "Le adresse avec l'ID ".$adresse['id']." a été supprimé.<br>";
        }
        else{
            return "adresse introuvable.";
        }
    }
}
?>