<?php
session_start();
include('../includes/config.php');
error_reporting(0);
try {

    $idfm = $_POST['iDfm'];
    $date = $_POST['date_booking'];
    // echo "iDfm: " . $idfm . "\n";
    // echo "Date: " . $date . "\n";

    $sql = "SELECT t.* FROM tblteams t
            INNER JOIN tblbookings bk on bk.AwayTeam = t.CustomerID
            WHERE bk.idfm = :id_fm AND bk.BookingDate = :datebk ";

    $query = $dbh->prepare($sql);
    $query->bindParam(':id_fm', $idfm);
    $query->bindParam(':datebk', $date);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    // var_dump($results);
    // echo "Query Results: ";
    // print_r($results);
    echo json_encode($results);

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
