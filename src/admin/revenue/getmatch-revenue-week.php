<?php
session_start();
include ('../includes/config.php');
error_reporting(0);
try {
    $Field = ($_POST['Field'] === 'null' || $_POST['Field'] === '') ? NULL : $_POST['Field'];
    $startDate = ($_POST['startDate'] === 'null' || $_POST['startDate'] === '') ? NULL : $_POST['startDate'];
    $endDate = ($_POST['endDate'] === 'null' || $_POST['endDate'] === '') ? NULL : $_POST['endDate'];
    $FieldType = ($_POST['FieldType'] === 'null' || $_POST['FieldType'] === '') ? NULL : $_POST['FieldType'];
    $Revenue = ($_POST['Revenue'] === 'null' || $_POST['Revenue'] === '') ? NULL : $_POST['Revenue'];
    if ($startDate !== NULL || $startDate !== '') {
        $startDate = date('Y/m/d', strtotime(str_replace('/', '-', $startDate)));
    }
    if ($endDate !== NULL || $endDate !== '') {
        $endDate = date('Y/m/d', strtotime(str_replace('/', '-', $endDate)));
    }
    //   echo $Field .''. $startDate .''. $endDate .''. $FieldType .''. $Revenue .'';
    $sql = "SELECT WeekOfMonth, 
       SUM(TotalAmount) AS TotalAmount, Description, FieldName, TypeName
FROM (
    SELECT DATE(pm.CreateDate) AS CreateDate, 
           FLOOR((DAY(DATE(pm.CreateDate)) - 1) / 7) + 1 AS WeekOfMonth,
           TotalAmount, 
           'Doanh Thu Thuê Sân' AS Description, 
           'dtts' AS id_description, 
           '' AS FieldName, 
           '' AS TypeName 
    FROM tblmatchpayments pm
    INNER JOIN tblmatches m ON m.MatchID = pm.MatchID
    INNER JOIN tblbookings bk ON bk.BookingID = m.BookingID
    INNER JOIN tblfieldmatch fm ON fm.idfm = bk.idfm
    INNER JOIN tblfields f ON f.FieldID = fm.FieldID
    INNER JOIN tblfieldtypes ft ON ft.FieldTypeID = f.FieldTypeID 
    WHERE f.FieldID = IFNULL(:Field, f.FieldID) 
      AND ft.FieldTypeID = IFNULL(:FieldType, ft.FieldTypeID)
    UNION ALL 
    SELECT DATE(CreateDate) AS CreateDate, 
           FLOOR((DAY(DATE(CreateDate)) - 1) / 7) + 1 AS WeekOfMonth,
           TotalPrice AS TotalAmount, 
           'Doanh Thu Dịch Vụ' AS Description, 
           'dtdv' AS id_description, 
           '' AS FieldName, 
           '' AS TypeName
    FROM tbldrinkorder
    UNION ALL
    SELECT DATE(created_date) AS CreateDate, 
           FLOOR((DAY(DATE(created_date)) - 1) / 7) + 1 AS WeekOfMonth,
           total_amount AS TotalAmount, 
           'Doanh Thu Bán Hàng' AS Description, 
           'dtbh' AS id_description, 
           '' AS FieldName, 
           '' AS TypeName 
    FROM tblorder
) a
WHERE a.id_description = IFNULL(:Revenue, a.id_description)
  AND a.CreateDate BETWEEN IFNULL(:startDate, a.CreateDate) 
                        AND IFNULL(:endDate, a.CreateDate)
GROUP BY WeekOfMonth, id_description
ORDER BY WeekOfMonth, id_description;
";
    $query = $dbh->prepare($sql);
    $query->bindParam(':startDate', $startDate);
    $query->bindParam(':endDate', $endDate);
    $query->bindParam(':Revenue', $Revenue);
    $query->bindParam(':Field', $Field);
    $query->bindParam(':FieldType', $FieldType);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($results);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>