<?php
// Paramètres de connexion
$host = 'localhost'; // Adresse du serveur (ou 127.0.0.1)
$dbname = 'recette_aurelien'; // Nom de la base de données
$username = 'root'; // Nom d'utilisateur MySQL
$password = ''; // Mot de passe MySQL

// Connexion à la base de données
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Requête pour récupérer les données
try {
    $stmt = $pdo->query("SELECT * FROM recettes");
    $recettes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la récupération des données : " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Recettes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }
        h1 {
            color: #444;
        }
        .recette {
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #fff;
        }
        .recette h2 {
            margin: 0;
            font-size: 1.2em;
            color: #007BFF;
        }
    </style>
</head>
<body>
    <h1>Liste des Recettes</h1>
    <?php if (!empty($recettes)) : ?>
        <?php foreach ($recettes as $recette) : ?>
            <div class="recette">
                <h2><?php echo htmlspecialchars($recette['nom_recette']); ?></h2>
                <p>ID Recette : <?php echo htmlspecialchars($recette['id_recette']); ?></p>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Aucune recette trouvée.</p>
    <?php endif; ?>
</body>
</html>
