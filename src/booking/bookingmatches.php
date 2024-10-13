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
                          WHERE CustomerID <> 'NULL' 
                          AND bk.idfm = :idfm AND bk.BookingDate = :bookingdate AND Status <> 0";
    $query_check_booking = $dbh->prepare($sql_check_booking);
    $query_check_booking->bindParam(':idfm', $idfm);
    $query_check_booking->bindParam(':bookingdate', $date_bk);
    $query_check_booking->execute();
    $booking_exists = $query_check_booking->fetch(PDO::FETCH_ASSOC);

    if ($booking_exists) {
        $response = array(
            'status' => 'error',
            'message' => 'Sân đã có người đặt'
        );
        echo json_encode($response);
    } else {
        // Get CustomerID
        $sql_get_customer_id = "SELECT CustomerID FROM tblusers u WHERE u.EmailId = :email_id";
        $query_get_customer_id = $dbh->prepare($sql_get_customer_id);
        $query_get_customer_id->bindParam(':email_id', $emailID);
        $query_get_customer_id->execute();
        $customerID = $query_get_customer_id->fetchColumn();

        // Insert booking
        $sql_insert_booking = "INSERT INTO tblbookings(CustomerID, idfm, BookingDate, Notes, Status) 
                               VALUES(:customerID, :idfieldmatches, :bkdate, '', '1')";
        $query_insert_booking = $dbh->prepare($sql_insert_booking);
        $query_insert_booking->bindParam(':customerID', $customerID, PDO::PARAM_STR);
        $query_insert_booking->bindParam(':idfieldmatches', $idfm, PDO::PARAM_STR);
        $query_insert_booking->bindParam(':bkdate', $date_bk, PDO::PARAM_STR);
        
        if ($query_insert_booking->execute()) {
            $lastInsertId = $dbh->lastInsertId();
            if ($lastInsertId) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Bạn đã đặt sân thành công!'
                );
                echo json_encode(array($response));
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Đã xảy ra lỗi. Vui lòng thử lại.'
                );
                echo json_encode(array($response));
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Đặt sân thất bại. Vui lòng thử lại.'
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
