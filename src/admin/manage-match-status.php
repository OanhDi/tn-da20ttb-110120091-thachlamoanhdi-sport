<?php
session_start();
error_reporting(0);
include ('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {

	if (isset($_REQUEST['up'])) {
		$Matchid = intval($_GET['up']);
		$EmployeeID = intval($_GET['refereeID']);		
		$sql = "UPDATE tblmatches SET EmployeeID = :employeeid
				WHERE MatchID =:matchID";
		$query = $dbh->prepare($sql);
		$query->bindParam(':matchID', $Matchid, PDO::PARAM_STR);
		$query->bindParam(':employeeid', $EmployeeID, PDO::PARAM_STR);
		$query->execute();
		$msg = "Giao nhiệm vụ trọng tài thành công!";		
	}


	?>

	<!doctype html>
	<html lang="en" class="no-js">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="theme-color" content="#3e454c">

		<title>TVU Sport Center |Admin Manage Match Status </title>

		<!-- Font awesome -->
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<!-- Sandstone Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- Bootstrap Datatables -->
		<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
		<!-- Bootstrap social button library -->
		<link rel="stylesheet" href="css/bootstrap-social.css">
		<!-- Bootstrap select -->
		<link rel="stylesheet" href="css/bootstrap-select.css">
		<!-- Bootstrap file input -->
		<link rel="stylesheet" href="css/fileinput.min.css">
		<!-- Awesome Bootstrap checkbox -->
		<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
		<link rel="shortcut icon" href="../assets/images/favicon-icon/logo.jpg">
		<link rel="shortcut icon" href="../assets/images/favicon-icon/logo.jpg">
		<!-- Admin Stye -->
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
		<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<style>
			.errorWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #fff;
				border-left: 4px solid #dd3d36;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}

			.succWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #fff;
				border-left: 4px solid #5cb85c;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}
		</style>

	</head>

	<body>
		<?php include ('includes/header.php'); ?>

		<div class="ts-main-content">
			<?php include ('includes/leftbar.php'); ?>
			<div class="content-wrapper">
				<div class="container-fluid">

					<div class="row">
						<div class="col-md-12">

							<h2 class="page-title">Trạng Thái Trận Đấu</h2>

							<!-- Zero Configuration Table -->
							<div class="panel panel-default">
								<div class="panel-heading">Chi Tiết</div>
								<div class="panel-body">
									<?php if ($error) { ?>
										<div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div>
									<?php } else if ($msg) { ?>
											<div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div>
											<!-- <script>
												setTimeout(function () {
													window.location.href = 'manage-referees.php';
												}, 2000); // Chuyển hướng sau 2 giây
											</script> -->
									<?php } ?>
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
											<div class="btn-group col-md-8" style="padding-bottom: 1rem">
												<div class="col-md-4">
													<button id="searchButton" class="btn btn-primary">Tìm Kiếm</button>
												</div>
											</div>
										</div>
									</div>
									<table id="zctb" class="display table table-striped table-bordered table-hover"
										cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Chọn</th>
												<th>Mã Trận Đấu</th>
												<th>Sân </th>
												<th>Đội Nhà</th>
												<th>Đội Khách</th>
												<th>Giờ Đấu</th>
												<th>Ngày Đặt Sân</th>
												<th>Trọng Tài</th>
												<th>Trạng Thái</th>
											</tr>
										</thead>
										<tbody>

										</tbody>
									</table>



								</div>
							</div>



						</div>
					</div>

				</div>
			</div>
		</div>
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
				//Load data FieldType
				$.ajax({
					url: '../booking/fieldType.php',
					method: 'GET',
					success: function (response) {

						try {
							const results1 = JSON.parse(response);
							const selectField = $('#fieldType');
							if (results1 && results1.length > 0) {
								results1.forEach(result => {
									const option = `<option value="${result.FieldTypeID}">${result.TypeName}</option>`;
									selectField.append(option);
								});
							}
						} catch (e) {
							console.error("Error parsing JSON:", e);
						}
					}
				});
				$.ajax({
					url: 'getEmployees.php',
					method: 'GET',
					success: function (response) {
						try {
							const resultsEP = JSON.parse(response);
							// console.log(resultsEP);
							const selectField = $('#option');
							if (resultsEP && resultsEP.length > 0) {
								resultsEP.forEach(result => {
									const option = `<option value="${result.EmployeeID}">${result.EmployeeName}</option>`;
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
						url: '../booking/field.php',
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
										// $('.selectpicker').selectpicker('refresh');
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
				
				document.getElementById('searchButton').addEventListener('click', function () {
					const Bkdate = document.querySelector('input[name="datematch"]').value;
					const FieldType = $('#fieldType').val();
					const Field = $('#field').val();
					fetchData(Bkdate, FieldType, Field);
				});
				async function fetchData(Bkdate, FieldType, Field) {
					try {
						const searchMatchResponse = await $.ajax({
							url: 'match/getmatch-status.php',
							method: 'POST',
							data: {
								BookingDate: Bkdate,
								fieldTypeID: FieldType,
								fieldid: Field
							}
						});

						// console.log(Bkdate,FieldType,Field)
						const results = JSON.parse(searchMatchResponse);
						const dataShow = $('#zctb tbody');
						//  console.log(resultsEP);
						dataShow.empty();
						if (results && results.length > 0) {
							results.forEach((result, index) => {
								let employeeName = result.EmployeeName === null ? '' : result.EmployeeName;
								let Color = '';
								if(String(result.keyStatus) === '1' || String(result.keyStatus) === '2'){
									Color = 'style="color: blue"';
								}else if(String(result.keyStatus) === '3'){
									Color = 'style="color: green"';
								}else{
									Color = 'style="color: red"';
								}
								const add = `	<tr>								 
															<td>${index + 1}</td>
															<td><input type="checkbox" name="selectMatch" value="${result.MatchID}"></td>
															<td>${result.MatchID}</td>
															<td>${result.FieldName}</td>
															<td>${result.HomeTeamName}</td>
															<td>${result.AwayTeamName}</td>
															<td>${result.NameMatch}</td>
															<td>${result.BookingDate}</td>
															<td class="trongtai" data-employee-id="${result.EmployeeID}">${employeeName}</td>
															<td ${Color}>${result.Status}</td>
														</tr>
															`;
								dataShow.append(add);
							});	
						}
					} catch (e) {
						console.error("Error:", e);
					}
				}
			});

		</script>
		<!-- Loading Scripts -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap-select.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.dataTables.min.js"></script>
		<script src="js/dataTables.bootstrap.min.js"></script>
		<script src="js/Chart.min.js"></script>
		<script src="js/fileinput.js"></script>
		<script src="js/chartData.js"></script>
		<script src="js/main.js"></script>
	</body>

	</html>
<?php } ?>