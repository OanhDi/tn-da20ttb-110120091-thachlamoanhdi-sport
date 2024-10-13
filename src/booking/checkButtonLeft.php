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
    $sql_check_booking = "SELECT bk.* FROM tblbookings bk
                            LEFT JOIN tblcustomers c on c.CustomerID = bk.CustomerID
                            LEFT JOIN tblusers u on u.CustomerID = c.CustomerID
                            WHERE u.EmailId = :emailid
                            AND bk.idfm = :idfm AND bk.BookingDate = :bookingdate AND Status <> 0";
    $query_check_booking = $dbh->prepare($sql_check_booking);
    $query_check_booking->bindParam(':idfm', $idfm);
    $query_check_booking->bindParam(':bookingdate', $date_bk);
    $query_check_booking->bindParam(':emailid', $emailID);
    $query_check_booking->execute();
    $booking_exists = $query_check_booking->fetchAll(PDO::FETCH_OBJ);
 
    echo json_encode($booking_exists);
} catch (PDOException $e) {
    $response = array(
        'status' => 'error',
        'message' => 'Database connection failed: ' . $e->getMessage()
    );
    echo json_encode($response);
}
?>
