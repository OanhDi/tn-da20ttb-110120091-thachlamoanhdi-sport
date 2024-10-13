<?php
session_start();
include('../includes/config.php');
error_reporting(0);
try{
    $email = $_POST['emailId'];
    $sql = "SELECT m.* FROM `tblmatches` m 
            INNER JOIN tblbookings bk on bk.BookingID = m.BookingID
            INNER JOIN tblteams t on t.TeamID = m.AwayTeamID
            INNER JOIN tblcustomers c on c.CustomerID = t.CustomerID
            INNER JOIN tblusers u on u.CustomerID = c.CustomerID
            WHERE u.EmailId = :emailID 
            ";
    $query = $dbh->prepare($sql);
    $query->bindParam(':emailID', $email);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($results);
}catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>