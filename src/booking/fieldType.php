<?php
session_start();
include('../includes/config.php');
error_reporting(0);
try{
    $sql = "SELECT * FROM tblfieldtypes";
    $query = $dbh->prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($results);
}catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>