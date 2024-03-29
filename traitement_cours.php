<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      padding: 20px;
      text-align: center;
    }

    .container {
      max-width: 400px;
      margin: 0 auto;
      background-color: #fff;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h1 {
      font-size: 24px;
      margin-top: 0;
    }

    p {
      margin-top: 20px;
      color: #666;
    }

    .success-message {
      color: #00a651;
      font-size: 18px;
      font-weight: bold;
      margin-top: 40px;
    }
    .back-button {
      padding: 8px 16px;
      background-color: #154360;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Données sauvegardées avec succès !</h1>
    <p>Merci pour votre contribution.</p>
    <p class="success-message">Vos données ont été enregistrées de manière sécurisée.</p>
    <a href="NazihProjet.html" class="back-button">Retour</a>

  </div>
</body>
</html>
<?php
// Établir une connexion à la base de données
$conn = mysqli_connect('localhost', 'nztechma_nztech', '~#{[z2_}"&]', 'nztechma_nazihplatform');
// Vérifier la connexion
if (!$conn) {
    die('Erreur de connexion à la base de données : ' . mysqli_connect_error());
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nomCours = $_POST['nom_cours'];
    $anneeScolaire = $_POST['annee_scolaire'];
    $branche = $_POST['branche'];

    // Vérifier si un fichier a été téléchargé
    if (isset($_FILES['fichier']) && $_FILES['fichier']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['fichier'];

        // Vérifier et valider le fichier (taille, type, etc.)
        // ...

        // Déplacer le fichier vers un répertoire de destination
        $destination = 'C:/wamp64/www/Test/uploads/' . $file['name'];
        move_uploaded_file($file['tmp_name'], $destination);

        // Insérer les données dans la base de données
        $sql = "INSERT INTO records (nom_cours, annee_scolaire, branche, fichier) VALUES ('$nomCours', '$anneeScolaire', '$branche', '$destination')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo " ";
        } else {
            echo "Une erreur s'est produite lors de l'enregistrement des données : " . mysqli_error($conn);
        }
    } else {
        echo "Aucun fichier n'a été téléchargé.";
    }
}

// Fermer la connexion
mysqli_close($conn);
?>
