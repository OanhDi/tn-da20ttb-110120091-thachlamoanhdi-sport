<?php
session_start();
include ('../includes/config.php');
error_reporting(0);
try {
    $matchID = $_POST['matchID'];
    
    $sql = "SELECT * FROM tblmatchpayments WHERE MatchID = :matchid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':matchid', $matchID);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($results);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>