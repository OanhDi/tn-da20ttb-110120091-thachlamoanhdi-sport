<?php
session_start();

include ('includes/config.php');
error_reporting(0);

$key = "12345678901234567890123456789012"; // 32 ký tự
$iv = "1234567890123456"; // 16 ký tự

function decrypt($ciphertext, $key, $iv)
{
    $ciphertext = base64_decode($ciphertext);
    return openssl_decrypt($ciphertext, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
}

if (isset($_GET['key'])) {
    $encryptedBookingID = $_GET['key'];
    $decryptedBookingID = decrypt($encryptedBookingID, $key, $iv);

    if ($decryptedBookingID === false) {
        echo "Giải mã không thành công!";
    } else {
        $parts = explode('.', $decryptedBookingID);
        if (count($parts) == 8) {
            $BookingID = $parts[0];
            $idtm = $parts[1];
            $idfm = $parts[2];
            $FieldID = $parts[3];
            $Date = $parts[4];
            $typebutton = $parts[5];
            $typebuttonname = $parts[6];
            $CustomerID = $parts[7];
            $newDate = date('Y/m/d', strtotime(str_replace('/', '-', $Date)));
            // echo "Customer ID: " . $CustomerID . "<br>";
            // echo "decryptedBookingID: " . $decryptedBookingID . "<br>";
            // echo "Booking ID: " . $BookingID . "<br>";
            // echo "idtm: " . $idtm . "<br>";
            // echo "idfm: " . $idfm . "<br>";
            // echo "Field ID: " . $FieldID . "<br>";
            // echo "Date: " . $newDate . "<br>";
            // echo "TypeButton: " . $typebutton . "<br>";
            // echo "TypeButtonName: " . $typebuttonname . "<br>";
        } else {
            echo "Định dạng chuỗi giải mã không hợp lệ!";
        }
    }
}



?>


<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>TVU Sport Center| Bookings Info</title>
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
            <div class="listing_detail_head row">
                <div class="col-md-12">
                    <div class="card mb-12">
                        <div class="card-body">
                            <h2 class="card-title">Thông Tin Trận Đấu</h2>
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="resultTable" class="table table-bordered mt-3">
                                        <thead>
                                            <tr id="trField">
                                                <th colspan="2" width="50%">ĐỘI NHÀ</th>
                                                <th colspan="2" width="50%">ĐỘI KHÁCH</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td width="15%" style="font-weight: bold;">Tên đội</td>
                                                <td width="35%" id="tendoia"></td>
                                                <td width="15%" style="font-weight: bold;">Tên đội</td>
                                                <td width="35%" id="tendoib"></td>
                                            </tr>
                                            <tr>
                                                <td width="15%" style="font-weight: bold;">Địa Chỉ</td>
                                                <td width="35%" id="diachia"></td>
                                                <td width="15%" style="font-weight: bold;">Địa Chỉ</td>
                                                <td width="35%" id="diachib"></td>
                                            </tr>
                                            <tr>
                                                <td width="15%" style="font-weight: bold;">Điện Thoại</td>
                                                <td width="35%" id="sdta"></td>
                                                <td width="15%" style="font-weight: bold;">Điện Thoại</td>
                                                <td width="35%" id="sdtb"></td>
                                            </tr>
                                            <tr>
                                                <td width="15%" style="font-weight: bold;">Thành Viên</td>
                                                <td width="35%" id="thanhviena"></td>
                                                <td width="15%" style="font-weight: bold;">Thành Viên</td>
                                                <td width="35%" id="thanhvienb"></td>
                                            </tr>
                                            <tr>
                                                <td width="15%" style="font-weight: bold;">Điểm Xếp Hạng</td>
                                                <td width="35%" id="bxha"></td>
                                                <td width="15%" style="font-weight: bold;">Điểm Xếp Hạng</td>
                                                <td width="35%" id="bxhb"></td>
                                            </tr>
                                            <tr>
                                                <td width="15%" style="font-weight: bold;">Số Trận Thi Đấu</td>
                                                <td width="35%" id="sttda"></td>
                                                <td width="15%" style="font-weight: bold;">Số Trận Thi Đấu</td>
                                                <td width="35%" id="sttdb"></td>
                                            </tr>
                                            <tr>
                                                <td width="15%" style="font-weight: bold;">Số Trận Thắng</td>
                                                <td width="35%" id="stthanga"></td>
                                                <td width="15%" style="font-weight: bold;">Số Trận Thắng</td>
                                                <td width="35%" id="stthangb"></td>
                                            </tr>
                                            <tr>
                                                <td width="15%" style="font-weight: bold;">Số Trận Thua</td>
                                                <td width="35%" id="stthuaa"></td>
                                                <td width="15%" style="font-weight: bold;">Số Trận Thua</td>
                                                <td width="35%" id="stthuab"></td>
                                            </tr>
                                            <tr>
                                                <td width="15%" style="font-weight: bold;">Số Trận Hoà</td>
                                                <td width="35%" id="sthoaa"></td>
                                                <td width="15%" style="font-weight: bold;">Số Trận Hoà</td>
                                                <td width="35%" id="sthoab"></td>
                                            </tr>
                                            <thead>
                                                <tr id="trField">
                                                    <th colspan="4" width="1000%">THÔNG TIN SÂN ĐẤU</th>
                                                </tr>
                                            </thead>
                                        <tbody>
                                            <tr>
                                                <td width="15%" style="font-weight: bold;">Loại Sân</td>
                                                <td width="35%" id="loaisan"></td>
                                                <td width="15%" style="font-weight: bold;">Tên Sân</td>
                                                <td width="35%" id="tensan"></td>
                                            </tr>
                                            <tr>
                                                <td width="15%" style="font-weight: bold;">Kích Thước</td>
                                                <td width="35%" id="kichthuoc"></td>
                                                <td width="15%" style="font-weight: bold;">Cầu Thủ Tối Đa</td>
                                                <td width="35%" id="cttd"></td>
                                            </tr>
                                            <tr>
                                                <td width="15%" style="font-weight: bold;">Giá Sân</td>
                                                <td width="35%" id="giasan"></td>
                                                <td width="15%" style="font-weight: bold;">Trạng Thái</td>
                                                <td width="35%" style="font-weight: bold;color: blue" id="trangthai">
                                                </td>
                                            </tr>
                                        </tbody>
                                        <thead>
                                            <tr id="trField">
                                                <th colspan="4" width="1000%">THỜI GIAN THI ĐẤU</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td width="15%" style="font-weight: bold;">Ngày Thi Đấu</td>
                                                <td width="35%" id="ntd"></td>
                                                <td width="15%" style="font-weight: bold;">Giờ Đấu</td>
                                                <td width="35%" id="tengio"></td>
                                            </tr>
                                            <tr>
                                                <td width="15%" style="font-weight: bold;">Thời Gian Bắt Đầu</td>
                                                <td width="35%" id="thoigianbd"></td>
                                                <td width="15%" style="font-weight: bold;">Thời Gian Kết Thúc</td>
                                                <td width="35%" id="thoigiankt"></td>
                                            </tr>
                                        </tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2" style="text-align: center;">

                                                </td>
                                                <td colspan="2" style="text-align: center;">

                                                </td>
                                            </tr>
                                        </tfoot>
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
    <script>
        $(document).ready(function () {
            var LoginID = '<?php echo $_SESSION['login']; ?>';
            var id_tm = '<?php echo $idtm ?>';
            var id_fm = '<?php echo $idfm ?>';
            var FieldID = '<?php echo $FieldID ?>';
            var BookingID = '<?php echo $BookingID ?>';
            var CustomerID = '<?php echo $CustomerID ?>';
            var Date = '<?php echo $newDate ?>';
            var DateMatches = '<?php echo $Date ?>';
            var TypeButton = '<?php echo $typebutton ?>';
            var TypeButtonName = '<?php echo $typebuttonname ?>';
            var InnerText = '';
            // console.log(id_fm, Date, LoginID);

            //Check Status Field
            $.ajax({
                url: 'booking/checkStatusField.php',
                method: 'POST',
                data: {
                    id_FieldMatches: id_fm,
                    date_booking: Date
                },
                success: function (response) {
                    try {
                        const results22 = JSON.parse(response);
                        const trangthai = $('#trangthai');
                        let statusField = '';
                        if (results22 && Array.isArray(results22) && results22.length > 0) {
                            results22.forEach(rstatus => {
                                if (String(rstatus.Status) === '1') {
                                    statusField = 'Đã Đặt Sân';
                                } else if (String(rstatus.Status) === '2') {
                                    statusField = 'Chờ Xác Nhận';
                                } else if (String(rstatus.Status) === '3') {
                                    statusField = 'Chuẩn Bị Thi Đấu';
                                } else if (String(rstatus.Status) === '4') {
                                    statusField = 'Kết Thúc Trận Đấu';
                                } else {
                                    statusField = 'Sân Trống';
                                }
                                const dttrangthai = `<h7>${statusField}</h7>`;
                                trangthai.append(dttrangthai);
                            });
                        } else {
                            statusField = 'Sân Trống';
                            const dttrangthai = `<h7>${statusField}</h7>`;
                            trangthai.append(dttrangthai);
                        }
                    } catch (e) {
                        console.error("Error parsing JSON:", e);
                    }
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

            //Get TeamA
            $.ajax({
                url: 'booking/getTeamExists.php',
                method: 'POST',
                data: {
                    iDfm: id_fm,
                    date_booking: Date
                },
                success: function (response) {
                    try {
                        const results8 = JSON.parse(response);
                        const tendoia = $('#tendoia');
                        const diachia = $('#diachia');
                        const sdta = $('#sdta');
                        const thanhviena = $('#thanhviena');
                        const bxha = $('#bxha');
                        //    console.log(results8.length);  
                        if (results8 && results8.length > 0) {
                            results8.forEach(result => {
                                const dttendoia = `<h7>${result.TeamName}</h7>`;
                                const dtdiachia = `<h7>${result.Address}</h7>`;
                                const dtsdta = `<h7>${result.Phone}</h7>`;
                                const dtthanhviena = `<h7>${result.MemberCount}</h7>`;
                                const dtbxha = `<h7>${result.Rank}</h7>`;
                                tendoia.append(dttendoia);
                                diachia.append(dtdiachia);
                                sdta.append(dtsdta);
                                thanhviena.append(dtthanhviena);
                                bxha.append(dtbxha);
                            });
                        }
                    } catch (e) {
                        console.error("Error parsing JSON:", e);
                    }
                }
            });
            //Result TeamA
            $.ajax({
                url: 'booking/getResultMatchesA.php',
                method: 'POST',
                data: {
                    iDfm: id_fm,
                    date_booking: Date
                },
                success: function (response) {
                    try {
                        const rsResult = JSON.parse(response);
                        const sttda = $('#sttda');
                        const stthanga = $('#stthanga');
                        const stthuaa = $('#stthuaa');
                        const sthoaa = $('#sthoaa');
                        let Count = 0;
                        let countTranThang = 0;
                        let countTranThua = 0;
                        let countTranHoa = 0;

                        if (rsResult && rsResult.length > 0) {
                            Count = rsResult.length;

                            const ajaxPromises = rsResult.map(rs => {
                                return new Promise((resolve, reject) => {
                                    $.ajax({
                                        url: 'booking/getTeamExists.php',
                                        method: 'POST',
                                        data: {
                                            iDfm: id_fm,
                                            date_booking: Date
                                        },
                                        success: function (response) {
                                            const results10 = JSON.parse(response);
                                            if (results10 && results10.length > 0) {
                                                results10.forEach(result => {
                                                    if (String(rs.Result) === String(result.CustomerID)) {
                                                        countTranThang++;
                                                    }
                                                    if (String(rs.Result) === '0') {
                                                        countTranHoa++;
                                                    }
                                                });
                                            }
                                            resolve();
                                        },
                                        error: function (error) {
                                            reject(error);
                                        }
                                    });
                                });
                            });

                            Promise.all(ajaxPromises).then(() => {
                                countTranThua = Count - countTranThang;
                                // console.log("Count of matches:", Count);
                                // console.log("Count of winning matches:", countTranThang);
                                //  console.log("Count of losing matches:", countTranThua);
                                //  console.log("Count of draw matches:", countTranHoa);

                                const dtsttda = `<h7>${Count}</h7>`;
                                const dtstthanga = `<h7>${countTranThang}</h7>`;
                                const dtstthuaa = `<h7>${countTranThua}</h7>`;
                                const dtsthoaa = `<h7>${countTranHoa}</h7>`;
                                // console.log(dtsthoaa);
                                sttda.append(dtsttda);
                                stthanga.append(dtstthanga);
                                stthuaa.append(dtstthuaa);
                                sthoaa.append(dtsthoaa);
                            }).catch(error => {
                                console.error("Error in AJAX requests:", error);
                            });
                        }
                    } catch (e) {
                        console.error("Error parsing JSON:", e);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX request failed:", status, error);
                }
            });
            //Get TeamB
            $.ajax({
                url: 'booking/getTeamExistsB.php',
                method: 'POST',
                data: {
                    iDfm: id_fm,
                    date_booking: Date
                },
                success: function (response) {
                    try {
                        const results8b = JSON.parse(response);
                        const tendoib = $('#tendoib');
                        const diachib = $('#diachib');
                        const sdtb = $('#sdtb');
                        const thanhvienb = $('#thanhvienb');
                        const bxhb = $('#bxhb');
                        //    console.log(results8b.length);  
                        if (results8b && results8b.length > 0) {
                            results8b.forEach(result => {
                                const dttendoib = `<h7>${result.TeamName}</h7>`;
                                const dtdiachib = `<h7>${result.Address}</h7>`;
                                const dtsdtb = `<h7>${result.Phone}</h7>`;
                                const dtthanhvienb = `<h7>${result.MemberCount}</h7>`;
                                const dtbxhb = `<h7>${result.Rank}</h7>`;
                                tendoib.append(dttendoib);
                                diachib.append(dtdiachib);
                                sdtb.append(dtsdtb);
                                thanhvienb.append(dtthanhvienb);
                                bxhb.append(dtbxhb);
                            });
                        }
                    } catch (e) {
                        console.error("Error parsing JSON:", e);
                    }
                }
            });
            //--Get Result TeamB
            $.ajax({
                url: 'booking/getResultMatchesB.php',
                method: 'POST',
                data: {
                    iDfm: id_fm,
                    date_booking: Date
                },
                success: function (response) {
                    try {
                        const rsResult = JSON.parse(response);
                        const sttdb = $('#sttdb');
                        const stthangb = $('#stthangb');
                        const stthuab = $('#stthuab');
                        const sthoab = $('#sthoab');
                        let Count2 = 0;
                        let countTranThang2 = 0;
                        let countTranThua2 = 0;
                        let countTranHoa2 = 0;

                        // console.log(id_fm, Date);  
                        if (rsResult && rsResult.length > 0) {
                            Count2 = rsResult.length;

                            const ajaxPromises2 = rsResult.map(rs => {
                                return new Promise((resolve, reject) => {
                                    $.ajax({
                                        url: 'booking/getCustomer.php',
                                        method: 'POST',
                                        data: {
                                            emailId: LoginID
                                        },
                                        success: function (response) {
                                            const results12 = JSON.parse(response);
                                            // console.log(CustomerID);
                                            if (results12 && results12.length > 0) {
                                                results12.forEach(result => {

                                                    if (String(rs.Result) === String(result.CustomerID)) {
                                                        countTranThang2++;
                                                    }
                                                    if (String(rs.Result) === '0') {
                                                        countTranHoa2++;
                                                    }
                                                });
                                            }
                                            resolve();
                                        },
                                        error: function (error) {
                                            reject(error);
                                        }
                                    });
                                });
                            });
                            Promise.all(ajaxPromises2).then(() => {
                                countTranThua2 = Count2 - countTranThang2;
                                // console.log("Count of matches:", Count1);
                                // console.log("Count of winning matches:", countTranThang1);
                                //  console.log("Count of losing matches:", countTranThua1);
                                //  console.log("Count of draw matches:", countTranHoa1);

                                const dtsttdb = `<h7>${Count2}</h7>`;
                                const dtstthangb = `<h7>${countTranThang2}</h7>`;
                                const dtstthuab = `<h7>${countTranThua2}</h7>`;
                                const dtsthoab = `<h7>${countTranHoa2}</h7>`;
                                sttdb.append(dtsttdb);
                                stthangb.append(dtstthangb);
                                stthuab.append(dtstthuab);
                                sthoab.append(dtsthoab);
                            }).catch(error => {
                                console.error("Error in AJAX requests:", error);
                            });
                        }
                    } catch (e) {
                        console.error("Error parsing JSON:", e);
                    }
                }
            });
            //--Get Result TeamB
            $.ajax({
                url: 'booking/getInforField.php',
                method: 'POST',
                data: {
                    id_tm: id_tm,
                    id_fm: id_fm,
                    field_id: FieldID
                },
                success: function (response) {
                    try {
                        const results6 = JSON.parse(response);
                        const loaisan = $('#loaisan');
                        const tensan = $('#tensan');
                        const kichthuoc = $('#kichthuoc');
                        const cttd = $('#cttd');
                        const giasan = $('#giasan');

                        //    console.log(results);  
                        if (results6 && results6.length > 0) {
                            results6.forEach(result => {
                                const dtloaisan = `<h7>${result.TypeName}</h7>`;
                                const dttensan = `<h7>${result.FieldName}</h7>`;
                                const dtkichthuoc = `<h7>${result.Size}</h7>`;
                                const dtcttd = `<h7>${result.MaxPlayers}</h7>`;
                                const formattedPrice = new Intl.NumberFormat('de-DE').format(result.Price) + 'vnđ/h';
                                const dtgiasan = `<h7>${formattedPrice}</h7>`;
                                loaisan.append(dtloaisan);
                                tensan.append(dttensan);
                                kichthuoc.append(dtkichthuoc);
                                cttd.append(dtcttd);
                                giasan.append(dtgiasan);
                            });
                        }

                    } catch (e) {
                        console.error("Error parsing JSON:", e);
                    }
                }
            });
            $.ajax({
                url: 'booking/getTimeMatchForDetail.php',
                method: 'POST',
                data: {
                    id_tm: id_tm
                },
                success: function (response) {
                    try {
                        const results7 = JSON.parse(response);
                        const ntd = $('#ntd');
                        const tengio = $('#tengio');
                        const thoigianbd = $('#thoigianbd');
                        const thoigiankt = $('#thoigiankt');

                        //    console.log(results);  
                        if (results7 && results7.length > 0) {
                            results7.forEach(result => {
                                const dtntd = `<h7>${DateMatches}</h7>`;
                                const dttengio = `<h7>${result.NameMatch}</h7>`;
                                const dtthoigianbd = `<h7>${result.StartTime}</h7>`;
                                const dtthoigiankt = `<h7>${result.EndTime}</h7>`;

                                ntd.append(dtntd);
                                tengio.append(dttengio);
                                thoigianbd.append(dtthoigianbd);
                                thoigiankt.append(dtthoigiankt);
                            });
                        }

                    } catch (e) {
                        console.error("Error parsing JSON:", e);
                    }
                }
            });
        });
        function calculateTeamRating(totalMatches, wins, draws, losses) {
            // Tính toán điểm
            const pointsFromWins = wins * 3;
            const pointsFromDraws = draws * 1;
            const pointsFromLosses = losses * 0;

            const totalPoints = pointsFromWins + pointsFromDraws + pointsFromLosses;
            const averagePoints = totalPoints / totalMatches;

            // Chuyển đổi sang thang điểm 5
            const maxCurrentPoints = 3;
            const maxNewPoints = 5;
            const newRating = (averagePoints / maxCurrentPoints) * maxNewPoints;

            return newRating.toFixed(2);
        }
    </script>
    <!-- <script>
    document.getElementById('searchButton').addEventListener('click', function() {
        
});
  </script> -->
</body>

</html>