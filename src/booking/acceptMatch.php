<?php
session_start();
include ('../includes/config.php');
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

    $sql_check_booking = "SELECT * FROM tblbookings bk
                          WHERE bk.CustomerID = (SELECT u.CustomerID FROM tblusers u WHERE u.EmailId = :emailID)
                          AND bk.idfm = :idfm AND bk.BookingDate = :bookingdate AND Status = '2'";
    $query_check_booking = $dbh->prepare($sql_check_booking);
    $query_check_booking->bindParam(':idfm', $idfm);
    $query_check_booking->bindParam(':emailID', $emailID);
    $query_check_booking->bindParam(':bookingdate', $date_bk);
    $query_check_booking->execute();
    $booking_exists = $query_check_booking->fetch(PDO::FETCH_ASSOC);

    if ($booking_exists) {
        $bookingID = $booking_exists['BookingID'];
        $customerID = $booking_exists['CustomerID'];
        $awayTeam = $booking_exists['AwayTeam'];
        $idfm = $booking_exists['idfm'];
        $bookingDate = $booking_exists['BookingDate'];
    } else {
        $bookingID = null;
        $customerID = null;
        $awayTeam = null;
        $idfm = null;
        $bookingDate = null;
    }

    if (!$booking_exists) {
        $response = array(
            'status' => 'error',
            'message' => 'Trận đấu không tồn tại'
        );
        echo json_encode($response);
    } else {
        // Insert booking
        $sql_update_booking = "UPDATE tblbookings set Status = '3'
                                WHERE CustomerID = (SELECT u.CustomerID FROM tblusers u WHERE u.EmailId = :emailID)
                                AND idfm = :idfm AND BookingDate = :bookingdate AND Status = '2';";
        $query_update_booking = $dbh->prepare($sql_update_booking);
        $query_update_booking->bindParam(':emailID', $emailID, PDO::PARAM_STR);
        $query_update_booking->bindParam(':idfm', $idfm, PDO::PARAM_STR);
        $query_update_booking->bindParam(':bookingdate', $date_bk, PDO::PARAM_STR);

        if ($query_update_booking->execute()) {
            $sql_accept_booking = "INSERT INTO tblmatches(BookingID,Status,Result,Referee, HomeTeamID,AwayTeamID,ScoreTeamHome,ScoreTeamAway,CreateBy) 
            VALUES(:bookingid,'3',NULL ,NULL, :hometeam ,:awayteam, NULL, NULL, :email)";
            $query_accept_booking = $dbh->prepare($sql_accept_booking);
            $query_accept_booking->bindParam(':bookingid', $bookingID, PDO::PARAM_STR);
            $query_accept_booking->bindParam(':hometeam', $customerID, PDO::PARAM_STR);
            $query_accept_booking->bindParam(':awayteam', $awayTeam, PDO::PARAM_STR);
            $query_accept_booking->bindParam(':email', $emailID, PDO::PARAM_STR);            

            if ($query_accept_booking->execute()) {
                $lastInsertId = $dbh->lastInsertId();
                if ($lastInsertId) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Bạn đã chấp nhận trận đấu!'
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
                    'message' => 'Chấp nhận trận đấu thất bại. Vui lòng thử lại.'
                );
                echo json_encode(array($response));
            }




        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Chấp nhận thất bại. Vui lòng thử lại.'
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