<?php
session_start();
include('includes/config.php');
error_reporting(0);

?>

<!DOCTYPE HTML>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>TVU Sport Center</title>
  <!--Bootstrap -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
  <link rel="stylesheet" href="assets/css/style.css" type="text/css">
  <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
  <link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
  <link href="assets/css/slick.css" rel="stylesheet">
  <link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
  <link href="assets/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all"
    data-default-color="true" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
  <link rel="apple-touch-icon-precomposed" sizes="144x144"
    href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114"
    href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
  <link rel="apple-touch-icon-precomposed" sizes="72x72"
    href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="assets/images/favicon-icon/logo.jpg">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
</head>

<body>

  <!-- Start Switcher -->
  <?php include('includes/colorswitcher.php'); ?>
  <!-- /Switcher -->

  <!--Header-->
  <?php include('includes/header.php'); ?>
  <!-- /Header -->

  <!-- Banners -->
  <!-- <section id="banner" class="banner-section">
  <div class="container">
    <div class="div_zindex">
      <div class="row">
        <div class="col-md-5 col-md-push-7">
          <div class="banner_content">
            <h1>&nbsp;</h1>
            <p>&nbsp; </p>
            </div>
        </div>
      </div>
    </div>
  </div>
</section> -->
  <?php
  // $vhid=intval($_GET['vhid']);
  $status = 1;
  $sql = "SELECT id,BannerTitle,Vimage1,Vimage2,Vimage3,Vimage4,Vimage5 FROM `tblbanners` WHERE STATUS =:status";
  $query = $dbh->prepare($sql);

  $query->bindParam(':status', $status, PDO::PARAM_STR);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  $cnt = 1;
  if ($query->rowCount() > 0) {
    foreach ($results as $result) {
      $_SESSION['brndid'] = $result->bid;
      ?>
      <section id="listing_img_slider">
        <div><img src="admin/img/bannerimage/<?php echo htmlentities($result->Vimage1); ?>" class="img-responsive"
            alt="image" width="900" height="560"></div>
        <div><img src="admin/img/bannerimage/<?php echo htmlentities($result->Vimage2); ?>" class="img-responsive"
            alt="image" width="900" height="560"></div>
        <div><img src="admin/img/bannerimage/<?php echo htmlentities($result->Vimage3); ?>" class="img-responsive"
            alt="image" width="900" height="560"></div>
        <div><img src="admin/img/bannerimage/<?php echo htmlentities($result->Vimage4); ?>" class="img-responsive"
            alt="image" width="900" height="560"></div>
        <?php
        if ($result->Vimage5 == "") {

        } else {
          ?>
          <div><img src="admin/img/bannerimage/<?php echo htmlentities($result->Vimage5); ?>" class="img-responsive"
              alt="image" width="900" height="560"></div>
          <?php
        }
        ?>
      </section>
      <?php
    }
  }
  ?>
  <!-- /Banners -->


  <!-- Resent Cat-->
  <section class="section-padding gray-bg">
    <div class="container">
      <div class="section-header text-center">
        <h2><span>Sân bóng đá cỏ nhân tạo</span> Trường Đại học Trà Vinh</h2>
        <p>Được xây dựng trong hai tháng, có tổng diện tích 3080 mét vuông với 3 sân 5 người ghép thành 1 sân 7 người
          với tổng kinh phí đầu tư hơn 1 tỷ đồng.
          Nhằm tạo sân chơi bổ ích và lành mạnh đáp ứng nhu cầu tập luyện thể dục thể thao của học sinh, sinh viên, cán
          bộ giảng viên Nhà trường với sân cỏ đạt tiêu chuẩn chất lượng
        </p>
      </div>
      <div class="row">

        <!-- Nav tabs -->
        <div class="recent-tab">
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#resentnewcar" role="tab" data-toggle="tab">Tin Tức</a></li>
          </ul>
        </div>
        <!-- Recently Listed New Cars -->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="resentnewcar">

            <?php $sql = "SELECT p.id, p.PostTitle,p.CategoryId,p.PostDetails,p.PostingDate,p.PostImage,p.viewCounter,p.Content,c.Description FROM `tblposts` p INNER JOIN tblcategory c on p.CategoryId = c.id limit 9";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            $cnt = 1;
            if ($query->rowCount() > 0) {
              foreach ($results as $result) {
                ?>
                <div class="col-list-3">
                  <div class="recent-car-list">
                    <div class="car-info-box"> <a
                        href="post-details.php?post_id=<?php echo htmlentities($result->id); ?>"><img
                          src="admin/img/postimages/<?php echo htmlentities($result->PostImage); ?>" class="img-responsive"
                          alt="image"></a>
                      <ul>
                        <li><i class="fa fa-soccer-ball-o" aria-hidden="true"></i>Tin tức</li>
                        <?php
                        $date = new DateTime($result->PostingDate);
                        $formattedDate = $date->format('d-m-Y');
                        ?>
                        <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($formattedDate); ?>
                        </li>
                        <li><i class="fa fa-eye" aria-hidden="true"></i><?php echo htmlentities($result->viewCounter); ?>
                          Lượt xem</li>
                      </ul>
                    </div>
                    <div class="car-title-m">
                      <h6><a href="post-details.php?post_id=<?php echo htmlentities($result->id); ?>">
                          <?php echo htmlentities($result->PostTitle); ?></a></h6>                      
                    </div>
                    <div class="inventory_info_m">
                      <p><?php echo substr($result->Content, 0, 200). '...'; ?></p>
                    </div>
                  </div>
                </div>
              <?php }
            } ?>

          </div>
        </div>
      </div>
  </section>
  <!-- /Resent Cat -->

  <!-- Fun Facts-->
  <section class="fun-facts-section">
    <div class="container div_zindex">
      <div class="row">
        <div class="col-lg-3 col-xs-6 col-sm-3">
          <div class="fun-facts-m">
            <div class="cell">
              <?php $sql = "SELECT COUNT(*) AS Count FROM tblteams";
              $query = $dbh->prepare($sql);
              $query->execute();
              $results = $query->fetchAll(PDO::FETCH_OBJ);
              $cnt = 1;
              if ($query->rowCount() > 0) {
                foreach ($results as $result) {
                  ?>
                  <h2><i class="fa fa-soccer-ball-o" aria-hidden="true"></i>
                    <?php echo htmlentities($result->Count); ?>
                  </h2>
                <?php
                }
              } ?>
              <p>Đội Tham Gia</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6 col-sm-3">
          <div class="fun-facts-m">
            <div class="cell">              
              <?php $sql = "SELECT COUNT(*) AS Count FROM tblfields";
              $query = $dbh->prepare($sql);
              $query->execute();
              $results = $query->fetchAll(PDO::FETCH_OBJ);
              $cnt = 1;
              if ($query->rowCount() > 0) {
                foreach ($results as $result) {
                  ?>
                  <h2><i class="fa fa-map-o" aria-hidden="true"></i>
                    <?php echo htmlentities($result->Count); ?>
                  </h2>
                <?php
                }
              } ?>
              <p>Sân Giải Trí</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6 col-sm-3">
          <div class="fun-facts-m">
            <div class="cell">              
              <?php $sql = "SELECT COUNT(*) AS Count FROM tblbookings WHERE STATUS IN ('3','4')";
              $query = $dbh->prepare($sql);
              $query->execute();
              $results = $query->fetchAll(PDO::FETCH_OBJ);
              $cnt = 1;
              if ($query->rowCount() > 0) {
                foreach ($results as $result) {
                  ?>
                  <h2><i class="fa fa-line-chart" aria-hidden="true"></i>
                    <?php echo htmlentities($result->Count); ?>
                  </h2>
                <?php
                }
              } ?>
              <p>Lượt Trận Đấu</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6 col-sm-3">
          <div class="fun-facts-m">
            <div class="cell">
              <h2><i class="fa fa-university" aria-hidden="true"></i>04/2023</h2>
              <p>Ngày Thành Lập</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Dark Overlay-->
    <div class="dark-overlay"></div>
  </section>
  <!-- /Fun Facts-->


  <!--Testimonial -->
  <section class="section-padding testimonial-section parallex-bg">
    <div class="container div_zindex">
      <div class="section-header white-text text-center">
        <h2>Tra Vinh University <span>Football Field</span></h2>
      </div>
      <div class="row">
        <div id="testimonial-slider">
          <?php
          $tid = 1;
          $sql = "SELECT tbltestimonial.Testimonial,tblusers.FullName from tbltestimonial join tblusers on tbltestimonial.UserEmail=tblusers.EmailId where tbltestimonial.status=:tid limit 4";
          $query = $dbh->prepare($sql);
          $query->bindParam(':tid', $tid, PDO::PARAM_STR);
          $query->execute();
          $results = $query->fetchAll(PDO::FETCH_OBJ);
          $cnt = 1;
          if ($query->rowCount() > 0) {
            foreach ($results as $result) { ?>


              <div class="testimonial-m">

                <div class="testimonial-content">
                  <div class="testimonial-heading">
                    <h5><?php echo htmlentities($result->FullName); ?></h5>
                    <p><?php echo htmlentities($result->Testimonial); ?></p>
                  </div>
                </div>
              </div>
            <?php }
          } ?>



        </div>
      </div>
    </div>
    <!-- Dark Overlay-->
    <div class="dark-overlay"></div>
  </section>
  <!-- /Testimonial-->


  <!--Footer -->
  <?php include('includes/footer.php'); ?>
  <!-- /Footer-->

  <!--Back to top-->
  <div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
  <!--/Back to top-->

  <!--Login-Form -->
  <?php include('includes/login.php'); ?>
  <!--/Login-Form -->

  <!--Register-Form -->
  <?php include('includes/registration.php'); ?>

  <!--/Register-Form -->

  <!--Forgot-password-Form -->
  <?php include('includes/forgotpassword.php'); ?>
  <!--/Forgot-password-Form -->

  <!-- Scripts -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/interface.js"></script>
  <!--Switcher-->
  <script src="assets/switcher/js/switcher.js"></script>
  <!--bootstrap-slider-JS-->
  <script src="assets/js/bootstrap-slider.min.js"></script>
  <!--Slider-JS-->
  <script src="assets/js/slick.min.js"></script>
  <script src="assets/js/owl.carousel.min.js"></script>


</body>

</html>