<?php
session_start();
include ('../includes/config.php');
error_reporting(0);

$per_page = isset($_GET['per_page']) ? intval($_GET['per_page']) : 10; // Số lượng bản ghi trên mỗi trang
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Trang hiện tại

$offset = ($page - 1) * $per_page; // Tính toán offset

$response = [
    'data' => [],
    'total' => 0,
    'error' => ''
];

try {
    $sql = "SELECT 
    t.TeamName,
    t.Rank,
    t.Address,
    t.Phone,
    COUNT(m.MatchID) AS MatchesPlayed,
    SUM(CASE 
        WHEN m.Result = t.CustomerID THEN 1
        ELSE 0
    END) AS Wins,
    SUM(CASE 
        WHEN m.Result != t.CustomerID AND m.Result != '' AND (m.HomeTeamID = t.CustomerID OR m.AwayTeamID = t.CustomerID) AND m.Result != '0' THEN 1
        ELSE 0
    END) AS Losses,
    SUM(CASE 
        WHEN m.Result = '0' THEN 1
        ELSE 0
    END) AS Draws,
    SUM(CASE 
        WHEN m.Result = t.CustomerID THEN 3
        WHEN m.Result = '0' THEN 1
        ELSE 0
    END) AS Points
FROM 
    tblteams t
LEFT JOIN 
    tblmatches m ON t.CustomerID = m.HomeTeamID OR t.CustomerID = m.AwayTeamID
WHERE 
    m.Status = '4'
GROUP BY 
    t.CustomerID, t.TeamName
ORDER BY 
    Points DESC, t.Rank DESC 
 LIMIT :offset, :per_page";
    $query = $dbh->prepare($sql);
    $query->bindParam(':offset', $offset, PDO::PARAM_INT);
    $query->bindParam(':per_page', $per_page, PDO::PARAM_INT);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $response['data'] = $results;

    // Lấy tổng số bản ghi
    $count_sql = "SELECT COUNT(*) as total
FROM (SELECT 
    t.TeamName,
    t.Rank,
    t.Address,
    t.Phone,
    COUNT(m.MatchID) AS MatchesPlayed,
    SUM(CASE 
        WHEN m.Result = t.CustomerID THEN 1
        ELSE 0
    END) AS Wins,
    SUM(CASE 
        WHEN m.Result != t.CustomerID AND m.Result != '' AND (m.HomeTeamID = t.CustomerID OR m.AwayTeamID = t.CustomerID) THEN 1
        ELSE 0
    END) AS Losses,
    SUM(CASE 
        WHEN m.Result = '0' THEN 1
        ELSE 0
    END) AS Draws
FROM 
    tblteams t
LEFT JOIN 
    tblmatches m ON t.CustomerID = m.HomeTeamID OR t.CustomerID = m.AwayTeamID
    WHERE m.Status = '4'
GROUP BY 
    t.CustomerID, t.TeamName
ORDER BY t.Rank DESC) as subquery;";
    $count_query = $dbh->prepare($count_sql);
    $count_query->execute();
    $total_results = $count_query->fetch(PDO::FETCH_OBJ)->total;
    $response['total'] = $total_results;
} catch (PDOException $e) {
    $response['error'] = 'Connection failed: ' . $e->getMessage();
}

echo json_encode($response);
?>