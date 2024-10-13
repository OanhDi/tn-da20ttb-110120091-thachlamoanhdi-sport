<?php
session_start();
include ('../includes/config.php');
error_reporting(0);
try {

    if($_POST['OrderDate'] === 'null' || $_POST['OrderDate'] === ''){
        $newDate = NULL;
    }else{
        $newDate = date('Y/m/d', strtotime(str_replace('/', '-', $_POST['OrderDate'])));
    }
    
    $Customer_name = $_POST['Customer_name'] === 'null' ? '' : $_POST['Customer_name'];
    $Phone = $_POST['Phone'] === 'null' ? '' : $_POST['Phone'];
    $Address = $_POST['Address'] === 'null' ? '' : $_POST['Address'];
    //  echo $newDate. ''.$Customer_name.''.$Phone.''.$Address;
    $sql = "select * FROM tblorder
            WHERE customer_name LIKE CONCAT('%',:Customer_name, '%') 
            AND address LIKE CONCAT('%',:Address, '%') AND  phone  LIKE CONCAT('%',:Phone, '%')
            AND order_date = IFNULL(:OrderDate, order_date)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':OrderDate', $newDate);
    $query->bindParam(':Customer_name', $Customer_name);
    $query->bindParam(':Phone', $Phone);
    $query->bindParam(':Address', $Address);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($results);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>