<?php
session_start();
include('../includes/config.php');
error_reporting(0);
try {

    $fromTime = $_POST['fromtimeSelect'];
    $toTime = $_POST['totimeSelect'];
    $bkdate = $_POST['bkdateSelect'];
    $newDate = date('Y/m/d', strtotime(str_replace('/', '-', $bkdate)));
    $fieldType = $_POST['fieldTypeID'];
    $field = $_POST['fieldID'];
    if($field === 'null'){
      $field = NULL;
    }

    // IFNULL(NULL,fm.FieldID)
    $sql = "WITH a AS (
      SELECT 
          c.CustomerID,
          f.FieldName,
          c.CustomerName,
          fm.idfm,
    	  tm.idtm,
          bk.BookingDate,
          bk.BookingID,
          bk.Notes,
          IFNULL(bk.Status, 0) as Status,
          fm.FieldID,
          tm.NameMatch,
          tm.StartTime,
          tm.EndTime,
          t.CustomerTypeName,
          f.Size,
          f.MaxPlayers,
          f.Notes as NoteF,
          ft.TypeName,
          f.FieldGroup
      FROM `tblbookings` bk 
      RIGHT JOIN tblfieldmatch fm on bk.idfm = fm.idfm
      LEFT JOIN tblcustomers c on c.CustomerID = bk.CustomerID
      LEFT JOIN tblcustomertype t on t.CustomerTypeID = c.CustomerTypeID
      LEFT JOIN tblfields f on f.FieldID = fm.FieldID
      LEFT JOIN tblfieldtypes ft on ft.FieldTypeID = f.FieldTypeID
      LEFT JOIN tbltimematch tm on tm.idtm = fm.idtm
      WHERE ft.FieldTypeID = :fieldTypeID and fm.FieldID = IFNULL(:fieldID,fm.FieldID)
      AND tm.StartTime BETWEEN :startTime AND :endTime
      AND bk.BookingDate = :bookingDate
      ORDER BY f.FieldID, tm.StartTime ASC
    )
    SELECT * FROM a
    UNION
    SELECT 
      NULL AS CustomerID,
      f.FieldName,
      NULL AS CustomerName,
      fm.idfm,
      tm.idtm,
      NULL as BookingDate,
      NULL as BookingID,
      NULL as Notes,
      IFNULL(NULL, 0) as Status,
      fm.FieldID,
      tm.NameMatch,
      tm.StartTime,
      tm.EndTime,
      NULL AS CustomerTypeName,
      f.Size,
      f.MaxPlayers,
      f.Notes as NoteF,
      ft.TypeName,
      f.FieldGroup
    FROM `tblfieldmatch` fm
    LEFT JOIN tblbookings bk on bk.idfm = fm.idfm
    LEFT JOIN tblcustomers c on c.CustomerID = bk.CustomerID
    LEFT JOIN tblcustomertype t on t.CustomerTypeID = c.CustomerTypeID
    LEFT JOIN tblfields f on f.FieldID = fm.FieldID
    LEFT JOIN tblfieldtypes ft on ft.FieldTypeID = f.FieldTypeID
    LEFT JOIN tbltimematch tm on tm.idtm = fm.idtm
    WHERE  fm.idfm NOT IN (SELECT idfm FROM a)
    and ft.FieldTypeID = :fieldTypeID and fm.FieldID = IFNULL(:fieldID,fm.FieldID)
    AND tm.StartTime BETWEEN :startTime AND :endTime
    ORDER BY FieldID, StartTime ASC";

    $query = $dbh->prepare($sql);
    $query->bindParam(':startTime', $fromTime);
    $query->bindParam(':endTime', $toTime);
    $query->bindParam(':bookingDate', $newDate);
    $query->bindParam(':fieldTypeID', $fieldType);
    $query->bindParam(':fieldID', $field);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    echo json_encode($results);

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
