<?php
session_start();
include('../includes/config.php');
error_reporting(0);
try {

    $fromTime = $_POST['fromtimeSelect'];
    $toTime = $_POST['totimeSelect'];
    $bkdate = $_POST['bkdateSelect'];
    $fieldType = $_POST['fieldTypeID'];
    // $field = $_POST['fieldID'];
    if (isset($_POST['fieldID'])) {
      $field = $_POST['fieldID'];
    } else {
        $field = 1; 
    }
    // IFNULL(NULL,fm.FieldID)
    $sql = "WITH a AS (
      SELECT DISTINCT tm.idtm
      FROM `tblbookings` bk 
      RIGHT JOIN tblfieldmatch fm on bk.idfm = fm.idfm
      LEFT JOIN tblcustomers c on c.CustomerID = bk.CustomerID
      LEFT JOIN tblcustomertype t on t.CustomerTypeID = c.CustomerTypeID
      LEFT JOIN tblfields f on f.FieldID = fm.FieldID
      LEFT JOIN tblfieldtypes ft on ft.FieldTypeID = f.FieldTypeID
      LEFT JOIN tbltimematch tm on tm.idtm = fm.idtm
      WHERE ft.FieldTypeID = :fieldTypeID and fm.FieldID = IFNULL(NULL,fm.FieldID)
      AND tm.StartTime BETWEEN :startTime AND :endTime
      AND bk.BookingDate = :bookingDate
    )
    SELECT * FROM a
    UNION
    SELECT DISTINCT  tm.idtm
    FROM `tblfieldmatch` fm
    LEFT JOIN tblbookings bk on bk.idfm = fm.idfm
    LEFT JOIN tblcustomers c on c.CustomerID = bk.CustomerID
    LEFT JOIN tblcustomertype t on t.CustomerTypeID = c.CustomerTypeID
    LEFT JOIN tblfields f on f.FieldID = fm.FieldID
    LEFT JOIN tblfieldtypes ft on ft.FieldTypeID = f.FieldTypeID
    LEFT JOIN tbltimematch tm on tm.idtm = fm.idtm
    WHERE tm.idtm NOT IN (SELECT idtm FROM a)
    and ft.FieldTypeID = :fieldTypeID and fm.FieldID = IFNULL(NULL,fm.FieldID)
    AND tm.StartTime BETWEEN :startTime AND :endTime
    ORDER BY idtm ASC";

    $query = $dbh->prepare($sql);
    $query->bindParam(':startTime', $fromTime);
    $query->bindParam(':endTime', $toTime);
    $query->bindParam(':bookingDate', $bkdate);
    $query->bindParam(':fieldTypeID', $fieldType);
    $query->bindParam(':fieldID', $field);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    echo json_encode($results);

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
