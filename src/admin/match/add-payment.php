<?php
session_start();
include ('../includes/config.php');
error_reporting(0);
try {
    $MatchID = $_POST['MatchID'];

    // Validate inputs
    if (empty($MatchID)) {
        $response = array(
            'status' => 'error',
            'message' => 'Invalid input data.'
        );
        echo json_encode($response);
        exit; // Stop execution
    }
    $sql_add_payment = "INSERT INTO tblmatchpayments(MatchID,FieldRent,ServiceCharges,ExtraCharge,Amount,TotalAmount,Status) VALUES (:matchid,0,0,0,0,0,0)";

    $query_add_pm = $dbh->prepare($sql_add_payment);
    $query_add_pm->bindParam(':matchid', $MatchID);
    if ($query_add_pm->execute()) {
        $paymentID = $dbh->lastInsertId(); // Lấy PaymentID vừa được chèn
        $response = array(
            'status' => 'success',
            'message' => 'Thêm dữ liệu thành công!',
            'PaymentID' => $paymentID // Trả về PaymentID
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