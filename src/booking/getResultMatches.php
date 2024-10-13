<?php
session_start();
include('../includes/config.php');
error_reporting(0);
try {

    $emailID = $_POST['email_Id'];

    $sql = "SELECT m.*
            FROM tblmatches m
            INNER JOIN tblteams t ON t.TeamID = m.HomeTeamID
            INNER JOIN tblcustomers c ON c.CustomerID = t.CustomerID
            INNER JOIN tblusers u ON u.CustomerID = c.CustomerID
            WHERE u.EmailId = :email AND m.Status = '4'
            UNION
            SELECT m.*
            FROM tblmatches m
            INNER JOIN tblteams t ON t.TeamID = m.AwayTeamID
            INNER JOIN tblcustomers c ON c.CustomerID = t.CustomerID
            INNER JOIN tblusers u ON u.CustomerID = c.CustomerID
            WHERE u.EmailId = :email AND m.Status = '4';";

    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $emailID);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    echo json_encode($results);

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
