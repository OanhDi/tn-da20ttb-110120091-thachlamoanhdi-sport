<?php
session_start();
include('../includes/config.php');
error_reporting(0);
try{
    $sql = "SELECT id,BannerTitle,Vimage1,Vimage2,Vimage3,Vimage4,Vimage5 FROM `tblbanners` WHERE STATUS = 1";
    $query = $dbh->prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($results);
}catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>