<?php
session_start();
include ('../includes/config.php');
error_reporting(0);
try {

    $sql_get_max = "SELECT MAX(PaymentID) AS last_id FROM tblmatchpayments;";
    $query_get_max = $dbh->prepare($sql_get_max);
    $query_get_max->execute();
    $PaymentMax = $query_get_max->fetch(PDO::FETCH_ASSOC);
    if ($PaymentMax) {
        $PaymentID = $PaymentMax['last_id'];
        $sql_add_drinkorder = "INSERT INTO tbldrinkorder(TotalPrice,PaymentID) VALUES (0,:paymentid)";
        $query_add_do = $dbh->prepare($sql_add_drinkorder);
        $query_add_do->bindParam(':paymentid', $PaymentID);
        if ($query_add_do->execute()) {
            $DrinkOrderID = $dbh->lastInsertId(); // Lấy PaymentID vừa được chèn
            $response = array(
                'status' => 'success',
                'message' => 'Thêm dữ liệu thành công!',
                'DrinkOrderID' => $DrinkOrderID // Trả về PaymentID
            );
            echo json_encode($response);
        }else{
            $response = array(
                'status' => 'error',
                'message' => 'Thêm dữ liệu thất bại!'
            );
            echo json_encode($response);
        }
    }
} catch (PDOException $e) {
    $response = array(
        'status' => 'error',
        'message' => 'Database connection failed: ' . $e->getMessage()
    );
    echo json_encode(array($response));
}
?>