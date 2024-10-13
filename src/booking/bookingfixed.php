<?php
session_start();
include('../includes/config.php');
error_reporting(0);
try {
    $Timefrominput = $_POST['Timefrominput'];
    $Bkdate = $_POST['Bkdate'];
    $BkdateEnd = $_POST['BkdateEnd'];
    $FieldType = $_POST['FieldType'];
    $Field = $_POST['Field'];
    $FType = $_POST['FType'];
    $cycle = $_POST['cycle'];
    $dayofweek = $_POST['dayofweek'];
    $LoginID = $_SESSION['login'];
    $startDate = DateTime::createFromFormat('d/m/Y', $Bkdate)->format('Y-m-d');
    $endDate = DateTime::createFromFormat('d/m/Y', $BkdateEnd)->format('Y-m-d');
    // Validate inputs
    if (
        empty($Timefrominput) || empty($Bkdate) || empty($BkdateEnd) ||
        empty($FieldType) || empty($Field) || empty($FType) ||
        empty($cycle) || empty($dayofweek) || empty($LoginID)
    ) {
        $response = array(
            'status' => 'error',
            'message' => 'Invalid input data.'
        );
        echo json_encode($response);
        exit; // Stop execution
    }
    //get customer
    $sql_get_customer = "SELECT * FROM tblusers WHERE EmailId = :id";
    $query_get_customer = $dbh->prepare($sql_get_customer);
    $query_get_customer->bindParam(':id', $LoginID);
    $query_get_customer->execute();
    $get_customer_exists = $query_get_customer->fetch(PDO::FETCH_ASSOC);

    if ($get_customer_exists) {
        $customerid = $get_customer_exists['CustomerID'];
    } else {
        $customerid = null;
    }
    // echo $customerid;

    $sql_get_timematch = "SELECT * FROM tbltimematch WHERE StartTime = :Timefrominput";
    $query_get_timematch = $dbh->prepare($sql_get_timematch);
    $query_get_timematch->bindParam(':Timefrominput', $Timefrominput);
    $query_get_timematch->execute();
    $get_timematch_exists = $query_get_timematch->fetch(PDO::FETCH_ASSOC);

    if ($get_timematch_exists) {
        $idtm = $get_timematch_exists['idtm'];
    } else {
        $idtm = null;
    }

    //get fm
    $sql_get_fieldmatch = "SELECT * FROM tblfieldmatch fm WHERE fm.idtm = :idtm AND fm.FieldID = :FieldID";
    $query_get_fieldmatch = $dbh->prepare($sql_get_fieldmatch);
    $query_get_fieldmatch->bindParam(':idtm', $idtm);
    $query_get_fieldmatch->bindParam(':FieldID', $Field);
    $query_get_fieldmatch->execute();
    $get_fieldmatch_exists = $query_get_fieldmatch->fetch(PDO::FETCH_ASSOC);

    if ($get_fieldmatch_exists) {
        $idfm = $get_fieldmatch_exists['idfm'];
    } else {
        $idfm = null;
    }
    //nếu là đặt sân hằng ngày
    $start = new DateTime($startDate);
    $end = new DateTime($endDate);
    // Thêm 1 ngày vào $end để vòng lặp lấy cả ngày cuối cùng
    $end->modify('+1 day');
    // Tạo vòng lặp để lấy từng ngày
    $interval = new DateInterval('P1D'); // Khoảng cách 1 ngày
    $period = new DatePeriod($start, $interval, $end);
    $datesArray = [];
    if ($cycle === 'everyday') {
        foreach ($period as $date) {
            $datesArray[] = $date->format('Y-m-d');
        }
    } else if ($cycle === 'weekly') {
        foreach ($period as $date) {
            // Kiểm tra nếu ngày là 'Sunday'
            if ($date->format('l') === $dayofweek) {
                $datesArray[] = $date->format('Y-m-d');
            }
        }
    }
    // print_r($datesArray);
    //Insert Booking
    $count = count($datesArray);
    $countRow = 0;
    foreach ($datesArray as $dow) {
        $sql_exists_bk = "SELECT * FROM tblbookings bk WHERE bk.BookingDate = :bkdate AND bk.idfm = :idfieldmatches";
        $query_exists_bk = $dbh->prepare($sql_exists_bk);
        $query_exists_bk->bindParam(':idfieldmatches', $idfm);
        $query_exists_bk->bindParam(':bkdate', $dow);
        $query_exists_bk->execute();
        $get_bk_exists = $query_exists_bk->fetch(PDO::FETCH_ASSOC);

        if (!$get_bk_exists) {
            $sql_insert_booking = "INSERT INTO tblbookings(CustomerID, idfm, BookingDate, Notes, Status) 
                                   VALUES(:customerID, :idfieldmatches, :bkdate, '', '1')";
            $query_insert_booking = $dbh->prepare($sql_insert_booking);
            $query_insert_booking->bindParam(':customerID', $customerid, PDO::PARAM_STR);
            $query_insert_booking->bindParam(':idfieldmatches', $idfm, PDO::PARAM_STR);
            $query_insert_booking->bindParam(':bkdate', $dow, PDO::PARAM_STR);

            if ($query_insert_booking->execute()) {
                $lastInsertId = $dbh->lastInsertId();
                if ($lastInsertId) {
                    $countRow += 1;
                }
            }
        }else{
            $countRow += 1;
        }
    }
    if ($countRow === 0) {
        $response = array(
            'status' => 'error',
            'message' => 'Đặt sân thất bại. Vui lòng thử lại.'
        );
        echo json_encode(array($response));
    }
    if ($countRow === $count) {
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
} catch (PDOException $e) {
    $response = array(
        'status' => 'error',
        'message' => 'Database connection failed: ' . $e->getMessage()
    );
    echo json_encode(array($response));
}
?>