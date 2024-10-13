<?php
session_start();
include ('../includes/config.php');
error_reporting(0);
try {
    $categoryid = isset($_GET['categoryid']) && !empty($_GET['categoryid']) ? $_GET['categoryid'] : null;
    // echo $categoryid;
    $sql = "SELECT * FROM tblsubcategory
            WHERE CategoryId = :categoryid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':categoryid', $categoryid);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($results);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>