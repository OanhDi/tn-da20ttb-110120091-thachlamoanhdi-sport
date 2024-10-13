<?php
session_start();
include('../includes/config.php');
error_reporting(0);
try{
    $fieldtypeid = $_POST['fieldtypeid'];
    $sql = "SELECT * FROM tblfields WHERE FieldTypeID = :Fieldtypeid AND (FieldGroup IS NULL OR FieldGroup = '');";
    $query = $dbh->prepare($sql);
    $query->bindParam(':Fieldtypeid', $fieldtypeid);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($results);
}catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>