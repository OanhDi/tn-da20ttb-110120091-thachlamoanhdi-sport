<?php
session_start();
include ('../includes/config.php');
error_reporting(0);
try {
    $CategoryID = isset($_POST['CategoryID']) && !empty($_POST['CategoryID']) ? $_POST['CategoryID'] : null;
    //   echo $CategoryID;
    $sql = "SELECT * FROM tblsubcategory
WHERE tblsubcategory.CategoryId = :CategoryID";
    $query = $dbh->prepare($sql);
    $query->bindParam(':CategoryID', $CategoryID);    
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($results);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>