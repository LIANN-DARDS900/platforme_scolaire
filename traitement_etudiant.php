<?php
// Établir une connexion à la base de données
$conn = mysqli_connect('localhost', 'nztechma_nztech', '~#{[z2_}"&]', 'nztechma_nazihplatform');
// Vérifier la connexion
if (!$conn) {
    die('Erreur de connexion à la base de données : ' . mysqli_connect_error());
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $branche = $_POST['branche'];
    $anneeScolaire = $_POST['annee_scolaire'];

    // Préparer la requête SQL pour insérer les données dans la table "etudiant"
    $sql = "INSERT INTO eleves (nom, prenom, branche, annee_scolaire) VALUES ('$nom', '$prenom', '$branche', '$anneeScolaire')";

    // Exécuter la requête SQL
    if (mysqli_query($conn, $sql)) {
        // Rediriger vers une page de succès ou une autre page après l'insertion réussie
        header('Location: page_de_succes.php');
        exit;
    } else {
        echo "Erreur lors de l'insertion des données : " . mysqli_error($conn);
    }
}

// Fermer la connexion à la base de données
mysqli_close($conn);
?>
