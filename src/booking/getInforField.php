<?php
session_start();
include('../includes/config.php');
error_reporting(0);
try {

    $Idtm = $_POST['id_tm'];
    $Idfm = $_POST['id_fm'];
    $FieldID = $_POST['field_id'];

    $sql = "SELECT * FROM tblfieldtypes ft
            INNER JOIN tblfields f on f.FieldTypeID = ft.FieldTypeID
            INNER JOIN tblfieldmatch fm on fm.FieldID = f.FieldID 
            INNER JOIN tbltimematch tm on tm.idtm = fm.idtm
            where tm.idtm = :idtm and fm.idfm = :idfm and f.FieldID = :fieldID";

    $query = $dbh->prepare($sql);
    $query->bindParam(':idtm', $Idtm);
    $query->bindParam(':idfm', $Idfm);
    $query->bindParam(':fieldID', $FieldID);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    echo json_encode($results);

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
