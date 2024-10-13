<?php
session_start();
include ('../includes/config.php');
error_reporting(0);
try {
    $Category = isset($_GET['Category']) && !empty($_GET['Category']) ? $_GET['Category'] : null;
    $subcategory = isset($_GET['subcategory']) && !empty($_GET['subcategory']) ? $_GET['subcategory'] : null;
    //  echo $Category .'-'. $subcategory;
    $sql = "select tblposts.id,tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,
    tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,
    tblposts.PostingDate as postingdate,tblposts.PostUrl as url,tblposts.postedBy,tblposts.lastUpdatedBy,
    tblposts.UpdationDate,tblposts.viewCounter, tblposts.Likes 
    from tblposts 
    left join tblcategory on tblcategory.id=tblposts.CategoryId 
    left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId
    WHERE tblposts.CategoryId = IFNULL(:Category, tblposts.CategoryId) 
    AND tblposts.SubCategoryId = IFNULL(:subcategory, tblposts.SubCategoryId)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':Category', $Category);
    $query->bindParam(':subcategory', $subcategory);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($results);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>