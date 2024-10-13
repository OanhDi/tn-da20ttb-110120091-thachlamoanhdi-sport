<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else {
  ?><!DOCTYPE HTML>
  <html lang="en">

  <head>

    <title>TVU Sport Center | My Booking</title>
    <!--Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <!--Custome Style -->
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <!--OWL Carousel slider-->
    <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
    <!--slick-slider -->
    <link href="assets/css/slick.css" rel="stylesheet">
    <!--bootstrap-slider -->
    <link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
    <!--FontAwesome Font Style -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">

    <!-- SWITCHER -->
    <link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all"
      data-default-color="true" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
      href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
      href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
      href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="assets/images/favicon-icon/logo.jpg">
    <!-- Google-Font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript"
      src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  </head>

  <body>

    <!-- Start Switcher -->
    <?php include('includes/colorswitcher.php'); ?>
    <!-- /Switcher -->

    <!--Header-->
    <?php include('includes/header.php'); ?>
    <!--Page Header-->
    <!-- /Header -->

    <!--Page Header-->
    <section class="page-header profile_page">
      <div class="container">
        <div class="page-header_wrap">
          <div class="page-heading">
            <h1>Lịch Thi Đấu</h1>
          </div>
          <ul class="coustom-breadcrumb">
            <li><a href="#">Trang Chủ</a></li>
            <li>Lịch Thi Đấu</li>
          </ul>
        </div>
      </div>
      <!-- Dark Overlay-->
      <div class="dark-overlay"></div>
    </section>
    <!-- /Page Header-->

    <?php
    $useremail = $_SESSION['login'];
    $sql = "SELECT u.*,t.FlagImage,t.FlagName from tblusers u 
INNER JOIN tblteams t ON t.CustomerID = u.CustomerID
WHERE u.EmailId=:useremail ";
    $query = $dbh->prepare($sql);
    $query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt = 1;
    if ($query->rowCount() > 0) {
      foreach ($results as $result) { ?>
        <section class="user_profile inner_pages">
          <div class="container">
            <div class="user_profile_info gray-bg padding_4x4_40">
              <div class="upload_user_logo"> <img src="<?php echo htmlentities($result->FlagImage); ?>"
                  alt="<?php echo htmlentities($result->FlagName); ?>">
              </div>

              <div class="dealer_info">
                <h5><?php echo htmlentities($result->FullName); ?></h5>
                <p><?php echo htmlentities($result->Address); ?><br>
                  <?php echo htmlentities($result->City); ?>&nbsp;
                  <?php echo htmlentities($result->Country);
      }
    } ?>
            </p>
          </div>
        </div>
        <div class="row listing-detail">
          <div class="col-md-2 col-sm-2">
            <?php include('includes/sidebar.php'); ?>
            <div class="col-md-10 col-sm-10">
              <div class="profile_wrap">
                <h5 class="uppercase underline">Lịch Thi Đấu </h5>
                <div class="form-group">
                  <label for="datematch">Chọn Ngày :</label>
                  <input type="text" class="form-control" name="datematch" id="datematch" placeholder="Chọn ngày"
                    required>
                </div>
                <div class="btn-group" style="padding-bottom: 1rem;">
                  <button id="searchButton" class="btn btn-primary">Tìm Kiếm</button>
                </div>
                <div id="formData">
                  <div class="my_vehicles_list">
                    <ul class="vehicle_listing">
                      <div class="table-responsive">
                        <table class="table table-bordered table-hover team-table">
                          <thead class="thead-dark">
                            <tr>
                              <th scope="col">STT</th>
                              <th scope="col">Đội Nhà</th>
                              <th scope="col">Đội Khách</th>
                              <th scope="col">Sân</th>
                              <th scope="col">Ngày</th>
                              <th scope="col">Giờ</th>
                              <th scope="col" colspan="2">Tỷ số</th>
                              <th scope="col">Trạng Thái</th>
                              <th style="text-align: center;" scope="col" colspan="2">Hành Động</th>
                            </tr>
                          </thead>
                          <tbody id="bodyTeam">

                          </tbody>
                        </table>
                        <nav>
                          <ul class="pagination" id="pagination">
                            <!-- Nút phân trang sẽ được thêm vào đây -->
                          </ul>
                        </nav>
                      </div>
                    </ul>
                  </div>

                  <h6 class="uppercase underline">Trận đấu bị từ chối </h6>
                  <div class="my_vehicles_list">
                    <ul class="vehicle_listing">
                      <div class="table-responsive">
                        <table class="table table-bordered table-hover team-table">
                          <thead class="thead-dark">
                            <tr>
                              <th scope="col">STT</th>
                              <th scope="col">Đội Nhà</th>
                              <th scope="col">Đội Khách</th>
                              <th scope="col">Sân</th>
                              <th scope="col">Ngày</th>
                              <th scope="col">Giờ</th>
                              <th scope="col" colspan="2">Tỷ số</th>
                              <th scope="col">Trạng Thái</th>
                            </tr>
                          </thead>
                          <tbody id="bodyTeamReject">

                          </tbody>
                        </table>
                        <nav>
                          <ul class="pagination" id="paginationRM">
                            <!-- Nút phân trang sẽ được thêm vào đây -->
                          </ul>
                        </nav>
                      </div>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
    <!--/my-vehicles-->
    <?php include('includes/footer.php'); ?>
    <script>
      flatpickr('#datematch', {
        dateFormat: 'd/m/Y',
        altFormat: 'd/m/Y',
        altInput: true,
        mode: 'single',
        enableTime: false
      });
    </script>
    <script>
      $(document).ready(function () {
        // console.log($_SESSION['login']);
        <?php if (isset($_SESSION['login'])): ?>
          $('.listing-detail').show();
          $('#loginform').modal('hide');
        <?php else: ?>
          $('#loginform').modal('show');
          $('.listing-detail').hide();
          $('#loginform').append('<input type="hidden" name="redirect_url" value="' + window.location.href + '">');
        <?php endif; ?>
        //Ẩn form 
        $('#formData').hide();
        //Search Data
        document.getElementById('searchButton').addEventListener('click', function () {
          var Bkdate = document.querySelector('input[name="datematch"]').value;
          const per_page = 5;
          loadTeams(1, per_page, Bkdate);
          loadTeamsRM(1, per_page, Bkdate);
          $('#formData').show();
        });
        //Load List team
        var Customer = '<?php echo $_SESSION['CustomerID']; ?>';

        function loadTeams(page, per_page, Bkdate) {
          $.ajax({
            url: 'booking/getMyBooking.php',
            method: 'GET',
            data: {
              page: page,
              per_page: per_page,
              bk_date: Bkdate
            },
            success: function (response) {
              try {
                // console.log('Response from server:', response); // Ghi log dữ liệu trả về
                const result = JSON.parse(response);
                // console.log(result);
                if (result.error) {
                  console.error("Server error:", result.error);
                  return;
                }

                const data = result.data;
                const total = result.total;
                 console.log(total);
                const body = $('#bodyTeam');
                body.empty(); // Xóa các dòng hiện tại
                if (data && data.length > 0) {
                  data.forEach((result, index) => {
                    const TeamAway = result.TeamAway === null ? '' : result.TeamAway;
                    const ScoreTeamHome = result.ScoreTeamHome === null ? '' : result.ScoreTeamHome;
                    const ScoreTeamAway = result.ScoreTeamAway === null ? '' : result.ScoreTeamAway;
                    let NameTeamA = '';
                    let NameTeamB = '';
                    let Buntton = ``;
                    let Buntton2 = ``;
                    // console.log(result.TeamHome,Customer);
                    if (String(result.ID_Home) === String(Customer)) {
                      NameTeamA = 'style="font-weight: bold;"';
                      if (String(result.StatusID) === '1') {
                        Buntton = `<td colspan="2"><button class="btn btn-sm btn-primary" data-id="huysan-1" id="btn-${result.BookingID}">Huỷ Sân</button></td>`;
                      }
                      if (String(result.StatusID) === '2') {
                        Buntton2 = `<td><button class="btn btn-sm btn-primary" data-id="chapnhan-2" id="btn-${result.BookingID}">Chấp Nhận</button></td>`;
                        Buntton = `<td><button class="btn btn-sm btn-primary"  data-id="tuchoi-2" id="btn1-${result.BookingID}">Từ Chối</button></td>`;
                      }
                    }
                    if (String(result.ID_Away) === String(Customer)) {
                      NameTeamB = 'style="font-weight: bold;"';

                      if (String(result.StatusID) === '2') {
                        Buntton = `<td colspan="2"><button class="btn btn-sm btn-primary" data-id="huytran-2" id="btn-${result.BookingID}">Huỷ Trận</button></td>`;
                      }
                    }
                    const STT = index + 1 + (page - 1) * per_page;
                    const column = `<tr>
                                                                <td style="text-align: center;">${STT}</td>
                                                                <td ${NameTeamA}>${result.TeamHome}</td>
                                                                <td ${NameTeamB}>${TeamAway}</td>
                                                                <td style="text-align: center;">${result.FieldName}</td>
                                                                <td style="text-align: center;">${result.BookingDate}</td>
                                                                <td style="text-align: center;">${result.NameMatch}</td>
                                                                <td style="text-align: center;">${ScoreTeamHome}</td>
                                                                <td style="text-align: center;">${ScoreTeamAway}</td>
                                                                <td style="color: blue">${result.Status}</td>
                                                                 ${Buntton2}
                                                                 ${Buntton}
                                                              </tr>`;
                    body.append(column);
                    $(`#btn-${result.BookingID}`).on('click', function () {
                      const action = $(this).data('id');
                      const bookingID = result.BookingID;

                      switch (action) {
                        case 'huysan-1':
                          // Handle 'Huỷ Sân' button click
                          cancelField(bookingID)
                          // console.log('Huỷ Sân button clicked for booking ID:', bookingID);
                          break;
                        case 'chapnhan-2':
                          // Handle 'Chấp Nhận' button click
                          acceptMatch(bookingID)
                          // console.log('Chấp Nhận button clicked for booking ID:', bookingID);
                          break;
                        case 'huytran-2':
                          // Handle 'Huỷ Trận' button click
                          CancelMatch(bookingID)
                          // console.log('Huỷ Trận button clicked for booking ID:', bookingID);
                          break;
                        default:
                          console.log('No action matched');
                      }
                    });
                    $(`#btn1-${result.BookingID}`).on('click', function () {
                      const action = $(this).data('id');
                      const bookingID = result.BookingID;

                      switch (action) {
                        case 'tuchoi-2':
                          // Handle 'Từ Chối' button click
                          // console.log('Từ Chối button clicked for booking ID:', bookingID);
                          RejectMatch(bookingID);
                          break;
                        default:
                          console.log('No action matched');
                      }
                    });
                  });
                }
                // Tạo nút phân trang
                createPagination(total, per_page, page, Bkdate);
              } catch (e) {
                console.error("Error parsing JSON:", e);
              }
            },
            error: function (xhr, status, error) {
              console.error("AJAX error:", status, error);
            }
          });
        }
        //Huy san
        function cancelField(bookingID) {
          $.ajax({
            url: 'booking/mycancelmatches.php',
            method: 'POST',
            data: {
              bookingID: bookingID
            },
            success: function (response) {

              const results_huysan = JSON.parse(response);
              if (results_huysan) {
                if (Array.isArray(results_huysan)) {
                  results_huysan.forEach(result => {
                    if (result.status === 'success') {
                      toastr.success(result.message, 'Thông Báo');
                      setTimeout(function () {
                        location.href = 'my-booking.php';
                      }, 1000);
                    } else {
                      toastr.error(result.message, 'Thông Báo!');
                      setTimeout(function () {
                        location.href = 'my-booking.php';
                      }, 1000);
                    }
                  });
                }
              }
            }
          });
        }
        //Huy tran
        function CancelMatch(bookingID) {
          $.ajax({
            url: 'booking/mymatchFieldCancel.php',
            method: 'POST',
            data: {
              bookingID: bookingID
            },
            success: function (response) {
              const results_huytran = JSON.parse(response);
              console.log(results_huytran);
              if (results_huytran) {
                if (Array.isArray(results_huytran)) {
                  results_huytran.forEach(result => {
                    if (result.status === 'success') {
                      toastr.success(result.message, 'Thông Báo');
                      setTimeout(function () {
                        location.href = 'my-booking.php';
                      }, 1000);
                    } else {
                      toastr.error(result.message, 'Thông Báo!');
                      setTimeout(function () {
                        location.href = 'my-booking.php';
                      }, 1000);
                    }
                  });
                }
              }
            }
          });
        }
        //Tu choi
        function RejectMatch(bookingID) {
          $.ajax({
            url: 'booking/myRejectMatch.php',
            method: 'POST',
            data: {
              bookingID: bookingID
            },
            success: function (response) {
              const results_tuchoi = JSON.parse(response);
              console.log(results_tuchoi);
              if (results_tuchoi) {
                if (Array.isArray(results_tuchoi)) {
                  results_tuchoi.forEach(result => {
                    if (result.status === 'success') {
                      toastr.success(result.message, 'Thông Báo');
                      setTimeout(function () {
                        location.href = 'my-booking.php';
                      }, 1000);
                    } else {
                      toastr.error(result.message, 'Thông Báo!');
                      setTimeout(function () {
                        location.href = 'my-booking.php';
                      }, 1000);
                    }
                  });
                }
              }
            }
          });
        }
        //chap nhan
        function acceptMatch(bookingID) {
          $.ajax({
            url: 'booking/myacceptMatch.php',
            method: 'POST',
            data: {
              bookingID: bookingID
            },
            success: function (response) {

              const results_accept = JSON.parse(response);
              if (results_accept) {
                if (Array.isArray(results_accept)) {
                  results_accept.forEach(result => {
                    if (result.status === 'success') {
                      toastr.success(result.message, 'Thông Báo');
                      setTimeout(function () {
                        location.href = 'my-booking.php';
                      }, 1000);
                    } else {
                      toastr.error(result.message, 'Thông Báo!');
                      setTimeout(function () {
                        location.href = 'my-booking.php';
                      }, 1000);
                    }
                  });
                }
              }
            }
          });
        }
        //Load data Reject Match
        function loadTeamsRM(page, per_page, Bkdate) {
          //Load Reject Match
          $.ajax({
            url: 'booking/getRejectMatch.php',
            method: 'GET',
            data: {
              page: page,
              per_page: per_page,
              bk_date: Bkdate
            },
            success: function (response) {
              try {
                console.log('Response from server:', response); // Ghi log dữ liệu trả về
                const result = JSON.parse(response);

                if (result.error) {
                  console.error("Server error:", result.error);
                  return;
                }

                const data = result.data;
                const total = result.total;
                 console.log(total);
                const body = $('#bodyTeamReject');
                body.empty(); // Xóa các dòng hiện tại
                if (data && data.length > 0) {
                  data.forEach((result, index) => {
                    const TeamAway = result.TeamAway === null ? '' : result.TeamAway;
                    const ScoreTeamHome = result.ScoreTeamHome === null ? '' : result.ScoreTeamHome;
                    const ScoreTeamAway = result.ScoreTeamAway === null ? '' : result.ScoreTeamAway;
                    let NameTeamA = '';
                    let NameTeamB = '';
                    // console.log(result.TeamHome,Customer);
                    if (String(result.ID_Home) === String(Customer)) {
                      NameTeamA = 'style="font-weight: bold;"';
                    }
                    if (String(result.ID_Away) === String(Customer)) {
                      NameTeamB = 'style="font-weight: bold;"';
                    }
                    const column = `<tr>
                                                                <td style="text-align: center;">${index + 1}</td>
                                                                <td ${NameTeamA}>${result.TeamHome}</td>
                                                                <td ${NameTeamB}>${TeamAway}</td>
                                                                <td style="text-align: center;">${result.FieldName}</td>
                                                                <td style="text-align: center;">${result.BookingDate}</td>
                                                                <td style="text-align: center;">${result.NameMatch}</td>
                                                                <td style="text-align: center;">${ScoreTeamHome}</td>
                                                                <td style="text-align: center;">${ScoreTeamAway}</td>
                                                                <td style="color: blue">${result.Status}</td>
                                                              </tr>`;
                    body.append(column);
                  });
                }
                // Tạo nút phân trang          
                createPaginationRM(total, per_page, page, Bkdate);
              } catch (e) {
                console.error("Error parsing JSON:", e);
              }
            },
            error: function (xhr, status, error) {
              console.error("AJAX error:", status, error);
            }
          });
        }

        function createPagination(total, per_page, current_page, Bkdate) {
          const total_pages = Math.ceil(total / per_page);
          const pagination = $('#pagination');
          pagination.empty(); // Xóa các nút phân trang hiện tại

          const prev_disabled = current_page === 1 ? 'disabled' : '';
          const next_disabled = current_page === total_pages ? 'disabled' : '';

          pagination.append(`<li class="page-item ${prev_disabled}"><a class="page-link" href="#" data-page="${current_page - 1}">Previous</a></li>`);

          for (let i = 1; i <= total_pages; i++) {
            const active = i === current_page ? 'active' : '';
            const pageItem = `<li class="page-item ${active}"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`;
            pagination.append(pageItem);
          }

          pagination.append(`<li class="page-item ${next_disabled}"><a class="page-link" href="#" data-page="${current_page + 1}">Next</a></li>`);

          // Thêm sự kiện click cho các nút phân trang
          $('.page-link').click(function (e) {
            e.preventDefault();
            const page = parseInt($(this).data('page'));
            if (page >= 1 && page <= total_pages) {
              loadTeams(page, per_page, Bkdate);
            }
          });
        }
        function createPaginationRM(total, per_page, current_page, Bkdate) {
          const total_pages = Math.ceil(total / per_page);
          const pagination = $('#paginationRM');
          pagination.empty(); // Xóa các nút phân trang hiện tại

          const prev_disabled = current_page === 1 ? 'disabled' : '';
          const next_disabled = current_page === total_pages ? 'disabled' : '';

          pagination.append(`<li class="page-item ${prev_disabled}"><a class="page-link" href="#" data-page="${current_page - 1}">Previous</a></li>`);

          for (let i = 1; i <= total_pages; i++) {
            const active = i === current_page ? 'active' : '';
            const pageItem = `<li class="page-item ${active}"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`;
            pagination.append(pageItem);
          }

          pagination.append(`<li class="page-item ${next_disabled}"><a class="page-link" href="#" data-page="${current_page + 1}">Next</a></li>`);

          // Thêm sự kiện click cho các nút phân trang
          $('.page-link').click(function (e) {
            e.preventDefault();
            const page = parseInt($(this).data('page'));
            if (page >= 1 && page <= total_pages) {
              loadTeamsRM(page, per_page, Bkdate);
            }
          });
        }
      });       
    </script>

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
<?php } ?>