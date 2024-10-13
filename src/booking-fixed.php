<?php 
session_start();

include('includes/config.php');
error_reporting(0);
if(isset($_POST['submit']))
{
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate']; 
$message=$_POST['message'];
$useremail=$_SESSION['login'];
$status=0;
$vhid=$_GET['post_id'];
$bookingno=mt_rand(100000000, 999999999);
$ret="SELECT * FROM tblbooking where (:fromdate BETWEEN date(FromDate) and date(ToDate) || :todate BETWEEN date(FromDate) and date(ToDate) || date(FromDate) BETWEEN :fromdate and :todate) and VehicleId=:vhid";
$query1 = $dbh -> prepare($ret);
$query1->bindParam(':vhid',$vhid, PDO::PARAM_STR);
$query1->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
$query1->bindParam(':todate',$todate,PDO::PARAM_STR);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);

if($query1->rowCount()==0)
{

$sql="INSERT INTO  tblbooking(BookingNumber,userEmail,VehicleId,FromDate,ToDate,message,Status) VALUES(:bookingno,:useremail,:vhid,:fromdate,:todate,:message,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':bookingno',$bookingno,PDO::PARAM_STR);
$query->bindParam(':useremail',$useremail,PDO::PARAM_STR);
$query->bindParam(':vhid',$vhid,PDO::PARAM_STR);
$query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
$query->bindParam(':todate',$todate,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Booking successfull.');</script>";
echo "<script type='text/javascript'> document.location = 'my-booking.php'; </script>";
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
 echo "<script type='text/javascript'> document.location = 'car-listing.php'; </script>";
} }  else{
 echo "<script>alert('Car already booked for these days');</script>"; 
 echo "<script type='text/javascript'> document.location = 'car-listing.php'; </script>";
}

}

?>


<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>TVU Sport Center | Bookings </title>
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
<link rel="shortcut icon" href="assets/images/favicon-icon/logo.jpg">

<!-- SWITCHER -->
		<link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="assets/images/favicon-icon/logo.jpg">
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
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
</style>
</head>
<body>

<!-- Start Switcher -->
<?php include('includes/colorswitcher.php');?>
<!-- /Switcher -->  

<!--Header-->
<?php include('includes/header.php');?>
<!-- /Header --> 

<!--Listing-Image-Slider-->
  <section id="listing_img_slider_bk" ></section>     
<?php
$currenturl="http://".$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
<!--/Listing-Image-Slider-->
<!--Listing-detail-->
<section class="listing-detail">
  <div class="container">
    <div class="listing_detail_head row">
      <div class="col-md-12">
        <div class="card mb-12">
          <div class="card-body">
            <h2 class="card-title">Đặt Lịch Thi Đấu Cố Định</h2> 
              <!-- Group dòng trên -->
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
                          <input type="text" class="form-control" name="datematch" id="datematch" placeholder="Chọn ngày" required>
                      </div>
                      <div class="form-group">
                          <label for="timefrominput">Chọn khung giờ từ :</label>
                          <input type="text" class="form-control" name="timefrominput" id="timefrominput" placeholder="Chọn giờ và phút" required>
                      </div>
                      <div class="form-group">
                          <label for="timetoinput">Chọn khung giờ đến :</label>
                          <input type="text" class="form-control" name="timetoinput" id="timetoinput" placeholder="Chọn giờ và phút" required>
                      </div>
                      <div class="btn-group">
                          <button id="searchButton" class="btn btn-primary">Tìm Kiếm</button>
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
<?php include('includes/footer.php');?>
<!-- /Footer--> 

<!--Back to top-->
<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
<!--/Back to top--> 

<!--Login-Form -->
<?php include('includes/login.php');?>
<!--/Login-Form --> 

<!--Register-Form -->
<?php include('includes/registration.php');?>

<!--/Register-Form --> 

<!--Forgot-password-Form -->
<?php include('includes/forgotpassword.php');?>

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
  $(document).ready(function() {
        <?php if (isset($_SESSION['login'])) : ?>
            $('.listing-detail').show();
            $('#loginform').modal('hide');
        <?php else : ?>
            $('#loginform').modal('show');
            $('.listing-detail').hide();
            $('#loginForm').append('<input type="hidden" name="redirect_url" value="' + currentUrl + '">');
        <?php endif; ?>
    //Load banner
    $.ajax({
            url: 'booking/bannerSlide.php', 
            method: 'GET',
            success: function(response) {
                try {
                    const results = JSON.parse(response);            
                    const selectFieldImg = $('#listing_img_slider_bk');   

                    selectFieldImg.empty();
                    if (results && results.length > 0){
                            results.forEach(result => {                    
                            const images = ['Vimage1', 'Vimage2', 'Vimage3', 'Vimage4'];
                            images.forEach(imageKey => {
                                if(result[imageKey]) {
                                    var imgElement = $('<div><img src="admin/img/bannerimage/' + result[imageKey] + '" class="img-responsive" alt="image" width="900" height="560"></div>');
                                    selectFieldImg.append(imgElement);
                                }
                            });
                            
                        });
                    }                    
                    // Khởi tạo Owl Carousel sau khi thêm các ảnh
                    $("#listing_img_slider_bk").owlCarousel({
                        itemsCustom : [
                            [0, 1],
                            [450, 1],
                            [700, 2],
                            [1024, 3],
                            [1200, 3],
                        ],
                        loop: true,
                        nav: true,
                        navigation : true,
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
            error: function(xhr, status, error) {
                console.error("AJAX Error:", status, error);
            }
        });
//Load data FieldType
    $.ajax({
        url: 'booking/fieldType.php', 
        method: 'GET',
        success: function(response) {

            try {
              const results = JSON.parse(response);
              const selectField = $('#fieldType');   
              if (results && results.length > 0){
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
  //Load data Field
  $('#fieldType').change(function() {
    var selectedValue = $(this).val();
$.ajax({
    url: 'booking/field.php',
    method: 'POST',
    data: {
        fieldtypeid: selectedValue
    },
    success: function(response) {
        try {
            const results = JSON.parse(response);
            const selectField = $('#field');
            const tbody = $('#resultTable tbody');
            tbody.empty(); 
            
            selectField.empty();    
            if (results && results.length > 0){
                    results.forEach(result => {
                    const option = `<option value="${result.FieldID}">${result.FieldName}</option>`;
                    selectField.append(option);
                });
            }             
        } catch (e) {
            console.error("Error parsing JSON:", e);
        }
    },
    error: function(xhr, status, error) {
        console.error("AJAX Error:", status, error);
    }
});
    //Load Title table
        $.ajax({
        url: 'booking/fieldTitle.php',
        method: 'POST',
        data: {
            fieldtypeid: selectedValue
        },
        success: function(response) {
            try {
                const results = JSON.parse(response);
                let count = results.length;
                const tileField = $('#trField');        
                tileField.empty();        
                let calculate = 100 / count;
                if (results && results.length > 0){
                        results.forEach(result => {                
                        const trTitle = `<th width="${calculate}%">${result.FieldName}</th>`;                
                        tileField.append(trTitle);
                    });
                }                
            } catch (e) {
                console.error("Error parsing JSON:", e);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error);
        }
    });
    // $('#searchButton').trigger('click');
  });
</script>
<script>
    document.getElementById('searchButton').addEventListener('click', function() {
        const Timefrominput = document.querySelector('input[name="timefrominput"]').value;
        const Timetoinput = document.querySelector('input[name="timetoinput"]').value;
        const Bkdate = document.querySelector('input[name="datematch"]').value;
        const FieldType = $('#fieldType').val();
        const Field = $('#field').val();
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
   
    //GetemailID
    $.ajax({
        url: 'booking/getCustomer.php', 
        method: 'POST',
        data: { 
            emailId: LoginID
        },
        success: function(response) {
            GetemailID = JSON.parse(response);
            //  console.log(GetemailID);
        }
    });
    $.ajax({
        url: 'booking/searchBookings.php', 
        method: 'POST',
        data: { 
            fromtimeSelect: Timefrominput,
            totimeSelect: Timetoinput,
            bkdateSelect: Bkdate,
            fieldTypeID: FieldType,
            fieldID: Field
        },
        success: function(response) {
            try {
                // console.log(Field);
                const results = JSON.parse(response);
                //  console.log(results);//ok
                const tbody = $('#resultTable tbody');
                tbody.empty(); 
                if (results && results.length > 0){
                        $.ajax({
                            url: 'booking/getTimematch.php', 
                            method: 'POST',
                            data: { 
                                fromtimeSelect: Timefrominput,
                                totimeSelect: Timetoinput,
                                bkdateSelect: Bkdate,
                                fieldTypeID: FieldType,
                                fieldID: Field
                            },
                            success: function(response) {                                
                                const resultsgt = JSON.parse(response);
                                //   console.log(results);//ok                                
                                if(resultsgt && resultsgt.length > 0){                                    
                                    $.ajax({
                                                url: 'booking/forField.php', 
                                                method: 'POST',
                                                data: { 
                                                    fromtimeSelect: Timefrominput,
                                                    totimeSelect: Timetoinput,
                                                    bkdateSelect: Bkdate,
                                                    fieldType: FieldType
                                                },
                                                success: function(response) {
                                                    try {
                                                         const resultsdata = JSON.parse(response);                
                                                         resultsgt.forEach(resulttm =>{
                                                            let rowContent = '';                                        
                                                            
                                                            if(resultsdata && resultsdata.length > 0){                                                                
                                                                resultsdata.forEach(resultdt => {    
                                                                                                
                                                                    if (resultdt && resulttm) {
                                                                        const FilterResult = results.filter(item => item.FieldID === resultdt.FieldID && item.idtm === resulttm.idtm);
                                                                        //    console.log(FilterResult); 
                                                                        if(FilterResult && FilterResult.length > 0){
                                                                            FilterResult.forEach(ftResult =>{
                                                                                let statusColor = '';
                                                                                let statusText = '';
                                                                                let buttonText = '';
                                                                                let enableflag = '';
                                                                                let buttonColor = '';
                                                                                let typebutton = '';
                                                                                // console.log(FilterResult.length);
                                                                                switch(String(ftResult.Status)) {
                                                                                    case '0':
                                                                                        statusColor = 'green';
                                                                                        statusText = 'Sân Trống';
                                                                                        buttonText = 'Đặt Sân';
                                                                                        buttonColor = 'success';
                                                                                        enableflag = '';   
                                                                                        typebutton = 'ds';                   
                                                                                        break;
                                                                                    case '1':
                                                                                        statusColor = 'blue';
                                                                                        statusText = 'Có Đội Khách';
                                                                                        buttonText = 'Cáp Kèo';
                                                                                        buttonColor = 'info';
                                                                                        enableflag = '';
                                                                                        typebutton = 'ck';
                                                                                        break;
                                                                                    case '2':
                                                                                        statusColor = 'blue';
                                                                                        statusText = 'Đang đợi chấp nhận';
                                                                                        buttonText = 'Cáp Kèo';
                                                                                        buttonColor = 'info';
                                                                                        enableflag = 'disabled';
                                                                                        typebutton = 'ck';
                                                                                        break;
                                                                                    case '3':
                                                                                        statusColor = 'blue';
                                                                                        statusText = 'Chuẩn bị thi đấu';
                                                                                        buttonText = 'Huỷ sân';
                                                                                        buttonColor = 'info';
                                                                                        enableflag = 'disabled';
                                                                                        typebutton = 'ck';
                                                                                        break;
                                                                                    default:
                                                                                        statusColor = 'red';
                                                                                        statusText = 'Hết Sân';
                                                                                        buttonText = 'Hết Sân';
                                                                                        buttonColor = 'danger';
                                                                                        enableflag = 'disabled';
                                                                                        typebutton = 'hs';
                                                                                }
                                                               
                                                                                //Trường hợp là TeamA
                                                                                $.ajax({
                                                                                        url: 'booking/getMatchesA.php', 
                                                                                        method: 'POST',
                                                                                        data: { 
                                                                                            emailId: LoginID,
                                                                                            Id_fm: ftResult.idfm,
                                                                                            Bkdate: Bkdate
                                                                                        },
                                                                                        success: function(response) {
                                                                                            const GetMatchesA = JSON.parse(response);                                                                                            
                                                                                            if(GetMatchesA && GetMatchesA.length > 0){
                                                                                                //   console.log(GetMatchesA);
                                                                                                GetMatchesA.forEach(getmatchesA =>{                                                                 
                                                                                                    // console.log(statusInt); 
                                                                                                    if(String(getmatchesA.Status) === '1'){
                                                                                                        statusText = 'Đã Đặt Sân';
                                                                                                        statusColor = 'blue';
                                                                                                        buttonText = 'Huỷ Sân';
                                                                                                        enableflag = '';  
                                                                                                        typebutton = 'hs';                                                                                                        
                                                                                                    }else if(String(getmatchesA.Status) === '2'){
                                                                                                        statusText = 'Có Đối Thủ';
                                                                                                        statusColor = 'blue';
                                                                                                        buttonText = 'Chấp nhận trận đấu';
                                                                                                        enableflag = '';  
                                                                                                        typebutton = 'cntd';
                                                                                                    }else if(String(getmatchesA.Status) === '3'){
                                                                                                        statusText = 'Chuẩn bị thi đấu';
                                                                                                        statusColor = 'red';
                                                                                                        buttonText = 'Huỷ Sân';
                                                                                                        enableflag = 'disabled';  
                                                                                                        typebutton = 'cntd';
                                                                                                    }
                                                                                                    
                                                                                                });

                                                                                            }
                                                                                            // console.log(GetMatches);
                                                                                        console.log(statusText);
                                                                                        console.log(statusColor);
                                                                                        console.log(buttonText);
                                                                                        }                                                                                        
                                                                                    });
                                                                                    
                                                                                // if(GetMatchesA && GetMatchesA.length > 0){
                                                                                //     GetMatchesA.forEach(getmatchesA =>{
                                                                                //         // console.log(getmatchesA.Status);
                                                                                //         if(ftResult.BookingID === getmatches.BookingID && String(ftResult.Status) === '2'){
                                                                                //                 // console.log(ftResult.BookingID);
                                                                                //                 statusText = 'Chờ Chấp Nhận';
                                                                                //                 buttonColor = 'warning';
                                                                                //                 buttonText = 'Huỷ Thi Đấu';
                                                                                //                 enableflag = '';  
                                                                                //                 typebutton = 'htd';
                                                                                //         }else if(ftResult.BookingID === getmatchesA.BookingID && String(ftResult.Status) === '3'){
                                                                                                
                                                                                //                 statusText = 'Chuẩn Bị Thi Đấu';
                                                                                //                 buttonColor = 'warning';
                                                                                //                 buttonText = 'Huỷ Thi Đấu';
                                                                                //                 enableflag = 'disabled';
                                                                                //                 typebutton = 'htd';
                                                                                //         }
                                                                                //     });
                                                                                // }
                                                                                // if(GetMatches && GetMatches.length > 0){
                                                                                //     GetMatches.forEach(getmatches =>{
                                                                                //         // console.log(getmatches.Status);
                                                                                //         if(ftResult.BookingID === getmatches.BookingID && String(ftResult.Status) === '2'){
                                                                                //                 // console.log(ftResult.BookingID);
                                                                                //                 statusText = 'Chờ Chấp Nhận';
                                                                                //                 buttonColor = 'warning';
                                                                                //                 buttonText = 'Huỷ Thi Đấu';
                                                                                //                 enableflag = '';  
                                                                                //                 typebutton = 'htd';
                                                                                //         }else if(ftResult.BookingID === getmatches.BookingID && String(ftResult.Status) === '3'){
                                                                                                
                                                                                //                 statusText = 'Chuẩn Bị Thi Đấu';
                                                                                //                 buttonColor = 'warning';
                                                                                //                 buttonText = 'Huỷ Thi Đấu';
                                                                                //                 enableflag = 'disabled';
                                                                                //                 typebutton = 'htd';
                                                                                //         }
                                                                                //     });
                                                                                // }

                                                                                // if(GetemailID && GetemailID.length > 0){
                                                                                //     GetemailID.forEach(getemail =>{       
                                                                                //         // console.log(String(ftResult.Status));    
                                                                                                                                                                          
                                                                                //          if(String(ftResult.Status) === '2'){
                                                                                //             statusText = 'Có đối thủ';
                                                                                //             buttonText = 'Chấp Nhận Đấu'; 
                                                                                //             enableflag = '';                                
                                                                                //             typebutton = 'cnd';
                                                                                //             // console.log(ftResult.Status); 
                                                                                //          }else if(String(ftResult.Status) === '3'){
                                                                                //             statusText = 'Chuẩn Bị Thi Đấu';
                                                                                //             buttonText = 'Huỷ Sân';   
                                                                                //             enableflag = 'disabled';                                                     
                                                                                //             typebutton = 'cbtd';                                                                                             
                                                                                //          } else{
                                                                                //             if(ftResult.CustomerID === getemail.CustomerID){
                                                                                //                 // console.log(ftResult.Status); 
                                                                                //                 statusText = 'Đã Đặt Sân';
                                                                                //                 buttonColor = 'warning';
                                                                                //                 buttonText = 'Huỷ Sân'; 
                                                                                //                 enableflag = '';  
                                                                                //                 typebutton = 'hs';                            
                                                                                //             }  
                                                                                //          }                                                                                                                                                                                                                                                                                                                                                  
                                                                                //     });
                                                                                // }
                                                                                
                                                                                rowContent += `
                                                                                    <td class="table-cell">
                                                                                            <div class="row">
                                                                                                <div class="col-md-4">
                                                                                                    <img src="assets/images/footballfield.png" alt="Football Field 1" class="table-img">
                                                                                                </div>
                                                                                                <div class="col-md-8 info">
                                                                                                    <p><i class="fa fa-soccer-ball-o" aria-hidden="true"></i> Tên sân: <span style="font-weight: bold;">${ftResult.FieldName}</span></p>
                                                                                                    <p><i class="fa fa-retweet" aria-hidden="true"></i> Trận Đấu: <span style="font-weight: bold;">${ftResult.NameMatch}</span></p>
                                                                                                    <p><i class="fa fa-calendar" aria-hidden="true"></i> Giờ bắt đầu: <span>${ftResult.StartTime}</span></p>
                                                                                                    <p><i class="fa fa-calendar" aria-hidden="true"></i> Giờ kết thúc: <span>${ftResult.EndTime}</span></p>
                                                                                                    <p><i class="fa fa-info-circle" aria-hidden="true"></i> Trạng thái: <span style="color: ${statusColor}">${statusText}</span></p>
                                                                                                    <div class="table-buttons">
                                                                                                        <div class="btn-group">
                                                                                                            <button  data-booking-id="${ftResult.BookingID}.${ftResult.idtm}.${ftResult.idfm}.${ftResult.FieldID}.${Bkdate}.${typebutton}.${buttonText}" class="btn bookingButton  btn-${buttonColor}" ${enableflag}>${buttonText}</button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td> `;
                                                                            });
                                                                        }else{
                                                                            rowContent += `
                                                                                    <td class="table-cell">
                                                                                            <div class="row">
                                                                                                <div class="col-md-4">
                                                                                                
                                                                                                </div>
                                                                                                <div class="col-md-8 info">
                                                                                                    
                                                                                                </div>
                                                                                            </div>
                                                                                        </td> `;
                                                                        }
                                                                    } else {
                                                                    console.error("resultdt hoặc resulttm bị undefined.");
                                                                    }                                                                    
                                                                                                                                                                                                                        
                                                            });
                                                        //    console.log(rowContent);
                                                            const row = `
                                                                <tr>
                                                                    ${rowContent}
                                                                </tr>
                                                            `;
                                                            tbody.append(row);
                                                            }
                                                        });
                                                        
                                                    } catch (e) {
                                                        console.error("Error parsing JSON:", e);
                                                    }
                                                }
                                            });

                                    
                                }
                            }
                        });
                    $('#resultTable').removeClass('hidden');                     
                }                                
            } catch (e) {
                console.error("Error parsing JSON:", e);
            }
        }
    });   
});
$(document).on('click', '.bookingButton', function() {
    
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
  </script>
</body>
</html>