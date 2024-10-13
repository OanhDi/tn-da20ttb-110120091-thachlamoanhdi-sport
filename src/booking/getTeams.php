<?php
session_start();
include('../includes/config.php');
error_reporting(0);
try {

    $emailID = $_POST['email_Id'];

    $sql = "SELECT t.* FROM `tblteams` t 
            INNER JOIN tblcustomers c on c.CustomerID = t.CustomerID
            INNER JOIN tblusers u on u.CustomerID = c.CustomerID
            where u.EmailId = :email";

    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $emailID);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    echo json_encode($results);

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
