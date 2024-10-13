<?php
session_start();
include('../includes/config.php');
error_reporting(0);
try{
    $email = $_POST['emailId'];
    $sql = "SELECT c.CustomerID, c.CustomerName, u.EmailId FROM `tblusers` u 
    INNER JOIN tblcustomers c ON u.CustomerID = c.CustomerID
    WHERE u.EmailId = :emailID";
    $query = $dbh->prepare($sql);
    $query->bindParam(':emailID', $email);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($results);
}catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>