<!DOCTYPE html>
<meta charset="UTF-8">

<html>
<head>
  <style>
body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
    }
    
    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
    }
    
    .title {
      text-align: center;
      color: Turquoise;
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
    }
    .title2 {
      text-align: center;
      color: White;
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    th, td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    
    th {
      background-color: #154360;
      color: #fff;
    }
    
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    
    tr:hover {
      background-color: #ddd;
    }
    
    .button-container {
      text-align: right;
      margin-top: 10px;
    }
    
    .add-button {
      padding: 8px 16px;
      background-color: #154360;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    
    .add-button:hover {
      background-color: #9370DB;
    }

    .delete-button {
      padding: 8px 16px;
      background-color: #FF0000;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    
    .delete-button:hover {
      background-color: #DC143C;
    }  </style>
</head>
<body style="background-image: url('/Test/pexels.jpg'); background-size: cover; background-position: center;">
  <div class="container">
    <h1 class="title">Liste des Cours</h1>
    <h2 class="title2">Première Année Bac Lettre	</h2>

    <table>
      <thead>
        <tr>
          <th>Nom du Cours</th>
          <th>Année Scolaire</th>
          <th>Branche</th>
          <th>Voir le chemin</th>
          <th>Supprimer</th>
        </tr>
      </thead>
      <tbody>
    
        <?php
        
        // Établir une connexion à la base de données
$conn = mysqli_connect('localhost', 'nztechma_nztech', '~#{[z2_}"&]', 'nztechma_nazihplatform');
        // Vérifier la connexion
        if (!$conn) {
            die('Erreur de connexion à la base de données : ' . mysqli_connect_error());
        }

        // Filtrage par année scolaire et branche
        $anneeScolaireFilter = "Première Année Bac";
        $brancheFilter = "Lettre";
        $filterQuery = " WHERE annee_scolaire = '$anneeScolaireFilter' AND branche = '$brancheFilter'";

        // Récupérer les données des cours depuis la table records avec filtre appliqué
        $sql = "SELECT nom_cours, annee_scolaire, branche, fichier FROM records" . $filterQuery;
        $result = mysqli_query($conn, $sql);

        // Afficher les données dans le tableau
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['nom_cours'] . '</td>';
                echo '<td>' . $row['annee_scolaire'] . '</td>';
                echo '<td>' . $row['branche'] . '</td>';
                echo '<td><a href="' . htmlspecialchars($row['fichier']) . '" download>Voir Le chemin  </a></td>';
                echo '<td><button class="delete-button" onclick="deleteCourse(' . $row['nom_cours'] . ')">Supprimer</button></td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="5">Aucun cours trouvé pour la branche ' . $brancheFilter . ' et l\'année scolaire ' . $anneeScolaireFilter . '</td></tr>';
        }

        // Fermer la connexion
        mysqli_close($conn);
        ?>
      </tbody>
    </table>
    
    <div class="button-container">
      <button class="add-button" onclick="location.href='/Test/ajouter_cours.html'">Ajouter un Cours</button>
      <button class="add-button" onclick="location.href='/Test/NazihProjet.html'">Retourner à la page d'accueil</button>
    </div>
  </div>

  <script>
    function deleteCourse(courseId) {
      // ... (Your deleteCourse function code remains the same)
    }
  </script>
</body>
</html>