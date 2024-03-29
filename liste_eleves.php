<!DOCTYPE html>
<html>
<head>
  <title>Liste des élèves</title>
  <style>
<style>
 body {
      font-family: Arial, sans-serif;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
    }

    .title {
      text-align: center;
      color: #154360;
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
    .filter-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .filter-label {
      font-weight: bold;
    }

    .filter-select {
      padding: 8px;
      border-radius: 4px;
    }
  </style>  </style>
</head>
<body style="background-image: url('telecharger.png'); background-size: cover; background-position: center;">
  <div class="container">
    <h1 class="title">Liste des élèves</h1>
    <div class="filter-container">
    <div>
        <label class="filter-label" for="brancheFilter">Filtrer par Branche :</label>
        <select class="filter-select" id="brancheFilter" onchange="applyFilters()">
          <option value="">Toutes les branches</option>
          <option value="Science Math">Science Math</option>
          <option value="Science Ex">Science Ex</option>
          <option value="Lettre">Lettre</option>
          <option value="Science">Science</option>
        </select>
      </div>
      <div>
        <label class="filter-label" for="anneeScolaireFilter">Filtrer par Année Scolaire :</label>
        <select class="filter-select" id="anneeScolaireFilter" onchange="applyFilters()">
          <option value="">Toutes les années scolaires</option>
          <option value="Tronc Commun">Tronc Commun</option>
          <option value="Première Année Bac">Première Année Bac</option>
          <option value="Deuxième Année Bac">Deuxième Année Bac</option>
        </select>
      </div>    </div>
    <table>
      <thead>
        <tr>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Branche</th>
          <th>Année Scolaire</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Create a connection to the database
        $conn = mysqli_connect('localhost', 'nztechma_nztech', '~#{[z2_}"&]', 'nztechma_nazihplatform');
        // Check the connection
        if (!$conn) {
          die('Erreur de connexion à la base de données : ' . mysqli_connect_error());
        }

        // Filtrage par branche et par année scolaire (si des valeurs sont fournies)
        $brancheFilter = $_GET['branche'] ?? '';
        $anneeScolaireFilter = $_GET['annee_scolaire'] ?? '';
        $filterQuery = "";
        if (!empty($brancheFilter) && !empty($anneeScolaireFilter)) {
          $filterQuery = " WHERE branche = '$brancheFilter' AND annee_scolaire = '$anneeScolaireFilter'";
        } elseif (!empty($brancheFilter)) {
          $filterQuery = " WHERE branche = '$brancheFilter'";
        } elseif (!empty($anneeScolaireFilter)) {
          $filterQuery = " WHERE annee_scolaire = '$anneeScolaireFilter'";
        }

        // Prepare the SQL query to select filtered data from the table
        $sql = "SELECT nom, prenom, branche, annee_scolaire FROM eleves" . $filterQuery;
        $result = mysqli_query($conn, $sql);

        // Check if there are rows in the result
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['nom'] . '</td>';
            echo '<td>' . $row['prenom'] . '</td>';
            echo '<td>' . $row['branche'] . '</td>';
            echo '<td>' . $row['annee_scolaire'] . '</td>';
            echo '</tr>';
          }
        } else {
          echo '<tr><td colspan="4">Aucun élève trouvé dans la base de données.</td></tr>';
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
      </tbody>
    </table>
    <div class="button-container">
      <button class="add-button" onclick="location.href='ajouter_eleve.html'">Ajouter un nouveau eleve</button>
      <button class="add-button" onclick="location.href='NazihProjet.html'">Retourner à la page d'accueil</button>
    </div>
  </div>
  <script>
    function applyFilters() {
      const brancheFilter = document.getElementById("brancheFilter").value;
      const anneeScolaireFilter = document.getElementById("anneeScolaireFilter").value;
      let queryString = "";
      if (brancheFilter || anneeScolaireFilter) {
        queryString += "?";
        if (brancheFilter) {
          queryString += "branche=" + encodeURIComponent(brancheFilter);
        }
        if (anneeScolaireFilter) {
          if (brancheFilter) {
            queryString += "&";
          }
          queryString += "annee_scolaire=" + encodeURIComponent(anneeScolaireFilter);
        }
      }
      window.location.href = `liste_eleves.php${queryString}`;
    }
  </script>
</body>
</html>

