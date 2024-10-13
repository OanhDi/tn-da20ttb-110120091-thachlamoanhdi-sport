<?php
session_start();
include ('../includes/config.php');
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
    //Get info
    $sql_get_booking = "SELECT BookingID, CustomerID, AwayTeam, idfm, BookingDate FROM tblbookings bk WHERE bk.bookingID = :bookingID AND Status = '2';";
    $query_get_booking = $dbh->prepare($sql_get_booking);
    $query_get_booking->bindParam(':bookingID', $booking_ID);    
    $query_get_booking->execute();
    $booking_details = $query_get_booking->fetch(PDO::FETCH_ASSOC);

    if ($booking_details) {
        $bookingID = $booking_details['BookingID'];
        $customerID = $booking_details['CustomerID'];
        $awayTeam = $booking_details['AwayTeam'];
        $idfm = $booking_details['idfm'];
        $bookingDate = $booking_details['BookingDate'];
    } else {
        $bookingID = null;
        $customerID = null;
        $awayTeam = null;
        $idfm = null;
        $bookingDate = null;
    }

    $sql_update_booking = "UPDATE tblbookings SET Status = '1',
        AwayTeam = NULL
        WHERE bookingID = :bookingID AND Status = '2';";
    $query_update_booking = $dbh->prepare($sql_update_booking);
    $query_update_booking->bindParam(':bookingID', $booking_ID);    
    if ($query_update_booking->execute()) {
        $sql_insert_booking = "INSERT INTO tblRejectMatch(BookingID, HomeTeam,AwayTeam, idfm, BookingDate, Status) 
            VALUES(:bookingid, :hometeam, :awayteam, :idfm, :bookingdate, '0')";
        $query_insert_booking = $dbh->prepare($sql_insert_booking);
        $query_insert_booking->bindParam(':bookingid', $bookingID, PDO::PARAM_STR);
        $query_insert_booking->bindParam(':hometeam', $customerID, PDO::PARAM_STR);
        $query_insert_booking->bindParam(':awayteam', $awayTeam, PDO::PARAM_STR);
        $query_insert_booking->bindParam(':idfm', $idfm, PDO::PARAM_STR);
        $query_insert_booking->bindParam(':bookingdate', $bookingDate, PDO::PARAM_STR);

        if ($query_insert_booking->execute()) {
            $lastInsertId = $dbh->lastInsertId();
            if ($lastInsertId) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Bạn đã từ chối trận đấu!'
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
                'message' => 'Từ chối trận đấu thất bại. Vui lòng thử lại.'
            );
            echo json_encode(array($response));
        }
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Từ chối trận đấu thất bại. Vui lòng thử lại.'
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