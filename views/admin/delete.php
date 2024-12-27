<?php
require_once '../../classes/Activity.php';
require_once '../../classes/User.php';
session_start();

if(!User::isAllowed('admin')){
  header('Location: ./../auth/sign-in.php');
}

if (isset($_GET['id'])) {
    $id_activite = $_GET['id'];

    if (filter_var($id_activite, FILTER_VALIDATE_INT)) {
        $activite = new Activity($id_activite, "", "", 0, "", "", 0);

        $activite->SupprimerActivite();
    } else {
        echo "id pas trouvé";
    }
} else {
    echo "id pas trouvé";
}
header("Location: activity_table.php");
exit();
?>