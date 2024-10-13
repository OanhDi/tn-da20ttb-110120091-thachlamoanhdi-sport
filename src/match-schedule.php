<?php
session_start();

include ('includes/config.php');
error_reporting(0);

?>


<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>TVU Sport Center | Match Schedule</title>
    <!--Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <!--Custome Style -->
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="assets/css/styleMatch.css" type="text/css">
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
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
        href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="assets/images/favicon-icon/logo.jpg">
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
    <style>

    </style>
</head>

<body>

    <!-- Start Switcher -->
    <?php include ('includes/colorswitcher.php'); ?>
    <!-- /Switcher -->

    <!--Header-->
    <?php include ('includes/header.php'); ?>
    <!-- /Header -->

    <!--Listing-Image-Slider-->
    <section id="listing_img_slider_bk"></section>
    <?php
    $currenturl = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    ?>
    <!--/Listing-Image-Slider-->
    <!--Listing-detail-->
    <section class="listing-detail">
        <div class="container">
            <div class="container mt-12">
                <h2 class="mb-4">Lịch Thi Đấu</h2>
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="category">Thể Loại Thể Thao</label>
                            <select class="form-control" name="fieldType" id="fieldType" required>
                                <option value="">Chọn Thể Loại</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category">Sân Thi Đấu</label>
                            <select class="form-control" name="field" id="field" required>
                                <option value="">Chọn Sân</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="datematch">Chọn Ngày :</label>
                            <input type="text" class="form-control" name="datematch" id="datematch"
                                placeholder="Chọn ngày" required>
                        </div>
                        <div class="form-group">
                            <label for="timefrominput">Chọn khung giờ từ :</label>
                            <select class="form-control" name="starttime" id="starttime" required>
                                <option value="">Chọn Giờ</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="timetoinput">Chọn khung giờ đến :</label>
                            <select class="form-control" name="endtime" id="endtime" required>
                                <option value="">Chọn Giờ</option>
                            </select>
                        </div>
                        <div class="btn-group">
                            <button id="searchButton" class="btn btn-primary">Tìm Kiếm</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive" style="padding-top: 2rem;" id="tabledata">

                </div>
            </div>
        </div>
    </section>
    <!--/Listing-detail-->

    <!--Footer -->
    <?php include ('includes/footer.php'); ?>
    <!-- /Footer-->

    <!--Back to top-->
    <div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
    <!--/Back to top-->

    <!--Login-Form -->
    <?php include ('includes/login.php'); ?>
    <!--/Login-Form -->

    <!--Register-Form -->
    <?php include ('includes/registration.php'); ?>

    <!--/Register-Form -->

    <!--Forgot-password-Form -->
    <?php include ('includes/forgotpassword.php'); ?>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/interface.js"></script>
    <script src="assets/switcher/js/switcher.js"></script>
    <script src="assets/js/bootstrap-slider.min.js"></script>
    <script src="assets/js/slick.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>    
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
        async function fetchData(LoginID, Starttime, Endtime, Bkdate, FieldType, Field) {
            try {
                const searchMatchResponse = await $.ajax({
                    url: 'match-schedule/getmatch-schedule.php',
                    method: 'POST',
                    data: {
                        starttime: Starttime,
                        endtime: Endtime,
                        BookingDate: Bkdate,
                        fieldTypeID: FieldType,
                        fieldid: Field
                    }
                });
                //  console.log(Starttime,Endtime,Bkdate,FieldType,Field);
                const results = JSON.parse(searchMatchResponse);
                const dataShow = $('#tabledata');
                dataShow.empty();
                // console.log(results);
                if (results && results.length > 0) {
                    results.forEach(result => {
                        let scoreTeamHome = result.ScoreTeamHome;
                        if (scoreTeamHome === null || scoreTeamHome === 'null') {
                            scoreTeamHome = '-';
                        }
                        let referee = result.Referee;
                        if (referee === null || referee === 'null') {
                            referee = '';
                        }
                        let scoreTeamAway = result.ScoreTeamAway;
                        if (scoreTeamAway === null || scoreTeamAway === 'null') {
                            scoreTeamAway = '-';
                        }
                        let Status = '';
                        if (String(result.Status) === '3') {
                            Status = 'Sẵn sàng thi đấu';
                        } else if (String(result.Status) === '4') {
                            Status = 'Kết thúc trận đấu';
                        } else {
                            Status = ''; // Thêm trạng thái mặc định nếu cần
                        }
                        const add = `<div class="match">
                        <div class="match-info">
                            <h6 class="group">Sân Đấu: ${result.FieldName}</h6>
                            <h6 class="group">Mã Trận Đấu: ${result.MatchID}</h6>
                        </div>
                        <div class="flags">
                            <div class="home-flag">
                                <img src="${result.HomeTeamFlagImage}" alt="${result.HomeTeamFlagName}" class="flag" />
                                <h6 class="home-team">${result.HomeTeamName}</h6>
                            </div>
                            <span class="vs1">
                                ${scoreTeamHome}
                            </span>
                            <span class="vs1">
                                VS
                            </span>
                            <span class="vs1">
                             ${scoreTeamAway}
                            </span>
                            <div class="away-flag">
                                <img src="${result.AwayTeamFlagImage}" alt="${result.AwayTeamFlagName}" class="flag" />
                                <h6 class="home-team">${result.AwayTeamName}</h6>
                            </div>
                        </div>
                        <div class="time-area">
                            <div class="time">
                                <h6 class="date"><span><i style="padding-right: 0.5rem;" class="fa fa-calendar"
                                            aria-hidden="true"></i></span>Ngày Thi Đấu: </h6>
                                <h6 class="date">${result.BookingDate}</h6>
                            </div>
                            <h6 class="match-time"><span><i style="padding-right: 0.5rem;" class="fa fa-clock-o"
                                        aria-hidden="true"></i></span>Giờ Đấu: ${result.NameMatch}</h6>
                            <h6 class="match-time"><span><i style="padding-right: 0.5rem;" class="fa fa-user"
                                        aria-hidden="true"></i></span>Trọng Tài: ${referee}</h6>
                            <h6 class="status"><span><i style="padding-right: 0.5rem;" class="fa fa-bell"
                                        aria-hidden="true"></i></span>Trạng Thái: <span></span>${Status}</h6>
                        </div>
                    </div>
                    <div style="padding: 1rem 0 1rem 0;"></div>`;
                        dataShow.append(add);
                    });
                }
            } catch (e) {
                console.error("Error:", e);
            }
        }
        $(document).ready(function () {
            <?php if (isset($_SESSION['login'])): ?>
                $('.listing-detail').show();
                $('#loginform').modal('hide');
            <?php else: ?>
                $('#loginform').modal('show');
                $('.listing-detail').hide();
                $('#loginForm').append('<input type="hidden" name="redirect_url" value="' + currentUrl + '">');
            <?php endif; ?>
            document.getElementById('searchButton').addEventListener('click', function () {
                const Bkdate = document.querySelector('input[name="datematch"]').value;
                const FieldType = $('#fieldType').val();
                const Starttime = $('#starttime').val();
                const Endtime = $('#endtime').val();
                const Field = $('#field').val();
                var LoginID = '<?php echo $_SESSION['login']; ?>';
                //  alert(LoginID);
                var GetemailID = null;
                if (!Starttime || !Endtime) {
                    alert('Vui lòng chọn giờ.');
                    return;
                }
                if (!Bkdate) {
                    alert('Vui lòng chọn ngày.');
                    return;
                }
                fetchData(LoginID, Starttime, Endtime, Bkdate, FieldType, Field);
            });
            //Load data Time
            $.ajax({
                url: 'booking/getStartTime.php',
                method: 'GET',
                success: function (response) {

                    try {
                        const results = JSON.parse(response);
                        const starttime = $('#starttime');
                        const endtime = $('#endtime');
                        if (results && results.length > 0) {
                            results.forEach(result => {
                                const optionSt = `<option value="${result.StartTime}">${result.NameMatch}</option>`;
                                starttime.append(optionSt);
                                endtime.append(optionSt);
                            });
                        }
                    } catch (e) {
                        console.error("Error parsing JSON:", e);
                    }
                }
            });
            //Load data FieldType
            $.ajax({
                url: 'booking/fieldType.php',
                method: 'GET',
                success: function (response) {

                    try {
                        const results = JSON.parse(response);
                        const selectField = $('#fieldType');
                        if (results && results.length > 0) {
                            results.forEach(result => {
                                const option = `<option value="${result.FieldTypeID}">${result.TypeName}</option>`;
                                selectField.append(option);
                            });
                        }
                    } catch (e) {
                        console.error("Error parsing JSON:", e);
                    }
                }
            });
            //Load data Field
            $('#fieldType').change(function () {
                var selectedValue = $(this).val();
                $.ajax({
                    url: 'booking/field.php',
                    method: 'POST',
                    data: {
                        fieldtypeid: selectedValue
                    },
                    success: function (response) {
                        try {
                            const results = JSON.parse(response);
                            const selectField = $('#field');
                            const tbody = $('#resultTable tbody');
                            tbody.empty();

                            selectField.empty();
                            if (results && results.length > 0) {
                                results.forEach(result => {
                                    const option = `<option value="${result.FieldID}">${result.FieldName}</option>`;
                                    selectField.append(option);
                                });
                            }
                        } catch (e) {
                            console.error("Error parsing JSON:", e);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX Error:", status, error);
                    }
                });
            });
            //Load banner
            $.ajax({
                url: 'booking/bannerSlide.php',
                method: 'GET',
                success: function (response) {
                    try {
                        const results4 = JSON.parse(response);
                        const selectFieldImg = $('#listing_img_slider_bk');

                        selectFieldImg.empty();
                        if (results4 && results4.length > 0) {
                            results4.forEach(result => {
                                const images = ['Vimage1', 'Vimage2', 'Vimage3', 'Vimage4'];
                                images.forEach(imageKey => {
                                    if (result[imageKey]) {
                                        var imgElement = $('<div><img src="admin/img/bannerimage/' + result[imageKey] + '" class="img-responsive" alt="image" width="900" height="560"></div>');
                                        selectFieldImg.append(imgElement);
                                    }
                                });

                            });
                        }
                        // Khởi tạo Owl Carousel sau khi thêm các ảnh
                        $("#listing_img_slider_bk").owlCarousel({
                            itemsCustom: [
                                [0, 1],
                                [450, 1],
                                [700, 2],
                                [1024, 3],
                                [1200, 3],
                            ],
                            loop: true,
                            nav: true,
                            navigation: true,
                            pagination: false,
                            autoPlay: 3000
                        });

                        // Khởi tạo Slick Carousel
                        $('.listing_img_slider_bk').slick({
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            arrows: false,
                            fade: true,
                            asNavFor: '.listing_images_slider_bk_nav'
                        });
                        $('.listing_images_slider_bk_nav').slick({
                            slidesToShow: 4,
                            slidesToScroll: 1,
                            asNavFor: '.listing_images_slider_bk',
                            dots: false,
                            centerMode: true,
                            focusOnSelect: true
                        });
                    } catch (e) {
                        console.error("Error parsing JSON:", e);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                }
            });
            //Load data FieldType
            //Load
        });       
    </script>
    <!-- <script>
    document.getElementById('searchButton').addEventListener('click', function() {
        
});
  </script> -->
</body>

</html>