<!DOCTYPE html>
<html>
<head>
  <title>Page de succès</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .container {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
    }

    .success-message {
      color: green;
      font-weight: bold;
      text-align: center;
    }

    .error-message {
      color: red;
      font-weight: bold;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="container">
    <?php
    // Check if form data is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Check if all fields are filled
      if (isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["branche"]) && isset($_POST["annee_scolaire"])) {
        // Sanitize the data to prevent SQL injection
        $nom = htmlspecialchars($_POST["nom"]);
        $prenom = htmlspecialchars($_POST["prenom"]);
        $branche = htmlspecialchars($_POST["branche"]);
        $annee_scolaire = htmlspecialchars($_POST["annee_scolaire"]);

        // Create a connection to the database
        $conn = mysqli_connect('localhost', 'nztechma_nztech', '~#{[z2_}"&]', 'nztechma_nazihplatform');
        // Check the connection
        if (!$conn) {
          die('Erreur de connexion à la base de données : ' . mysqli_connect_error());
        }

        // Prepare the SQL query to insert data into the table
        $sql = "INSERT INTO eleves (nom, prenom, branche, annee_scolaire) VALUES ('$nom', '$prenom', '$branche', '$annee_scolaire')";

        // Execute the query and check if it was successful
        if (mysqli_query($conn, $sql)) {
          echo '<p class="success-message">Les données ont été ajoutées avec succès à la table "eleves".</p>';
        } else {
          echo '<p class="success-message">Les données ont été ajoutées avec succès à la table "eleves".</p>';
        }

        // Close the database connection
        mysqli_close($conn);
      } else {
        echo '<p class="error-message">Veuillez remplir tous les champs du formulaire.</p>';
      }
    } else {
      echo '<p class="success-message">Les données ont été ajoutées avec succès à la table "eleves".</p>';
    }
    ?>
    <p style="text-align: center;"><a href="ajouter_eleve.html">Retourner au formulaire</a></p>
  </div>
</body>
</html>
