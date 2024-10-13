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
    
    // Lấy danh sách các FieldID và idtm từ $results_check
    $fieldIdTmList = [];
    $sqlcheck = "SELECT bk.*,f.FieldID,f.FieldName,f.FieldGroup,tm.idtm,tm.NameMatch FROM tblbookings bk
    INNER JOIN tblfieldmatch fm ON fm.idfm = bk.idfm
    INNER JOIN tbltimematch tm ON tm.idtm = fm.idtm
    INNER JOIN tblfields f ON f.FieldID = fm.FieldID
    INNER JOIN tblfieldtypes ft ON ft.FieldTypeID = f.FieldTypeID
    WHERE bk.BookingDate = :bookingDate AND ft.FieldTypeID = '1' AND (f.FieldGroup IS NULL OR f.FieldGroup = '')";
    $query_check = $dbh->prepare($sqlcheck);
    $query_check->bindParam(':bookingDate', $newDate);
    $query_check->execute();
    $results_check = $query_check->fetchAll(PDO::FETCH_OBJ);

    if ($results_check) {
        foreach ($results_check as $row) {
            $fieldIdTmList[] = [
                'FieldID' => $row->FieldID,
                'idtm' => $row->idtm
            ];
        }
    }

    // Chuyển đổi danh sách $fieldIdTmList thành một chuỗi để sử dụng trong SQL
    $conditions = [];
    foreach ($fieldIdTmList as $item) {
        $conditions[] = "(f.FieldGroup = " . $item['FieldID'] . " AND tm.idtm = " . $item['idtm'] . ")";
    }
    $conditionString = implode(' OR ', $conditions);
    if (!$results_check){
      $conditionString = '0 = 1';
    }

    // Truy vấn SQL với cột enable_flag
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
          f.FieldGroup,
          CASE 
            WHEN $conditionString THEN 'disable'
            ELSE 'enable'
          END as enable_flag
      FROM `tblbookings` bk 
      RIGHT JOIN tblfieldmatch fm on bk.idfm = fm.idfm
      LEFT JOIN tblcustomers c on c.CustomerID = bk.CustomerID
      LEFT JOIN tblcustomertype t on t.CustomerTypeID = c.CustomerTypeID
      LEFT JOIN tblfields f on f.FieldID = fm.FieldID
      LEFT JOIN tblfieldtypes ft on ft.FieldTypeID = f.FieldTypeID
      LEFT JOIN tbltimematch tm on tm.idtm = fm.idtm
      WHERE ft.FieldTypeID = :fieldTypeID and fm.FieldID = IFNULL(:fieldID,fm.FieldID)
      AND tm.StartTime BETWEEN :startTime AND :endTime
      AND bk.BookingDate = :bookingDate AND f.FieldGroup IS NOT NULL AND f.FieldGroup <> ''
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
      f.FieldGroup,
      CASE 
        WHEN $conditionString THEN 'disabled'
        ELSE 'enable'
      END as enable_flag
    FROM `tblfieldmatch` fm
    LEFT JOIN tblbookings bk on bk.idfm = fm.idfm
    LEFT JOIN tblcustomers c on c.CustomerID = bk.CustomerID
    LEFT JOIN tblcustomertype t on t.CustomerTypeID = c.CustomerTypeID
    LEFT JOIN tblfields f on f.FieldID = fm.FieldID
    LEFT JOIN tblfieldtypes ft on ft.FieldTypeID = f.FieldTypeID
    LEFT JOIN tbltimematch tm on tm.idtm = fm.idtm
    WHERE  fm.idfm NOT IN (SELECT idfm FROM a)
    and ft.FieldTypeID = :fieldTypeID and fm.FieldID = IFNULL(:fieldID,fm.FieldID)
    AND tm.StartTime BETWEEN :startTime AND :endTime AND f.FieldGroup IS NOT NULL AND f.FieldGroup <> ''
    ORDER BY FieldID, StartTime ASC";
    // echo $sql;
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
