<?php
session_start();
include('../includes/config.php');
error_reporting(0);
try{
    $fieldtypeid = $_POST['fieldtypeid'];
    $sql = "SELECT NULL as FieldID,'--Tất cả--' as FieldName,'' as Address,'NULL' as FieldTypeID,'40*20' as Size,10 as MaxPlayers,'--Tất cả--' as Notes
            UNION
            SELECT FieldID, FieldName, Address, FieldTypeID, Size, MaxPlayers , Notes FROM tblfields WHERE FieldTypeID = :Fieldtypeid and FieldTypeID != '1'";
    $query = $dbh->prepare($sql);
    $query->bindParam(':Fieldtypeid', $fieldtypeid);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($results);
}catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>