<?php
session_start();
include('../includes/config.php');
error_reporting(0);
try {
    $idfm = $_POST['id_FieldMatches'];
    $date_bk = $_POST['date_booking'];    

    // Validate inputs
    if (empty($idfm) || empty($date_bk)) {
        $response = array(
            'status' => 'error',
            'message' => 'Invalid input data.'
        );
        echo json_encode($response);
        exit; // Stop execution
    }
    $sql_check= "SELECT * FROM tblbookings bk
                          WHERE bk.idfm = :idfm AND bk.BookingDate = :bookingdate";
    $query_check = $dbh->prepare($sql_check);
    $query_check->bindParam(':idfm', $idfm);
    $query_check->bindParam(':bookingdate', $date_bk);    
    $query_check->execute();
    $booking_ex = $query_check->fetchAll(PDO::FETCH_OBJ);
 
    echo json_encode($booking_ex);
} catch (PDOException $e) {
    $response = array(
        'status' => 'error',
        'message' => 'Database connection failed: ' . $e->getMessage()
    );
    echo json_encode($response);
}
?>
