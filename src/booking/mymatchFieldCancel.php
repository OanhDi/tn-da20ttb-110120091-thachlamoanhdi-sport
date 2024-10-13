<?php
session_start();
include('../includes/config.php');
error_reporting(0);
try {
    $booking_ID = $_POST['bookingID'];    

    // Validate inputs
    if (empty($booking_ID)) {
        $response = array(
            'status' => 'error',
            'message' => 'Invalid input data.'
        );
        echo json_encode($response);
        exit; // Stop execution
    }

    $sql_check_booking = "SELECT * FROM tblbookings bk
                          WHERE bk.bookingID = :bookingID AND Status = '2'";
    $query_check_booking = $dbh->prepare($sql_check_booking);
    $query_check_booking->bindParam(':bookingID', $booking_ID);    
    $query_check_booking->execute();
    $booking_exists = $query_check_booking->fetch(PDO::FETCH_ASSOC);

    if (!$booking_exists) {
        $response = array(
            'status' => 'error',
            'message' => 'Không có đội khách đặt sân'
        );
        echo json_encode($response);
    } else {
        // Insert booking
        $sql_update_booking = "UPDATE tblbookings SET Status = '1',
        AwayTeam = NULL
        WHERE bookingID = :bookingID AND Status = '2';";
        $query_update_booking = $dbh->prepare($sql_update_booking);        
        $query_update_booking->bindParam(':bookingID', $booking_ID, PDO::PARAM_STR);        
        
        if ($query_update_booking->execute()) {
            $response = array(
                'status' => 'success',
                'message' => 'Bạn đã huỷ trận đấu thành công!'
            );
            echo json_encode(array($response));
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Huỷ trận đấu thất bại. Vui lòng thử lại.'
            );
            echo json_encode(array($response));
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
