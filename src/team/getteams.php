<?php
session_start();
include('../includes/config.php');
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
    $sql = "SELECT * FROM tblteams ORDER BY Rank DESC LIMIT :offset, :per_page";
    $query = $dbh->prepare($sql);
    $query->bindParam(':offset', $offset, PDO::PARAM_INT);
    $query->bindParam(':per_page', $per_page, PDO::PARAM_INT);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $response['data'] = $results;

    // Lấy tổng số bản ghi
    $count_sql = "SELECT COUNT(*) as total FROM tblteams";
    $count_query = $dbh->prepare($count_sql);
    $count_query->execute();
    $total_results = $count_query->fetch(PDO::FETCH_OBJ)->total;
    $response['total'] = $total_results;
} catch (PDOException $e) {
    $response['error'] = 'Connection failed: ' . $e->getMessage();
}

echo json_encode($response);
?>
