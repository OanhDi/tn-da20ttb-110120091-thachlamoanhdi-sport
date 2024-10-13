<?php
session_start();
include ('../includes/config.php');
error_reporting(0);

$per_page = isset($_GET['per_page']) ? intval($_GET['per_page']) : 10; // Số lượng bản ghi trên mỗi trang
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Trang hiện tại
$CustomerID = isset($_SESSION['CustomerID']) ? intval($_SESSION['CustomerID']) : 0;
$Bkdate = $_GET['bk_date'];
if($Bkdate !== ''){
    $date = DateTime::createFromFormat('d/m/Y', $Bkdate);
    if ($date) {
        $newDate = $date->format('Y/m/d');
    } else {
        echo "Invalid date format";
    }
}else{
    $newDate = null;
}
$offset = ($page - 1) * $per_page; // Tính toán offset
//  echo "<script>alert('" . $newDate . "');</script>";
$response = [
    'data' => [],
    'total' => 0,
    'error' => ''
];

try {
    $sql = "SELECT 
    rm.BookingID,
    t_home.CustomerID AS ID_Home,
    t_home.TeamName AS TeamHome,
    t_away.TeamName AS TeamAway,
    t_away.CustomerID AS ID_Away,
    f.FieldName,
    rm.BookingDate,
    tm.NameMatch,
    m.ScoreTeamHome,
    m.ScoreTeamAway, 
    CASE 
        WHEN rm.Status = '0' THEN 'Trận bị từ chối' 
        ELSE 'Trạng thái không xác định'
    END AS Status 
FROM 
    tblrejectmatch rm
INNER JOIN 
    tblteams t_home ON t_home.TeamID = rm.HomeTeam
LEFT JOIN 
    tblteams t_away ON t_away.CustomerID = rm.AwayTeam
LEFT JOIN 
    tblmatches m ON m.BookingID = rm.BookingID
INNER JOIN 
    tblfieldmatch fm ON fm.idfm = rm.idfm
INNER JOIN 
    tbltimematch tm ON tm.idtm = fm.idtm
INNER JOIN 
    tblfields f ON f.FieldID = fm.FieldID
WHERE  rm.AwayTeam = :customerID AND rm.BookingDate = IFNULL(:Bkdate,rm.BookingDate)
ORDER BY 
    f.FieldName, tm.StartTime ASC LIMIT :offset, :per_page";
    $query = $dbh->prepare($sql);
    $query->bindParam(':offset', $offset, PDO::PARAM_INT);
    $query->bindParam(':per_page', $per_page, PDO::PARAM_INT);
    $query->bindParam(':customerID', $CustomerID, PDO::PARAM_INT);
    $query->bindParam(':Bkdate', $newDate, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $response['data'] = $results;

    // Lấy tổng số bản ghi
    $count_sql = "SELECT 
    COUNT(*) AS total
FROM (
    SELECT 
    rm.BookingID,
    t_home.CustomerID AS ID_Home,
    t_home.TeamName AS TeamHome,
    t_away.TeamName AS TeamAway,
    t_away.CustomerID AS ID_Away,
    f.FieldName,
    rm.BookingDate,
    tm.NameMatch,
    m.ScoreTeamHome,
    m.ScoreTeamAway, 
    CASE 
        WHEN rm.Status = '0' THEN 'Trận bị từ chối' 
        ELSE 'Trạng thái không xác định'
    END AS Status 
FROM 
    tblrejectmatch rm
INNER JOIN 
    tblteams t_home ON t_home.TeamID = rm.HomeTeam
LEFT JOIN 
    tblteams t_away ON t_away.CustomerID = rm.AwayTeam
LEFT JOIN 
    tblmatches m ON m.BookingID = rm.BookingID
INNER JOIN 
    tblfieldmatch fm ON fm.idfm = rm.idfm
INNER JOIN 
    tbltimematch tm ON tm.idtm = fm.idtm
INNER JOIN 
    tblfields f ON f.FieldID = fm.FieldID
WHERE  rm.AwayTeam = :customerID AND rm.BookingDate = IFNULL(:Bkdate,rm.BookingDate)
ORDER BY 
    f.FieldName, tm.StartTime ASC
) AS Subquery;
";
    $count_query = $dbh->prepare($count_sql);
    $count_query->bindParam(':customerID', $CustomerID, PDO::PARAM_INT);
    $count_query->bindParam(':Bkdate', $newDate, PDO::PARAM_STR);
    $count_query->execute();
    $total_results = $count_query->fetch(PDO::FETCH_OBJ)->total;
    $response['total'] = $total_results;
} catch (PDOException $e) {
    $response['error'] = 'Connection failed: ' . $e->getMessage();
}

echo json_encode($response);
?>