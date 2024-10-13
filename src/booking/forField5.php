<?php
session_start();
include('../includes/config.php');
error_reporting(0);
try {

    $fromTime = $_POST['fromtimeSelect'];
    $toTime = $_POST['totimeSelect'];
    $bkdate = $_POST['bkdateSelect'];
    $fieldType = $_POST['fieldType'];
    $sql = "WITH a AS (
       SELECT 
          fm.idfm,
          fm.FieldID
      FROM `tblbookings` bk 
      RIGHT JOIN tblfieldmatch fm on bk.idfm = fm.idfm
      LEFT JOIN tblcustomers c on c.CustomerID = bk.CustomerID
      LEFT JOIN tblcustomertype t on t.CustomerTypeID = c.CustomerTypeID
      LEFT JOIN tblfields f on f.FieldID = fm.FieldID
      LEFT JOIN tblfieldtypes ft on ft.FieldTypeID = f.FieldTypeID
      LEFT JOIN tbltimematch tm on tm.idtm = fm.idtm 
      WHERE ft.FieldTypeID = :fieldtype 
      AND tm.StartTime BETWEEN :startTime AND :endTime
      AND bk.BookingDate = :bookingDate AND f.FieldGroup IS NOT NULL AND f.FieldGroup <> ''
      ORDER BY f.FieldID
    )
    SELECT DISTINCT a.FieldID FROM a
    UNION
    SELECT DISTINCT fm.FieldID     
    FROM `tblfieldmatch` fm
    LEFT JOIN tblbookings bk on bk.idfm = fm.idfm
    LEFT JOIN tblcustomers c on c.CustomerID = bk.CustomerID
    LEFT JOIN tblcustomertype t on t.CustomerTypeID = c.CustomerTypeID
    LEFT JOIN tblfields f on f.FieldID = fm.FieldID
    LEFT JOIN tblfieldtypes ft on ft.FieldTypeID = f.FieldTypeID
    LEFT JOIN tbltimematch tm on tm.idtm = fm.idtm 
    WHERE fm.idfm NOT IN (SELECT idfm FROM a)
    and ft.FieldTypeID = :fieldtype
    AND tm.StartTime BETWEEN :startTime AND :endTime AND f.FieldGroup IS NOT NULL AND f.FieldGroup <> ''
    ORDER BY FieldID";

    $query = $dbh->prepare($sql);
    $query->bindParam(':startTime', $fromTime);
    $query->bindParam(':endTime', $toTime);
    $query->bindParam(':bookingDate', $bkdate);
    $query->bindParam(':fieldtype', $fieldType);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    echo json_encode($results);

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
