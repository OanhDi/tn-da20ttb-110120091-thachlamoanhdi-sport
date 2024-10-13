<?php
session_start();
include ('../includes/config.php');
error_reporting(0);
try {
    $BookingDate = $_POST['BookingDate'];
    $fieldtypeid = $_POST['fieldTypeID'];
    $fieldid = $_POST['fieldid'] === 'null' ? NULL : $_POST['fieldid'];
    $starttime = $_POST['starttime'] === 'null' ? NULL : $_POST['starttime'];
    $endtime = $_POST['endtime'] === 'null' ? NULL : $_POST['endtime'];
    $newDate = date('Y/m/d', strtotime(str_replace('/', '-', $BookingDate)));
    $sql = "SELECT f.FieldID, 
       f.FieldName, 
       m.MatchID, 
       bk.BookingID, 
       t_home.TeamName AS HomeTeamName, 
       t_home.FlagImage AS HomeTeamFlagImage, 
       t_home.FlagName AS HomeTeamFlagName, 
       t_away.TeamName AS AwayTeamName, 
       t_away.FlagImage AS AwayTeamFlagImage, 
       t_away.FlagName AS AwayTeamFlagName, 
       bk.BookingDate, 
       tm.NameMatch, 
       m.ScoreTeamHome, 
       m.ScoreTeamAway,
       e.EmployeeName AS Referee,
       bk.Status
FROM tblbookings bk 
INNER JOIN tblcustomers c_home ON c_home.CustomerID = bk.CustomerID 
INNER JOIN tblteams t_home ON t_home.CustomerID = c_home.CustomerID 
INNER JOIN tblbookings bkk ON bkk.BookingID = bk.BookingID 
INNER JOIN tblcustomers c_away ON c_away.CustomerID = bkk.AwayTeam 
INNER JOIN tblteams t_away ON t_away.CustomerID = c_away.CustomerID 
INNER JOIN tblmatches m ON m.BookingID = bk.BookingID
LEFT JOIN tblemployees e ON e.EmployeeID = m.EmployeeID
INNER JOIN tblfieldmatch fm ON fm.idfm = bk.idfm 
INNER JOIN tblfields f ON f.FieldID = fm.FieldID 
INNER JOIN tblfieldtypes ft ON ft.FieldTypeID = f.FieldTypeID 
INNER JOIN tbltimematch tm ON tm.idtm = fm.idtm 
WHERE bk.Status IN ('3','4') 
  AND bk.BookingDate = :BookingDate
  AND ft.FieldTypeID = :fieldtypeid
  AND f.FieldID = IFNULL(:fieldid,f.FieldID) 
  AND tm.StartTime >= IFNULL(:starttime,tm.StartTime) 
  AND tm.StartTime <= IFNULL(:endtime,tm.StartTime) 
ORDER BY ft.FieldTypeID,f.FieldID,tm.StartTime ASC;";
    $query = $dbh->prepare($sql);
    $query->bindParam(':BookingDate', $newDate);
    $query->bindParam(':fieldtypeid', $fieldtypeid);
    $query->bindParam(':fieldid', $fieldid);
    $query->bindParam(':starttime', $starttime);
    $query->bindParam(':endtime', $endtime);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($results);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>