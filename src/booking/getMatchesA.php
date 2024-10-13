<?php
session_start();
include('../includes/config.php');
error_reporting(0);
try{
    $email = $_POST['emailId'];
    $idfm = $_POST['Id_fm'];
    $date = $_POST['Bkdate'];
    $newDate = date('Y/m/d', strtotime(str_replace('/', '-', $date)));
    $sql = "SELECT * FROM tblbookings bk 
            INNER JOIN tblcustomers c on c.CustomerID = bk.CustomerID
            INNER JOIN tblusers u on u.CustomerID = c.CustomerID
            WHERE u.EmailId = :emailID AND bk.idfm = :idfm AND bk.BookingDate = :date";
    $query = $dbh->prepare($sql);
    $query->bindParam(':emailID', $email);
    $query->bindParam(':date', $newDate);
    $query->bindParam(':idfm', $idfm);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($results);
}catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>