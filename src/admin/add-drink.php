<?php
session_start();
include('../includes/config.php');
error_reporting(0);
try {
    $priceperunit = $_POST['priceperunit'];
    $drinkname = $_POST['drinkname'];

    // Validate inputs
    if (empty($priceperunit) || empty($drinkname)) {
        $response = array(
            'status' => 'error',
            'message' => 'Dữ liệu trống'
        );
        echo json_encode($response);
        exit; // Stop execution
    }
    $sql_insert_drink = "INSERT INTO tbldrink(DrinkName,PricePerUnit) VALUES(:drinkname,:priceperunit)";
    $query_add_drink = $dbh->prepare($sql_insert_drink);        
    $query_add_drink->bindParam(':priceperunit', $priceperunit, PDO::PARAM_INT);
    $query_add_drink->bindParam(':drinkname', $drinkname, PDO::PARAM_STR);
    
    if ($query_add_drink->execute()) {
        $response = array(
            'status' => 'success',
            'message' => 'Thêm danh mục thành công!'
        );
        echo json_encode(array($response));
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Thêm danh mục thất bại. Vui lòng thử lại.'
        );
        echo json_encode(array($response));
    }
    
} catch (PDOException $e) {
    $response = array(
        'status' => 'error',
        'message' => 'Database connection failed: ' . $e->getMessage()
    );
    echo json_encode(array($response));
}
?>
