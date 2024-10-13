<?php
session_start();
include('../includes/config.php');
error_reporting(0);
try {

    $idfm = $_POST['iDfm'];
    $date = $_POST['date_booking'];
    $sql = "SELECT m.*
            FROM tblmatches m
            INNER JOIN tblteams t ON t.TeamID = m.HomeTeamID
            INNER JOIN tblbookings bk ON bk.CustomerID = t.CustomerID
            INNER JOIN tblcustomers c ON c.CustomerID = bk.CustomerID
            INNER JOIN tblusers u ON u.CustomerID = c.CustomerID
            WHERE bk.idfm = :idfm AND bk.BookingDate = :date AND m.Status = '4'
            UNION
            SELECT m.*
            FROM tblmatches m
            INNER JOIN tblteams t ON t.TeamID = m.AwayTeamID
            INNER JOIN tblbookings bk ON bk.CustomerID = t.CustomerID
            INNER JOIN tblcustomers c ON c.CustomerID = bk.CustomerID
            INNER JOIN tblusers u ON u.CustomerID = c.CustomerID
            WHERE bk.idfm = :idfm AND bk.BookingDate = :date AND m.Status = '4';";

    $query = $dbh->prepare($sql);
    $query->bindParam(':idfm', $idfm);
    $query->bindParam(':date', $date);

    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    echo json_encode($results);

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
