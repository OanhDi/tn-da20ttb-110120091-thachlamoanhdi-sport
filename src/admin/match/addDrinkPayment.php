<?php
session_start();
include ('../includes/config.php');
error_reporting(0);
try {
    $jsonData = $_POST['selectedDrinks'];
    $priceInput = isset($_POST['priceInput']) ? $_POST['priceInput'] : null;
    $extraCharge = isset($_POST['extraCharge']) ? $_POST['extraCharge'] : null;
    $paymentID = isset($_POST['paymentID']) ? $_POST['paymentID'] : null;
    $drinkOrderID = isset($_POST['drinkOrderID']) ? $_POST['drinkOrderID'] : null;
    if ($priceInput === '' || $priceInput === null) {
        $priceInput = 0;
    }

    if ($extraCharge === '' || $extraCharge === null) {
        $extraCharge = 0;
    }
    $selectedDrinks = json_decode($jsonData, true);
    $count = 0;
    $total_price = 0;
    if ($selectedDrinks !== null) {
        foreach ($selectedDrinks as $drink) {
            $drinkID = $drink['drinkID'];
            $drinkName = $drink['drinkName'];
            $price = $drink['price'];
            $quantity = $drink['quantity'];
            $total = $price * $quantity;
            // echo''. $drinkID .''. $drinkName .''. $price .''. $quantity .''. $total .'';

            $sql_add_drinkorderline = "INSERT INTO tbldrinkorderline(DrinkOrderID, DrinkID, Quantity, TotalPrice) VALUES(:orderid,:drinkid,:quantity,:total)";
            $query_add_dol = $dbh->prepare($sql_add_drinkorderline);
            $query_add_dol->bindParam(':orderid', $drinkOrderID);
            $query_add_dol->bindParam(':drinkid', $drinkID);
            $query_add_dol->bindParam(':quantity', $quantity);
            $query_add_dol->bindParam(':total', $total);
            $query_add_dol->execute();
            $total_price += $total;
            $count++;
        }
        if ($count === count($selectedDrinks)) {
            $sql_update_drinkorder = "UPDATE tbldrinkorder SET TotalPrice = :totalprice,UpdateDate=CURRENT_TIMESTAMP()
                                      WHERE DrinkOrderID = :orderID";
            $query_update_do = $dbh->prepare($sql_update_drinkorder);
            $query_update_do->bindParam(':orderID', $drinkOrderID);
            $query_update_do->bindParam(':totalprice', $total_price);
            if ($query_update_do->execute()) {
                $totalAmount = $total_price + $priceInput + $extraCharge;
                $amount = $total_price + $priceInput;
                $sql_update_payment = "UPDATE tblmatchpayments SET Amount = :amount,TotalAmount = :totalamount,ExtraCharge = :extracharge,Status = 1,UpdateDate = CURRENT_TIMESTAMP(),
                                        FieldRent = :fieldrent, ServiceCharges = :servicecharge
                                        WHERE PaymentID = :paymentid";
                $query_update_payment = $dbh->prepare($sql_update_payment);
                $query_update_payment->bindParam(':amount', $amount);
                $query_update_payment->bindParam(':fieldrent', $priceInput);
                $query_update_payment->bindParam(':servicecharge', $total_price);
                $query_update_payment->bindParam(':totalamount', $totalAmount);
                $query_update_payment->bindParam(':extracharge', $extraCharge);
                $query_update_payment->bindParam(':paymentid', $paymentID);
                if ($query_update_payment->execute()) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Thanh toán thành công'
                    );
                    echo json_encode($response);
                    exit;
                }
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Thanh toán thất bại'
            );
            echo json_encode($response);
            exit;
        }
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Invalid input data.'
        );
        echo json_encode($response);
        exit;
    }






} catch (PDOException $e) {
    $response = array(
        'status' => 'error',
        'message' => 'Database connection failed: ' . $e->getMessage()
    );
    echo json_encode(array($response));
}
?>