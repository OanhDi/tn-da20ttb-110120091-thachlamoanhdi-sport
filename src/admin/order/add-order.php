<?php
session_start();
include ('../includes/config.php');
error_reporting(0);
try {
    $Customername = $_POST['Customername'];
    $Phone = $_POST['Phone'];
    $Address = $_POST['Address'];

    // Validate inputs
    if (empty($Customername)) {
        $response = array(
            'status' => 'error',
            'message' => 'Invalid input data.'
        );
        echo json_encode($response);
        exit; // Stop execution
    }
    $sql_add_order = "INSERT INTO tblorder(customer_name,address,phone,order_date,total_price_product,total_amount,status,discount,promotion,extra_charge) 
    VALUES(:customer_name, :address, :phone, CURRENT_DATE(), 0, 0, 0, 0, 0 , 0)";

    $query_add_od = $dbh->prepare($sql_add_order);
    $query_add_od->bindParam(':customer_name', $Customername);
    $query_add_od->bindParam(':address', $Address);
    $query_add_od->bindParam(':phone', $Phone);
    if ($query_add_od->execute()) {
        $OrderID = $dbh->lastInsertId(); // Lấy OrderID vừa được chèn
        $response = array(
            'status' => 'success',
            'message' => 'Thêm dữ liệu thành công!',
            'id' => $OrderID // Trả về OrderID
        );
        echo json_encode($response);
    }else{
        $response = array(
            'status' => 'error',
            'message' => 'Thêm dữ liệu thất bại!'
        );
        echo json_encode($response);
    }
} catch (PDOException $e) {
    $response = array(
        'status' => 'error',
        'message' => 'Database connection failed: ' . $e->getMessage()
    );
    echo json_encode(array($response));
}
?>