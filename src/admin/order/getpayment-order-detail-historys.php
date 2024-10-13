<?php
session_start();
include ('../includes/config.php');
error_reporting(0);
try {
    $PaymentID = $_POST['PaymentID'];
    $sql = "SELECT dt.id,p.name,dt.size,dt.price,dt.quantity,dt.total_price FROM tblorderdetails dt 
            INNER JOIN tblorder od ON dt.order_id = od.id
            INNER JOIN tblproducts p ON p.id = dt.product_id
            WHERE od.id = :PaymentID";
    $query = $dbh->prepare($sql);
    $query->bindParam(':PaymentID', $PaymentID);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($results);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>