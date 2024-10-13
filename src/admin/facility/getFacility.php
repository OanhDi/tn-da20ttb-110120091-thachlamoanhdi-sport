<?php
session_start();
include ('../includes/config.php');
error_reporting(0);
try {
    $facilityType = isset($_POST['facilityType']) && !empty($_POST['facilityType']) ? $_POST['facilityType'] : null;
    $warehouse = isset($_POST['warehouse']) && !empty($_POST['warehouse']) ? $_POST['warehouse'] : null;
    $status = isset($_POST['status']) && !empty($_POST['status']) ? $_POST['status'] : null;
    
    $sql = "SELECT inv.id, t.type_name,inv.quantity,st.status_fac,w.name,w.location,inv.good_quantity,
            inv.normal_quantity,inv.deteriorated_quantity FROM tblfacility_inventory inv  
            INNER JOIN tblfacility_types t ON t.id = inv.facility_type_id
            INNER JOIN tblfacility_status st ON st.id = inv.status_id
            INNER JOIN tblwarehouses w on w.id = inv.warehouse_id
            WHERE t.id = IFNULL(:facilityType,t.id) AND w.id = IFNULL(:warehouse,w.id) AND st.id = IFNULL(:status,st.id)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':facilityType', $facilityType);
    $query->bindParam(':warehouse', $warehouse);
    $query->bindParam(':status', $status);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($results);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>