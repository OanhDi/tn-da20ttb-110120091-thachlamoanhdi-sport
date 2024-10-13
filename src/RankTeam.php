<?php
session_start();

include ('includes/config.php');
error_reporting(0);

?>


<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>TVU Sport Center | Rank Team</title>
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
            font-size: 14px;
            font-weight: bold;
        }

        .team-table {
            font-size: 14px;
        }

        .team-table th,
        .team-table td {
            vertical-align: middle;
        }

        .pagination {
            justify-content: center;
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
            <div class="container mt-5">
                <h2 class="mb-4">Bảng Xếp Hạng Đội Bóng</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover team-table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">ĐỘI</th>
                                <th scope="col">ĐXH</th>
                                <th scope="col">ĐỊA CHỈ</th>
                                <th scope="col">ĐĐ</th>
                                <th scope="col">ĐIỂM</th>
                                <th scope="col">THẮNG</th>
                                <th scope="col">THUA</th>
                                <th scope="col">H</th>
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
        $(document).ready(function () {
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
            //Load List team
            function loadTeams(page, per_page) {
                $.ajax({
                    url: 'team/rankteam.php',
                    method: 'GET',
                    data: {
                        page: page,
                        per_page: per_page
                    },
                    success: function (response) {
                        try {
                            // console.log('Response from server:', response); // Ghi log dữ liệu trả về
                            const result = JSON.parse(response);

                            if (result.error) {
                                console.error("Server error:", result.error);
                                return;
                            }

                            const data = result.data;
                            const total = result.total;
                            // console.log(data, total)
                            const body = $('#bodyTeam');
                            body.empty(); // Xóa các dòng hiện tại
                            if (data && data.length > 0) {
                                data.forEach((result, index) => {
                                    const Rank = result.Rank === null ? '' : result.Rank;
                                    const stars = getStarsForRank(Rank);
                                    console.log('Rank:', Rank); // Debug: Kiểm tra giá trị của Rank                        
                                    console.log('Stars:', stars);
                                    // console.log(Rank);
                                    const column = `<tr>
                                        <td>${index + 1}</td>
                                        <td style="font-weight: bold;">${result.TeamName}</td>
                                        <td style="text-align: center;">${stars}</td>
                                        <td>${result.Address}</td>                    
                                        <td style="text-align: center;">${result.MatchesPlayed}</td>
                                        <td style="text-align: center;">${result.Points}</td>
                                        <td style="text-align: center;">${result.Wins}</td>
                                        <td style="text-align: center;">${result.Losses}</td>
                                        <td style="text-align: center;">${result.Draws}</td>
                                    </tr>`;
                                    body.append(column);
                                });
                            }
                            // Tạo nút phân trang
                            createPagination(total, per_page, page);
                        } catch (e) {
                            console.error("Error parsing JSON:", e);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX error:", status, error);
                    }
                });
            }
            function getStarsForRank(rank) {
                let stars = '';
                switch (String(rank)) {
                    case '5':
                        stars = '<i style="color:blue" class="fa fa-star-o"></i><i style="color:blue" class="fa fa-star-o"></i><i style="color:blue" class="fa fa-star-o"></i><i style="color:blue" class="fa fa-star-o"></i><i style="color:blue" class="fa fa-star-o"></i>';
                        break;
                    case '4':
                        stars = '<i style="color:blue" class="fa fa-star-o"></i><i style="color:blue" class="fa fa-star-o"></i><i style="color:blue" class="fa fa-star-o"></i><i style="color:blue" class="fa fa-star-o"></i>';
                        break;
                    case '3':
                        stars = '<i style="color:blue" class="fa fa-star-o"></i><i style="color:blue" class="fa fa-star-o"></i><i style="color:blue" class="fa fa-star-o"></i>';
                        break;
                    case '2':
                        stars = '<i style="color:blue" class="fa fa-star-o"></i><i style="color:blue" class="fa fa-star-o"></i>';
                        break;
                    case '1':
                        stars = '<i style="color:blue" class="fa fa-star-o"></i>';
                        break;
                    default:
                        stars = '';
                }
                return stars;
            }
            function createPagination(total, per_page, current_page) {
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
                        loadTeams(page, per_page);
                    }
                });
            }

            const per_page = 5;
            loadTeams(1, per_page); // Tải trang đầu tiên khi khởi động
        });       
    </script>
    <!-- <script>
    document.getElementById('searchButton').addEventListener('click', function() {
        
});
  </script> -->
</body>

</html>