<?php

require_once '../../classes/Activity.php';
require_once './../../classes/User.php';
session_start();

if(!User::isAllowed('admin')){
  header('Location: ./../auth/sign-in.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['id_activite'])) {
        $id_activite = $_POST['id_activite'];
    } else {
        die("id pas trouvé");
    }

  
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $capacite = $_POST['capacite'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $disponibilite = $_POST['disponibilite'];

  
    $activity = new Activity($id_activite, $titre, $description, $capacite, $date_debut, $date_fin, $disponibilite);


    $activity->ModifierActivite();


    echo "<p> 
            modification avec succès.
    </p>";
    header("Location: activity_table.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> modification un activité </title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full max-w-lg">
        <h1 class="text-2xl font-bold text-center mb-6">Modifier un activité</h1>
        <form action="modification.php" method="POST">
            <input type="hidden" name="id_activite" value="<?php echo htmlspecialchars($_GET['id']); ?>">

            <div class="mb-4">
                <label for="titre" class="block text-gray-700 text-sm font-bold mb-2">Titre :</label>
                <input type="text" name="titre" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description :</label>
                <textarea name="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
            </div>

            <div class="mb-4">
                <label for="capacite" class="block text-gray-700 text-sm font-bold mb-2">Capacité :</label>
                <input type="number" name="capacite" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="date_debut" class="block text-gray-700 text-sm font-bold mb-2">Date début :</label>
                <input type="date" name="date_debut" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="date_fin" class="block text-gray-700 text-sm font-bold mb-2">Date fin :</label>
                <input type="date" name="date_fin" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="disponibilite" class="block text-gray-700 text-sm font-bold mb-2">Disponibilité :</label>
                <select name="disponibilite" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="disponible">Disponible</option>
                    <option value="indisponible">Indisponible</option>
                </select>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Modifier</button>
            </div>
        </form>
    </div>
</body>
</html>
