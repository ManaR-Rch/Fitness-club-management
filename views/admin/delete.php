<?php
require_once '../../classes/Activity.php';
include("../../database/connection.php");

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