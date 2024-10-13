<?php
session_start();
include ('../includes/config.php');
error_reporting(0);
try {
    $jsonData = $_POST['jsonData'];
    $OrderID = isset($_POST['OrderID']) ? $_POST['OrderID'] : null;
    $promotion = isset($_POST['promotion']) ? $_POST['promotion'] : 0;
    $discount = isset($_POST['discount']) ? $_POST['discount'] : 0;
    $extraCharge = isset($_POST['extraCharge']) ? $_POST['extraCharge'] : 0;

    $selectedOrder = json_decode($jsonData, true);
    $count = 0;
    $total_price = 0;
    if ($selectedOrder !== null) {
        foreach ($selectedOrder as $order) {
            $productId = $order['productId'];
            $productName = $order['productName'];
            $sizeInput = $order['sizeInput'];
            $quantityInput = $order['quantityInput'];
            $PriceParse = $order['PriceParse'];
            $totalPriceParse = $PriceParse * $quantityInput;            

            $sql_add_order_details = "INSERT INTO tblorderdetails(order_id,product_id,size,quantity,price,total_price) 
            VALUES (:order_id, :product_id, :size, :quantity, :price, :total_price)";
            $query_add_odd = $dbh->prepare($sql_add_order_details);
            $query_add_odd->bindParam(':order_id', $OrderID);
            $query_add_odd->bindParam(':product_id', $productId);
            $query_add_odd->bindParam(':size', $sizeInput);
            $query_add_odd->bindParam(':quantity', $quantityInput);
            $query_add_odd->bindParam(':price', $PriceParse);
            $query_add_odd->bindParam(':total_price', $totalPriceParse);
            $query_add_odd->execute();
            $total_price += $totalPriceParse;
            $count++;
        }
        if ($count === count($selectedOrder)) {
            $total = ($total_price + $extraCharge) - $promotion;
            $discount = $total * ($discount / 100);
            $finalTotal = $total - $discount;
            $sql_update_order = "UPDATE tblorder SET total_price_product = :total_price_product, status = 1, 
                                     discount = :discount, promotion = :promotion, extra_charge = :extra_charge, total_amount = :total_amount
                                      WHERE id = :id";
            $query_update_od = $dbh->prepare($sql_update_order);
            $query_update_od->bindParam(':total_price_product', $total_price);
            $query_update_od->bindParam(':discount', $discount);
            $query_update_od->bindParam(':promotion', $promotion);
            $query_update_od->bindParam(':extra_charge', $extraCharge);
            $query_update_od->bindParam(':total_amount', $finalTotal);
            $query_update_od->bindParam(':id', $OrderID);
            if ($query_update_od->execute()) {                
                $response = array(
                    'status' => 'success',
                    'message' => 'Thanh toán thành công'
                );
                echo json_encode($response);
                exit;
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