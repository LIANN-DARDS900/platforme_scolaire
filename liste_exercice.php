<!DOCTYPE html>
<meta charset="UTF-8">

<html>
<head>
  <style>
    body {
      font-family: Arial, sans-serif;
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
      color: white;
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
    }
  </style>
</head>
<body style="background-image: url('telecharger.png'); background-size: cover; background-position: center;">
  <div class="container">
    <h1 class="title">Liste des Exercices</h1>
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

        // Filtrage par année scolaire et branche (si des valeurs sont fournies)
        $anneeScolaireFilter = $_GET['annee_scolaire'] ?? '';
        $brancheFilter = $_GET['branche'] ?? '';
        $filterQuery = "";
        if (!empty($anneeScolaireFilter) && !empty($brancheFilter)) {
          $filterQuery = " WHERE annee_scolaire = '$anneeScolaireFilter' AND branche = '$brancheFilter'";
        } elseif (!empty($anneeScolaireFilter)) {
          $filterQuery = " WHERE annee_scolaire = '$anneeScolaireFilter'";
        } elseif (!empty($brancheFilter)) {
          $filterQuery = " WHERE branche = '$brancheFilter'";
        }

        // Récupérer les données des cours depuis la table records avec filtre appliqué
        $sql = "SELECT nom_exercice, annee_scolaire, branche, fichier FROM exercice" . $filterQuery;
        $result = mysqli_query($conn, $sql);

        // Afficher les données dans le tableau
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['nom_exercice'] . '</td>';
                echo '<td>' . $row['annee_scolaire'] . '</td>';
                echo '<td>' . $row['branche'] . '</td>';
                echo '<td><a href="' . htmlspecialchars($row['fichier']) . '" download>Voir Le chemin  </a></td>';
                echo '<td><button class="delete-button" onclick="deleteCourse(' . $row['nom_exercice'] . ')">Supprimer</button></td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="5">Aucun cours trouvé</td></tr>';
        }

        // Fermer la connexion
        mysqli_close($conn);
        ?>
      </tbody>
    </table>
    
    <div class="button-container">
      <button class="add-button" onclick="location.href='ajouter_exercice.html'">Ajouter un Exercice</button>
      <button class="add-button" onclick="location.href='NazihProjet.html'">Retourner à la page d'accueil</button>
    </div>
  </div>

  <script>
    function deleteCourse(courseId) {
      var confirmation = confirm("Êtes-vous sûr de vouloir supprimer ce cours ?");
      if (confirmation) {
        // Effectuer une requête AJAX pour supprimer le cours de la base de données
        // et recharger la page après la suppression
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            location.reload();
          }
        };
        xhttp.open("GET", "supprimer_cours.php?id=" + courseId, true);
        xhttp.send();
      }
    }
  </script>
</body>
</html>
