<?php
session_start();
include('../includes/config.php');
error_reporting(0);
try {

    $idfm = $_POST['iDfm'];
    $date = $_POST['date_booking'];

    $sql = "SELECT * FROM tblmatches m
            WHERE m.HomeTeamID IN (SELECT bk.AwayTeam FROM tblbookings bk
            WHERE bk.idfm = :idfm AND bk.BookingDate = :date) AND m.Status = '4'
            UNION 
            SELECT * FROM tblmatches mc
            WHERE mc.AwayTeamID IN (SELECT bk.AwayTeam FROM tblbookings bk WHERE
            bk.idfm = :idfm AND bk.BookingDate = :date) AND mc.Status = '4'";

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
