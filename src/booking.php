<?php
session_start();

include('includes/config.php');
error_reporting(0);
?>


<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>TVU Sport Center | Bookings</title>
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
    <style>
        .responsive-img {
            max-width: 100%;
            width: 100%;
            height: auto;
            max-width: 800px;
        }

        .table-img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .table-cell {
            text-align: center;
            vertical-align: middle;
            padding: 10px;
        }

        .info {
            text-align: left;
        }

        .btn-group {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .btn-group .btn {
            flex: 1;
            margin: 0 5px;
        }

        .table-buttons {
            display: flex;
            justify-content: center;
        }

        th {
            text-align: center;
            vertical-align: middle;
            font-size: 15px;
            font-weight: bold;
        }

        .table-img {
            display: block;
            /* Đảm bảo hình ảnh là một khối inline */
            max-width: 100%;
            /* Giữ cho hình ảnh không vượt quá kích thước của phần tử cha */
            height: auto;
            /* Đảm bảo tỷ lệ khung hình bảo toàn */
            transition: transform 0.2s ease-in-out;
            /* Hiệu ứng chuyển đổi mượt mà */
        }

        .table-img:hover {
            transform: scale(1.1);
            /* Phóng to hình ảnh khi di chuột vào */
            cursor: pointer;
            /* Biểu tượng con trỏ để chỉ ra rằng nó là một liên kết có thể nhấp */
        }
    </style>
</head>

<body>

    <!-- Start Switcher -->
    <?php include('includes/colorswitcher.php'); ?>
    <!-- /Switcher -->

    <!--Header-->
    <?php include('includes/header.php'); ?>
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
            <div class="listing_detail_head row">
                <div class="col-md-12">
                    <div class="card mb-12">
                        <div class="card-body">
                            <h2 class="card-title">Đặt Lịch Thi đấu</h2>
                            <!-- Group dòng trên -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="bongkingtype">Loại Đặt Sân</label>
                                        <select class="form-control" name="bookingtype" id="bookingtype" required>
                                            <option value="normal">Bình Thường</option>
                                            <option value="fixed">Cố Định</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Thể Loại Thể Thao</label>
                                        <select class="form-control" name="fieldType" id="fieldType" required>
                                            <option value="">Chọn Thể Loại</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldtype">Loại Sân</label>
                                        <select class="form-control" disabled name="ftype" id="ftype" required>
                                            <option value="">---</option>
                                            <option value="5">Sân 5</option>
                                            <option value="7">Sân 7</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="starttimeform" style="display:none;">
                                        <label for="timefrominput">Chọn khung giờ:</label>
                                        <select class="form-control" name="starttime" id="starttime" required>
                                            <option value="">Chọn Giờ</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Sân Thi Đấu</label>
                                        <select class="form-control" name="field" id="field" required>
                                            <option value="">Chọn Sân</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="cyclegroup" style="display:none;">
                                        <label for="cycle">Chu Kỳ</label>
                                        <select class="form-control" name="cycledata" id="cycledata" required>
                                            <option value="everyday">Hằng Ngày</option>
                                            <option value="weekly">Hằng Tuần</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="dayofweekform" style="display:none;">
                                        <label for="dayofweek">Chọn Ngày Trong Tuần</label>
                                        <select class="form-control" name="dayofweek" id="dayofweek" required>
                                            <option value="Monday">Thứ Hai</option>
                                            <option value="Tuesday">Thứ Ba</option>
                                            <option value="Wednesday">Thứ Tư</option>
                                            <option value="Thursday">Thứ Năm</option>
                                            <option value="Friday">Thứ Sáu</option>
                                            <option value="Saturday">Thứ Bảy</option>
                                            <option value="Sunday">Chủ Nhật</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="datematch">Chọn Ngày :</label>
                                        <input type="text" class="form-control" name="datematch" id="datematch"
                                            placeholder="Chọn ngày" required>
                                    </div>
                                    <div class="form-group" id="todate" style="display:none;">
                                        <label for="datematch">Đến Ngày :</label>
                                        <input type="text" class="form-control" name="todatematch" id="todatematch"
                                            placeholder="Đến ngày" required>
                                    </div>
                                    <div class="form-group" id="timestart" style="display:none;">
                                        <label for="timefrominput">Chọn khung giờ từ :</label>
                                        <input type="text" class="form-control" name="timefrominput" id="timefrominput"
                                            placeholder="Chọn giờ và phút" required>
                                    </div>
                                    <div class="form-group" id="timeend" style="display:none;">
                                        <label for="timetoinput">Chọn khung giờ đến :</label>
                                        <input type="text" class="form-control" name="timetoinput" id="timetoinput"
                                            placeholder="Chọn giờ và phút" required>
                                    </div>
                                    <div class="btn-group" id="searchbtn" style="display:none;">
                                        <button id="searchButton" class="btn btn-primary">Tìm Kiếm</button>
                                    </div>
                                    <div class="btn-group" id="btnbookinggroup" style="display:none;">
                                        <button id="btnbooking" class="btn btn-primary">Đặt Sân</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="resultTable" class="table table-bordered hidden mt-3">
                                        <thead>
                                            <tr id="trField">
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Rows will be appended here by JavaScript -->
                                        </tbody>
                                        <!-- code o day -->
                                    </table>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/Listing-detail-->

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

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/interface.js"></script>
    <script src="assets/switcher/js/switcher.js"></script>
    <script src="assets/js/bootstrap-slider.min.js"></script>
    <script src="assets/js/slick.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script>
        flatpickr('#datematch', {
            dateFormat: 'd/m/Y',
            altFormat: 'd/m/Y',
            altInput: true,
            mode: 'single',
            enableTime: false,
            minDate: 'today'
        });
        flatpickr('#todatematch', {
            dateFormat: 'd/m/Y',
            altFormat: 'd/m/Y',
            altInput: true,
            mode: 'single',
            enableTime: false,
            minDate: 'today'
        });
        flatpickr('#timefrominput', {
            enableTime: true,
            noCalendar: true,
            dateFormat: 'H:i',
            defaultDate: '07:00'
        });
        flatpickr('#timetoinput', {
            enableTime: true,
            noCalendar: true,
            dateFormat: 'H:i',
            defaultDate: '21:00'
        });
    </script>
    <script>
        $(document).ready(function () {
            var select = $('#bookingtype').val();
            var selectcycle = $('#cycledata').val();
            if (select === 'normal') {
                $('#todate').hide();
                $('#timestart').show();
                $('#timeend').show();
                $('#searchbtn').show();
                $('#cyclegroup').hide();
                $('#starttimeform').hide();
                $('#btnbookinggroup').hide();
            } else if (select === 'fixed') {
                $('#todate').show();
                $('#timestart').hide();
                $('#timeend').hide();
                $('#searchbtn').hide();
                $('#cyclegroup').show();
                $('#starttimeform').show();
                $('#btnbookinggroup').show();
                if (selectcycle === 'weekly') {
                    $('#dayofweekform').show();
                } else {
                    $('#dayofweekform').hide();
                }
                //Load time
                $.ajax({
                    url: 'booking/getStartTime.php',
                    method: 'GET',
                    success: function (response) {

                        try {
                            const results = JSON.parse(response);
                            const starttime = $('#starttime');
                            if (results && results.length > 0) {
                                results.forEach(result => {
                                    const optionSt = `<option value="${result.StartTime}">${result.NameMatch}</option>`;
                                    starttime.append(optionSt);
                                });
                            }
                        } catch (e) {
                            console.error("Error parsing JSON:", e);
                        }
                    }
                });
            }
            $('#cycledata').change(function () {
                var selectcycle = $('#cycledata').val();
                // alert(selectcycle);
                if (selectcycle === 'weekly') {
                    $('#dayofweekform').show();
                } else {
                    $('#dayofweekform').hide();
                }
            });
            $('#bookingtype').change(function () {
                var select = $('#bookingtype').val();
                var selectcycle = $('#cycledata').val();
                const tbody = $('#resultTable tbody');
                tbody.empty();
                const tileField = $('#trField');
                tileField.empty();
                if (select === 'normal') {
                    $('#todate').hide();
                    $('#timestart').show();
                    $('#timeend').show();
                    $('#searchbtn').show();
                    $('#cyclegroup').hide();
                    $('#starttimeform').hide();
                    $('#btnbookinggroup').hide();
                    $('#dayofweekform').hide();
                } else if (select === 'fixed') {
                    $('#todate').show();
                    $('#timestart').hide();
                    $('#timeend').hide();
                    $('#searchbtn').hide();
                    $('#cyclegroup').show();
                    $('#starttimeform').show();
                    $('#btnbookinggroup').show();
                    if (selectcycle === 'weekly') {
                        $('#dayofweekform').show();
                    } else {
                        $('#dayofweekform').hide();
                    }
                    //Load time
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
                }
            });

            <?php if (isset($_SESSION['login'])): ?>
                $('.listing-detail').show();
                $('#loginform').modal('hide');
            <?php else: ?>
                $('#loginform').modal('show');
                $('.listing-detail').hide();
                $('#loginForm').append('<input type="hidden" name="redirect_url" value="' + currentUrl + '">');
            <?php endif; ?>
            //Load banner
            $.ajax({
                url: 'booking/bannerSlide.php',
                method: 'GET',
                success: function (response) {
                    try {
                        const results = JSON.parse(response);
                        const selectFieldImg = $('#listing_img_slider_bk');

                        selectFieldImg.empty();
                        if (results && results.length > 0) {
                            results.forEach(result => {
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
        });
        //Load Field 
        $('#ftype').change(function () {
            var selectedValue = $(this).val();
            var valueField = '1';
            if (String(selectedValue) === '5') {
                $.ajax({
                    url: 'booking/field5.php',
                    method: 'POST',
                    data: {
                        fieldtypeid: valueField
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
                $.ajax({
                    url: 'booking/fieldTitle5.php',
                    method: 'POST',
                    data: {
                        fieldtypeid: valueField
                    },
                    success: function (response) {
                        try {
                            const results = JSON.parse(response);
                            let count = results.length;
                            const tileField = $('#trField');
                            tileField.empty();
                            let calculate = 100 / count;
                            if (results && results.length > 0) {
                                results.forEach(result => {
                                    const trTitle = `<th width="${calculate}%">${result.FieldName}</th>`;
                                    tileField.append(trTitle);
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
            }
            if (String(selectedValue) === '7') {
                $.ajax({
                    url: 'booking/field7.php',
                    method: 'POST',
                    data: {
                        fieldtypeid: valueField
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
                $.ajax({
                    url: 'booking/fieldTitle7.php',
                    method: 'POST',
                    data: {
                        fieldtypeid: valueField
                    },
                    success: function (response) {
                        try {
                            const results = JSON.parse(response);
                            let count = results.length;
                            const tileField = $('#trField');
                            tileField.empty();
                            let calculate = 100 / count;
                            if (results && results.length > 0) {
                                results.forEach(result => {
                                    const trTitle = `<th width="${calculate}%">${result.FieldName}</th>`;
                                    tileField.append(trTitle);
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
            }
        });
        //Load data Field
        $('#fieldType').change(function () {
            var selectedValue = $(this).val();
            if (String(selectedValue) === '1') {
                $('#ftype').prop('disabled', false);
            } else {
                $('#ftype').prop('disabled', true);
                $.ajax({
                    url: 'booking/fieldOrther.php',
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
                //Load Title table
                $.ajax({
                    url: 'booking/fieldTitleOrthers.php',
                    method: 'POST',
                    data: {
                        fieldtypeid: selectedValue
                    },
                    success: function (response) {
                        try {
                            const results = JSON.parse(response);
                            let count = results.length;
                            const tileField = $('#trField');
                            tileField.empty();
                            let calculate = 100 / count;
                            if (results && results.length > 0) {
                                results.forEach(result => {
                                    const trTitle = `<th width="${calculate}%">${result.FieldName}</th>`;
                                    tileField.append(trTitle);
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
            }


            // $('#searchButton').trigger('click');
        });
    </script>
    <script>
        function goToUrl(element) {
            var bookingID = element.getAttribute('data-booking-id-info');
            var encryptedBookingID = encrypt(bookingID);
            var url = 'booking-info.php?key=' + encodeURIComponent(encryptedBookingID);
            window.location.href = url;
        }
    </script>
    <script>
        document.getElementById('btnbooking').addEventListener('click', function () {
            const Timefrominput = $('#starttime').val();
            const Bkdate = document.querySelector('input[name="datematch"]').value;
            const BkdateEnd = document.querySelector('input[name="todatematch"]').value;
            const FieldType = $('#fieldType').val();
            const Field = $('#field').val();
            const FType = $('#ftype').val();
            const cycle = $('#cycledata').val();//everyday, weekly
            const dayofweek = $('#dayofweek').val();//Monday, Tuesday, Wednesday, Thursday, Friday, Saturday, Sunday
            var LoginID = '<?php echo $_SESSION['login']; ?>';
            //   alert(dayofweek);            
            if (!Timefrominput) {
                alert('Vui lòng chọn  giờ.');
                return;
            }
            if (!Bkdate) {
                alert('Vui lòng chọn ngày bắt đầu.');
                return;
            }
            if (!BkdateEnd) {
                alert('Vui lòng chọn ngày kết thúc.');
                return;
            }
            if (!FieldType) {
                alert('Vui lòng chọn loại thế thao.');
                return;
            }
            if (!FType) {
                alert('Vui lòng chọn loại sân.');
                return;
            }
            if (!Field) {
                alert('Vui lòng chọn sân.');
                return;
            }
            $.ajax({
                url: 'booking/bookingfixed.php',
                method: 'POST',
                data: {
                    Timefrominput: Timefrominput,
                    Bkdate: Bkdate,
                    BkdateEnd: BkdateEnd,
                    FieldType: FieldType,
                    Field: Field,
                    FType: FType,
                    cycle: cycle,
                    dayofweek: dayofweek,
                    LoginID: LoginID
                },
                success: function (response) {
                    try {
                        //  console.log(response);
                         const results = JSON.parse(response);
                        if (results) {
                            if (Array.isArray(results)) {
                                results.forEach(result => {
                                    if (result.status === 'success') {
                                        toastr.success(result.message), 'Thông Báo';
                                        setTimeout(function () {
                                            location.reload();
                                        }, 2000);
                                    } else {
                                        toastr.error(result.message, 'Thông Báo!')
                                    }
                                });
                            }
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
    </script>
    <script>
        document.getElementById('searchButton').addEventListener('click', function () {
            const Timefrominput = document.querySelector('input[name="timefrominput"]').value;
            const Timetoinput = document.querySelector('input[name="timetoinput"]').value;
            const Bkdate = document.querySelector('input[name="datematch"]').value;
            const FieldType = $('#fieldType').val();
            const Field = $('#field').val();
            const FType = $('#ftype').val();

            var LoginID = '<?php echo $_SESSION['login']; ?>';
            //  alert(LoginID);
            var GetemailID = null;
            if (!Timefrominput || !Timetoinput) {
                alert('Vui lòng chọn ngày và giờ.');
                return;
            }
            if (!Bkdate) {
                alert('Vui lòng chọn ngày.');
                return;
            }
            fetchData(LoginID, Timefrominput, Timetoinput, Bkdate, FieldType, Field, FType);
        });
        $(document).on('click', '.bookingButton', function () {

            // Xử lý logic khi nút được nhấp
            var bookingID = $(this).data('booking-id');
            var encryptedBookingID = encrypt(bookingID);
            // console.log(encryptedBookingID);
            var url = 'booking-detail.php?key=' + encodeURIComponent(encryptedBookingID);
            window.location.href = url;
        });
        function encrypt(text) {
            var key = CryptoJS.enc.Utf8.parse('12345678901234567890123456789012'); // 32 ký tự
            var iv = CryptoJS.enc.Utf8.parse('1234567890123456'); // 16 ký tự

            var encrypted = CryptoJS.AES.encrypt(CryptoJS.enc.Utf8.parse(text), key, {
                keySize: 256 / 8,
                iv: iv,
                mode: CryptoJS.mode.CBC,
                padding: CryptoJS.pad.Pkcs7
            });

            return encrypted.toString();
        }
        //FetchData
        async function fetchData(LoginID, Timefrominput, Timetoinput, Bkdate, FieldType, Field, FType) {
            try {
                // Gọi request đầu tiên
                const getCustomerResponse = await $.ajax({
                    url: 'booking/getCustomer.php',
                    method: 'POST',
                    data: {
                        emailId: LoginID
                    }
                });
                const GetemailID = JSON.parse(getCustomerResponse);
                //  console.log(FType);

                // Gọi request thứ hai
                let searchBookingsResponse;
                if (String(FType) === '5') {
                    searchBookingsResponse = await $.ajax({
                        url: 'booking/searchBookings5.php',
                        method: 'POST',
                        data: {
                            fromtimeSelect: Timefrominput,
                            totimeSelect: Timetoinput,
                            bkdateSelect: Bkdate,
                            fieldTypeID: FieldType,
                            fieldID: Field
                        }
                    });
                } else if (String(FType) === '7') {
                    searchBookingsResponse = await $.ajax({
                        url: 'booking/searchBookings7.php',
                        method: 'POST',
                        data: {
                            fromtimeSelect: Timefrominput,
                            totimeSelect: Timetoinput,
                            bkdateSelect: Bkdate,
                            fieldTypeID: FieldType,
                            fieldID: Field
                        }
                    });
                } else {
                    searchBookingsResponse = await $.ajax({
                        url: 'booking/searchBookings.php',
                        method: 'POST',
                        data: {
                            fromtimeSelect: Timefrominput,
                            totimeSelect: Timetoinput,
                            bkdateSelect: Bkdate,
                            fieldTypeID: FieldType,
                            fieldID: Field
                        }
                    });
                }
                // console.log(searchBookingsResponse);
                const results = JSON.parse(searchBookingsResponse);
                const tbody = $('#resultTable tbody');
                tbody.empty();

                if (results && results.length > 0) {
                    // Gọi request thứ ba
                    const getTimematchResponse = await $.ajax({
                        url: 'booking/getTimematch.php',
                        method: 'POST',
                        data: {
                            fromtimeSelect: Timefrominput,
                            totimeSelect: Timetoinput,
                            bkdateSelect: Bkdate,
                            fieldTypeID: FieldType,
                            fieldID: Field
                        }
                    });
                    const resultsgt = JSON.parse(getTimematchResponse);
                    let forFieldResponse;
                    if (resultsgt && resultsgt.length > 0) {
                        // Gọi request thứ tư
                        if (String(FType) === '5') {
                            forFieldResponse = await $.ajax({
                                url: 'booking/forField5.php',
                                method: 'POST',
                                data: {
                                    fromtimeSelect: Timefrominput,
                                    totimeSelect: Timetoinput,
                                    bkdateSelect: Bkdate,
                                    fieldType: FieldType

                                }
                            });
                        } else if (String(FType) === '7') {
                            forFieldResponse = await $.ajax({
                                url: 'booking/forField7.php',
                                method: 'POST',
                                data: {
                                    fromtimeSelect: Timefrominput,
                                    totimeSelect: Timetoinput,
                                    bkdateSelect: Bkdate,
                                    fieldType: FieldType

                                }
                            });
                        } else {
                            forFieldResponse = await $.ajax({
                                url: 'booking/forField.php',
                                method: 'POST',
                                data: {
                                    fromtimeSelect: Timefrominput,
                                    totimeSelect: Timetoinput,
                                    bkdateSelect: Bkdate,
                                    fieldType: FieldType

                                }
                            });
                        }

                        const resultsdata = JSON.parse(forFieldResponse);

                        // Xử lý dữ liệu từ request thứ tư
                        for (const resulttm of resultsgt) {
                            let rowContent = '';

                            if (resultsdata && resultsdata.length > 0) {
                                for (const resultdt of resultsdata) {
                                    if (resultdt && resulttm) {
                                        const FilterResult = results.filter(item => item.FieldID === resultdt.FieldID && item.idtm === resulttm.idtm);

                                        if (FilterResult && FilterResult.length > 0) {
                                            // console.log(FilterResult.length);
                                            for (const ftResult of FilterResult) {
                                                let statusColor = '';
                                                let statusText = '';
                                                let buttonText = '';
                                                let enableflag = '';
                                                let buttonColor = '';
                                                let typebutton = '';

                                                switch (String(ftResult.Status)) {
                                                    case '0':
                                                        statusColor = 'green';
                                                        statusText = 'Sân Trống';
                                                        buttonText = 'Đặt Sân';
                                                        buttonColor = 'success';
                                                        enableflag = '';
                                                        typebutton = 'datsan';
                                                        break;
                                                    case '1':
                                                        statusColor = 'blue';
                                                        statusText = 'Đã Có Đội Nhà';
                                                        buttonText = 'Thi Đấu';
                                                        buttonColor = 'info';
                                                        enableflag = '';
                                                        typebutton = 'thidau';
                                                        break;
                                                    case '2':
                                                        statusColor = 'blue';
                                                        statusText = 'Đang đợi chấp nhận';
                                                        buttonText = 'Thi Đấu';
                                                        buttonColor = 'info';
                                                        enableflag = 'disabled';
                                                        typebutton = 'thidau';
                                                        break;
                                                    case '3':
                                                        statusColor = 'blue';
                                                        statusText = 'Hết Sân';
                                                        buttonText = 'Đặt Sân';
                                                        buttonColor = 'info';
                                                        enableflag = 'disabled';
                                                        typebutton = 'datsan';
                                                        break;
                                                    default:
                                                        statusColor = 'red';
                                                        statusText = 'Kết Thúc Trận Đấu';
                                                        buttonText = 'Đặt Sân';
                                                        buttonColor = 'danger';
                                                        enableflag = 'disabled';
                                                        typebutton = 'datsan';
                                                }

                                                // Trường hợp là TeamA
                                                const getMatchesAResponse = await $.ajax({
                                                    url: 'booking/getMatchesA.php',
                                                    method: 'POST',
                                                    data: {
                                                        emailId: LoginID,
                                                        Id_fm: ftResult.idfm,
                                                        Bkdate: Bkdate
                                                    }
                                                });
                                                //  console.log(LoginID,ftResult.idfm,Bkdate)
                                                const GetMatchesA = JSON.parse(getMatchesAResponse);
                                                // console.log(GetMatchesA.length);
                                                if (GetMatchesA && GetMatchesA.length > 0) {
                                                    for (const getmatchesA of GetMatchesA) {
                                                        if (String(getmatchesA.Status) === '1') {
                                                            statusText = 'Đã Đặt Sân';
                                                            statusColor = 'blue';
                                                            buttonText = 'Huỷ Sân';
                                                            enableflag = '';
                                                            typebutton = 'huysan1';
                                                        } else if (String(getmatchesA.Status) === '2') {
                                                            statusText = 'Có Đối Thủ';
                                                            statusColor = 'blue';
                                                            buttonText = 'Chấp nhận trận đấu';
                                                            enableflag = '';
                                                            typebutton = 'cntd';
                                                        } else if (String(getmatchesA.Status) === '3') {
                                                            statusText = 'Chuẩn bị thi đấu';
                                                            statusColor = 'red';
                                                            buttonText = 'Huỷ Sân';
                                                            enableflag = 'disabled';
                                                            typebutton = 'cbtd';
                                                        } else if (String(getmatchesA.Status) === '4') {
                                                            statusText = 'Kết Thúc Trận Đấu';
                                                            statusColor = 'red';
                                                            buttonText = 'Đặt sân';
                                                            enableflag = 'disabled';
                                                            typebutton = 'datsan';
                                                        }
                                                    }
                                                }
                                                // Trường hợp là TeamB
                                                const getMatchesBResponse = await $.ajax({
                                                    url: 'booking/getMatchesB.php',
                                                    method: 'POST',
                                                    data: {
                                                        emailId: LoginID,
                                                        Id_fm: ftResult.idfm,
                                                        Bkdate: Bkdate
                                                    }
                                                });
                                                //  console.log(LoginID,ftResult.idfm,Bkdate)
                                                const GetMatchesB = JSON.parse(getMatchesBResponse);
                                                // console.log(GetMatchesA.length);
                                                if (GetMatchesB && GetMatchesB.length > 0) {
                                                    for (const getmatchesB of GetMatchesB) {
                                                        if (String(getmatchesB.Status) === '1') {
                                                            statusText = 'Đã Có Đội Nhà';
                                                            statusColor = 'blue';
                                                            buttonText = 'Thi Đấu';
                                                            enableflag = '';
                                                            typebutton = 'thidau';
                                                        } else if (String(getmatchesB.Status) === '2') {
                                                            statusText = 'Chờ chấp nhận';
                                                            statusColor = 'blue';
                                                            buttonText = 'Huỷ Trận';
                                                            enableflag = '';
                                                            typebutton = 'huytran';
                                                        } else if (String(getmatchesB.Status) === '3') {
                                                            statusText = 'Chuẩn bị thi đấu';
                                                            statusColor = 'red';
                                                            buttonText = 'Huỷ Sân';
                                                            enableflag = 'disabled';
                                                            typebutton = 'huysan';
                                                        } else if (String(getmatchesB.Status) === '4') {
                                                            statusText = 'Kết Thúc Trận Đấu';
                                                            statusColor = 'red';
                                                            buttonText = 'Đặt Sân';
                                                            enableflag = 'disabled';
                                                            typebutton = 'datsan';
                                                        }
                                                    }
                                                }
                                                const titleStatus = ftResult.FieldGroup;
                                                if ((titleStatus !== null || titleStatus !== '') && ftResult.enable_flag === 'disabled') {
                                                    statusText = 'Sân 7 đã được đặt';
                                                    statusColor = 'red';
                                                }
                                                if ((titleStatus === null || titleStatus === '') && ftResult.enable_flag === 'disabled') {
                                                    statusText = 'Sân 5 đã được đặt';
                                                    statusColor = 'red';
                                                }

                                                rowContent += `
                                                <td class="table-cell">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <a id="linkToUrl">
                                                                <img src="assets/images/footballfield.png" alt="Football Field 1" class="table-img" data-booking-id-info="${ftResult.BookingID}.${ftResult.idtm}.${ftResult.idfm}.${ftResult.FieldID}.${Bkdate}.${typebutton}.${buttonText}.${ftResult.CustomerID}" onclick="goToUrl(this)">
                                                            </a>
                                                            <p style="font-size: 14px"><i class="fa fa-clock-o" aria-hidden="true"></i> Giờ BĐ <span>${ftResult.StartTime}</span></p>
                                                            <p style="font-size: 14px"><i class="fa fa-clock-o" aria-hidden="true"></i> Giờ KT <span>${ftResult.EndTime}</span></p>
                                                        </div>                                                    
                                                        <div class="col-md-8 info">
                                                            <p><i class="fa fa-soccer-ball-o" aria-hidden="true"></i> Tên sân: <span style="font-weight: bold;">${ftResult.FieldName}</span></p>
                                                            <p><i class="fa fa-retweet" aria-hidden="true"></i> Trận Đấu: <span style="font-weight: bold;">${ftResult.NameMatch}</span></p>
                                                        
                                                            <p><i class="fa fa-info-circle" aria-hidden="true"></i> Trạng thái: <span style="color: ${statusColor}">${statusText}</span></p>
                                                            <div class="table-buttons">
                                                                <div class="btn-group">
                                                                    <button ${ftResult.enable_flag} data-booking-id="${ftResult.BookingID}.${ftResult.idtm}.${ftResult.idfm}.${ftResult.FieldID}.${Bkdate}.${typebutton}.${buttonText}.${ftResult.CustomerID}" class="btn bookingButton btn-${buttonColor}" ${enableflag}>${buttonText}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>`;
                                            }
                                        } else {
                                            rowContent += `
                                        <td class="table-cell">
                                            <div class="row">
                                                <div class="col-md-4"></div>
                                                <div class="col-md-8 info"></div>
                                            </div>
                                        </td>`;
                                        }
                                    } else {
                                        console.error("resultdt hoặc resulttm bị undefined.");
                                    }
                                }

                                const row = `<tr>${rowContent}</tr>`;
                                tbody.append(row);
                            }
                        }

                        $('#resultTable').removeClass('hidden');
                    }//p day



                }
            } catch (e) {
                console.error("Error:", e);
            }
        }
    </script>
</body>

</html>