<?php
//error_reporting(0);
//cái này là gửi yêu cầu đến API
$jsonData = file_get_contents('https://flagcdn.com/en/codes.json');
//cái này là chuyển json thành mảng php
$countries = json_decode($jsonData, true);
if (isset($_POST['signup'])) {
  $fname = $_POST['fullname'];
  $email = $_POST['emailid'];
  $mobile = $_POST['mobileno'];
  $address = $_POST['address'];
  $membercount = $_POST['membercount'];
  $password = md5($_POST['password']);
  $flagimage = $_POST['selected_flag_url'];
  $flagname = $_POST['selected_flag_name'];
  // echo "<script>alert('" . $flagname . "');</script>";
  $sqlCus = "INSERT INTO tblcustomers(CustomerName,CustomerTypeID,Address,Phone,Email) VALUES(:fnameCus,1,:address,:mobileCus,:emailCus)";
  $queryCus = $dbh->prepare($sqlCus);
  $queryCus->bindParam(':fnameCus', $fname, PDO::PARAM_STR);
  $queryCus->bindParam(':emailCus', $email, PDO::PARAM_STR);
  $queryCus->bindParam(':mobileCus', $mobile, PDO::PARAM_STR);
  $queryCus->bindParam(':address', $address, PDO::PARAM_STR);
  $queryCus->execute();
  $lastInserCustId = $dbh->lastInsertId();
  if ($lastInserCustId) {
    $sqlCheck = "SELECT * FROM tblcustomers WHERE Email = :emailCheck";
    $queryCheck = $dbh->prepare($sqlCheck);
    $queryCheck->bindParam(':emailCheck', $email, PDO::PARAM_STR);
    $queryCheck->execute();
    $check_exists = $queryCheck->fetch(PDO::FETCH_ASSOC);
    // echo "<script>alert('" . $check_exists['CustomerID'] . "');</script>";
    if ($check_exists) {
      $CustomerID = $check_exists['CustomerID'];

      $sql = "INSERT INTO  tblusers(CustomerID,FullName,EmailId,ContactNo,Password) VALUES(:CustomerID,:fname,:email,:mobile,:password)";
      $query = $dbh->prepare($sql);
      $query->bindParam(':fname', $fname, PDO::PARAM_STR);
      $query->bindParam(':email', $email, PDO::PARAM_STR);
      $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
      $query->bindParam(':password', $password, PDO::PARAM_STR);
      $query->bindParam(':CustomerID', $CustomerID, PDO::PARAM_STR);
      $query->execute();
      $lastInsertId = $dbh->lastInsertId();
      if ($lastInsertId) {
        $sqlTeam = "INSERT INTO tblteams(CustomerID,TeamName,Address,Phone,Email,MemberCount,FlagImage,FlagName) VALUES(:CustomerID,:fname,:address,:mobile,:email,:membercount,:flagimage,:flagname)";
        $queryTeam = $dbh->prepare($sqlTeam);
        $queryTeam->bindParam(':fname', $fname, PDO::PARAM_STR);
        $queryTeam->bindParam(':email', $email, PDO::PARAM_STR);
        $queryTeam->bindParam(':address', $address, PDO::PARAM_STR);
        $queryTeam->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $queryTeam->bindParam(':membercount', $membercount, PDO::PARAM_STR);
        $queryTeam->bindParam(':flagimage', $flagimage, PDO::PARAM_STR);
        $queryTeam->bindParam(':flagname', $flagname, PDO::PARAM_STR);
        $queryTeam->bindParam(':CustomerID', $CustomerID, PDO::PARAM_STR);
        $queryTeam->execute();
        $lastInsertIdTeam = $dbh->lastInsertId();
        if ($lastInsertIdTeam) {
          echo "<script>alert('Đăng ký thành công. Bây giờ bạn có thể đăng nhập');</script>";
        } else {
          echo "<script>alert('Đã xảy ra lỗi. Vui lòng thử lại');</script>";
        }
      }
    }
  } else {
    echo "<script>alert('Đã xảy ra lỗi. Vui lòng thử lại');</script>";
  }


}

?>

<head>
  <style>
    .modal-body {
      max-height: 40vh; /* Hoặc chiều cao mong muốn */
      overflow-y: auto;
      overflow-x: auto; /* Cuộn ngang nếu nội dung vượt quá chiều rộng */
    }
    .flag1 {
      width: 50px;
      cursor: pointer;
      margin: 5px;
      position: relative;
      display: inline-block;
      opacity: 0.5;
    }

    .flag1.selected {
      opacity: 1;
    }

    .flag1.selected::after {
      content: '✔';
      position: absolute;
      top: 0;
      right: 0;
      background: rgba(255, 255, 255, 0.7);
      color: green;
      font-size: 24px;
      border-radius: 50%;
      padding: 0 5px;
    }
    
  </style>
</head>
<script>
  function checkAvailability() {
    $("#loaderIcon").show();
    jQuery.ajax({
      url: "check_availability.php",
      data: 'emailid=' + $("#emailid").val(),
      type: "POST",
      success: function (data) {
        $("#user-availability-status").html(data);
        $("#loaderIcon").hide();
      },
      error: function () { }
    });
  }
</script>

<div class="modal fade" id="signupform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Đăng Ký</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="signup_wrap">
            <div class="col-md-12 col-sm-6">
              <form method="post" name="signup">
                <div class="form-group">
                  <input type="text" class="form-control" name="fullname" placeholder="Họ Tên" required="required">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="mobileno" placeholder="Điện Thoại" maxlength="10"
                    required="required">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="address" placeholder="Địa Chỉ">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="membercount" placeholder="Số Thành Viên">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="emailid" id="emailid" onBlur="checkAvailability()"
                    placeholder="Email Address" required="required">
                  <span id="user-availability-status" style="font-size:12px;"></span>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                    required="required">
                </div>
                <div class="form-group">
                  <label for="flag1">Chọn quốc gia:</label>
                  <input type="hidden" name="selected_flag" id="selected_flag">
                  <input type="hidden" name="selected_flag_url" id="selected_flag_url">
                  <input type="hidden" name="selected_flag_name" id="selected_flag_name">
                  <button type="button" class="btn btn-secondary" onclick="showFlagList()">Chọn biểu tượng đội</button>
                  <span id="selected_flag_alt" style="margin-left: 10px;"></span>
                  <div id="flag-list" style="display: none; margin-top: 10px;">
                    <!-- List of flags will be inserted here dynamically -->
                  </div>
                </div>
                <div class="form-group checkbox">
                  <input type="checkbox" id="terms_agree" required="required" checked="">
                  <label for="terms_agree">Tôi chấp thuận với <a href="#">Điều khoản sử dụng</a></label>
                </div>
                <div class="form-group">
                  <input type="submit" value="Đăng Ký" name="signup" id="submit" class="btn btn-block">
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <p>Đã có tài khoản? <a href="#loginform" data-toggle="modal" data-dismiss="modal">Đăng nhập</a></p>
      </div>
    </div>
  </div>
</div>


<script>
  function showFlagList() {
    var flagListDiv = document.getElementById('flag-list');
    if (flagListDiv.style.display === 'none') {
      flagListDiv.style.display = 'block';
      var ListCountry = <?php echo json_encode($countries); ?>;
      var flagListHtml = '';
      Object.entries(ListCountry).forEach(function([alpha2, countryName]){
        var flagUrl = 'https://flagcdn.com/60x45/' + alpha2 + '.png';                
        checkImageExists(flagUrl, function (exists) {
          if (exists) {            
            flagListHtml += '<img src="' + flagUrl + '" alt="' + countryName + '" class="flag1" onclick="selectFlag(this, \'' + flagUrl + '\')">';
            flagListDiv.innerHTML = flagListHtml;
          }
        });
      });
    } else {
      flagListDiv.style.display = 'none';
    }
  }
  function checkImageExists(url, callback) {
    var img = new Image();
    img.onload = function () { callback(true); };
    img.onerror = function () { callback(false); };
    img.src = url;
  }
  function selectFlag(element, flagUrl) {
    var selectedFlag = document.querySelector('.flag1.selected');
    if (selectedFlag) {
      selectedFlag.classList.remove('selected');
    }
    element.classList.add('selected');
    document.getElementById('selected_flag').value = flagUrl;
    // Update alt text display
    var flagAlt = element.alt;
    document.getElementById('selected_flag_alt').textContent = flagAlt;
    document.getElementById('selected_flag_url').value = flagUrl;
    document.getElementById('selected_flag_name').value = flagAlt;
  }
</script>