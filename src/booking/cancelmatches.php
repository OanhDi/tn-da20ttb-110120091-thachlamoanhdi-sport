<?php
session_start();
include('../includes/config.php');
error_reporting(0);
try {
    $idfm = $_POST['id_FieldMatches'];
    $date_bk = $_POST['date_booking'];
    $emailID = $_POST['emailID'];

    // Validate inputs
    if (empty($idfm) || empty($date_bk) || empty($emailID)) {
        $response = array(
            'status' => 'error',
            'message' => 'Invalid input data.'
        );
        echo json_encode($response);
        exit; // Stop execution
    }

    // Check if the car is already booked for the given date and user
    $sql_check_booking = "SELECT * FROM tblbookings bk
                          WHERE bk.CustomerID = (SELECT u.CustomerID FROM tblusers u WHERE u.EmailId = :emailID)
                          AND bk.idfm = :idfm AND bk.BookingDate = :bookingdate AND Status = '1'";
    $query_check_booking = $dbh->prepare($sql_check_booking);
    $query_check_booking->bindParam(':idfm', $idfm);
    $query_check_booking->bindParam(':emailID', $emailID);
    $query_check_booking->bindParam(':bookingdate', $date_bk);
    $query_check_booking->execute();
    $booking_exists = $query_check_booking->fetch(PDO::FETCH_ASSOC);

    if (!$booking_exists) {
        $response = array(
            'status' => 'error',
            'message' => 'Sân đặt không tồn tại'
        );
        echo json_encode($response);
    } else {
        // Insert booking
        $sql_delete_booking = "DELETE FROM tblbookings
                                WHERE CustomerID = (SELECT u.CustomerID FROM tblusers u WHERE u.EmailId = :emailID)
                                AND idfm = :idfm AND BookingDate = :bookingdate AND Status = '1';";
        $query_delete_booking = $dbh->prepare($sql_delete_booking);
        $query_delete_booking->bindParam(':emailID', $emailID, PDO::PARAM_STR);
        $query_delete_booking->bindParam(':idfm', $idfm, PDO::PARAM_STR);
        $query_delete_booking->bindParam(':bookingdate', $date_bk, PDO::PARAM_STR);
        
        if ($query_delete_booking->execute()) {
            $response = array(
                'status' => 'success',
                'message' => 'Bạn đã huỷ sân thành công!'
            );
            echo json_encode(array($response));
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Huỷ sân thất bại. Vui lòng thử lại.'
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
