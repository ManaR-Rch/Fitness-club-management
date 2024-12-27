<?php
include("../../classes/Activity.php");
require_once './../../classes/User.php';
session_start();

if(!User::isAllowed('admin')){
  header('Location: ./../auth/sign-in.php');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $capacite = $_POST['capacite'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $disponibilite = $_POST['disponibilite'];

    $activity = new Activity(null, $titre, $description, $capacite, $date_debut, $date_fin, $disponibilite);
    $activity->AjouterActivite();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'activité</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">Créer une activité</h2>
        
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="mb-4">
                <label for="titre" class="block text-gray-700">Titre de l'activité</label>
                <input type="text" id="titre" name="titre" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
            </div>
            
            <div class="mb-4">
                <label for="description" class="block text-gray-700">Description</label>
                <textarea id="description" name="description" class="w-full px-4 py-2 border border-gray-300 rounded-md" rows="4"></textarea>
            </div>

            <div class="mb-4">
                <label for="capacite" class="block text-gray-700">Capacité</label>
                <input type="number" id="capacite" name="capacite" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="date_debut" class="block text-gray-700">Date de début</label>
                <input type="date" id="date_debut" name="date_debut" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="date_fin" class="block text-gray-700">Date de fin</label>
                <input type="date" id="date_fin" name="date_fin" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="disponibilite" class="block text-gray-700">Disponibilité</label>
                <select id="disponibilite" name="disponibilite" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                    <option value="1">Disponible</option>
                    <option value="0">Non disponible</option>
                </select>
            </div>

            <div class="mb-4 text-center">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Soumettre</button>
            </div>
        </form>
    </div>
</body>
</html>

</body>
</html>