<?php
session_start();
include ('../includes/config.php');
error_reporting(0);

$per_page = isset($_GET['per_page']) ? intval($_GET['per_page']) : 10; // Số lượng bản ghi trên mỗi trang
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Trang hiện tại
$CustomerID = isset($_SESSION['CustomerID']) ? intval($_SESSION['CustomerID']) : 0;
$Bkdate = $_GET['bk_date'];
if ($Bkdate !== '') {
    $date = DateTime::createFromFormat('d/m/Y', $Bkdate);
    if ($date) {
        $newDate = $date->format('Y/m/d');
    } else {
        echo "Invalid date format";
    }
} else {
    $newDate = null;
}

$offset = ($page - 1) * $per_page; // Tính toán offset
// echo "<script>alert('" . $newDate . "');</script>";
$response = [
    'data' => [],
    'total' => 0,
    'error' => ''
];

try {
    $sql = "SELECT * FROM (
SELECT 
        bk.BookingID,
        t_home.CustomerID AS ID_Home,
        t_home.TeamName AS TeamHome,
        t_away.TeamName AS TeamAway,
        t_away.CustomerID AS ID_Away,
        f.FieldName,
        bk.BookingDate,
        tm.NameMatch,
        tm.StartTime,
        m.ScoreTeamHome,
        m.ScoreTeamAway,
        bk.Status AS StatusID, 
        CASE 
            WHEN bk.Status = '1' THEN 'Đã đặt sân' 
            WHEN bk.Status = '2' THEN 'Chờ chấp thuận' 
            WHEN bk.Status = '3' THEN 'Chuẩn bị thi đấu' 
            WHEN bk.Status = '4' THEN 'Kết thúc trận đấu' 
            ELSE 'Trạng thái không xác định'
        END AS Status 
    FROM 
        tblbookings bk
    INNER JOIN 
        tblteams t_home ON t_home.CustomerID = bk.CustomerID
    LEFT JOIN 
        tblteams t_away ON t_away.CustomerID = bk.AwayTeam
    LEFT JOIN 
        tblmatches m ON m.BookingID = bk.BookingID
    INNER JOIN 
        tblfieldmatch fm ON fm.idfm = bk.idfm
    INNER JOIN 
        tbltimematch tm ON tm.idtm = fm.idtm
    INNER JOIN 
        tblfields f ON f.FieldID = fm.FieldID
    WHERE 
        (bk.CustomerID = :customerID OR bk.AwayTeam = :customerID) 
        AND (bk.BookingDate = IFNULL(:bkdate, bk.BookingDate) OR bk.BookingDate IS NULL)
    ORDER BY 
        f.FieldName, tm.StartTime ASC) AS queryMatch
       ORDER BY BookingDate DESC LIMIT :offset, :per_page";
    $query = $dbh->prepare($sql);
    $query->bindParam(':offset', $offset, PDO::PARAM_INT);
    $query->bindParam(':per_page', $per_page, PDO::PARAM_INT);
    $query->bindParam(':customerID', $CustomerID, PDO::PARAM_INT);
    $query->bindParam(':bkdate', $newDate, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $response['data'] = $results;

    // Lấy tổng số bản ghi
    $count_sql = "SELECT COUNT(*) as total FROM (
SELECT 
        bk.BookingID,
        t_home.CustomerID AS ID_Home,
        t_home.TeamName AS TeamHome,
        t_away.TeamName AS TeamAway,
        t_away.CustomerID AS ID_Away,
        f.FieldName,
        bk.BookingDate,
        tm.NameMatch,
        tm.StartTime,
        m.ScoreTeamHome,
        m.ScoreTeamAway,
        bk.Status AS StatusID, 
        CASE 
            WHEN bk.Status = '1' THEN 'Đã đặt sân' 
            WHEN bk.Status = '2' THEN 'Chờ chấp thuận' 
            WHEN bk.Status = '3' THEN 'Chuẩn bị thi đấu' 
            WHEN bk.Status = '4' THEN 'Kết thúc trận đấu' 
            ELSE 'Trạng thái không xác định'
        END AS Status 
    FROM 
        tblbookings bk
    INNER JOIN 
        tblteams t_home ON t_home.CustomerID = bk.CustomerID
    LEFT JOIN 
        tblteams t_away ON t_away.CustomerID = bk.AwayTeam
    LEFT JOIN 
        tblmatches m ON m.BookingID = bk.BookingID
    INNER JOIN 
        tblfieldmatch fm ON fm.idfm = bk.idfm
    INNER JOIN 
        tbltimematch tm ON tm.idtm = fm.idtm
    INNER JOIN 
        tblfields f ON f.FieldID = fm.FieldID
    WHERE 
        (bk.CustomerID = :customerID OR bk.AwayTeam = :customerID) 
        AND (bk.BookingDate = IFNULL(:bkdate, bk.BookingDate) OR bk.BookingDate IS NULL)
    ORDER BY 
        f.FieldName, tm.StartTime ASC) AS queryMatch
       ORDER BY BookingDate DESC;
";
    $count_query = $dbh->prepare($count_sql);
    $count_query->bindParam(':customerID', $CustomerID, PDO::PARAM_INT);
    $count_query->bindParam(':bkdate', $newDate, PDO::PARAM_STR);
    $count_query->execute();
    $total_results = $count_query->fetch(PDO::FETCH_OBJ)->total;
    $response['total'] = $total_results;
} catch (PDOException $e) {
    $response['error'] = 'Connection failed: ' . $e->getMessage();
}

echo json_encode($response);
?>