<?php
session_start();
include('../includes/config.php');
error_reporting(0);
try {

    $Idtm = $_POST['id_tm'];
    $sql = "SELECT * FROM `tbltimematch` 
            WHERE idtm = :idtm";

    $query = $dbh->prepare($sql);
    $query->bindParam(':idtm', $Idtm);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    echo json_encode($results);

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
