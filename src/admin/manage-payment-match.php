<?php
session_start();
error_reporting(0);
include ('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
	if (isset($_REQUEST['del'])) {
		$delid = intval($_GET['del']);
		$sql = "SELECT PaymentID FROM tblmatchpayments WHERE MatchID = :delid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':delid', $delid);
		$query->execute();
		$results = $query->fetch(PDO::FETCH_ASSOC);
		$IDPayment = $results['PaymentID'];

		$sql_do = "SELECT DrinkOrderID FROM tbldrinkorder WHERE PaymentID = :payment_id";
		$query_do = $dbh->prepare($sql_do);
		$query_do->bindParam(':payment_id', $IDPayment);
		$query_do->execute();
		$results_do = $query_do->fetch(PDO::FETCH_ASSOC);
		$IDDrinkOD = $results_do['DrinkOrderID'];

		$sql_del_odl = "DELETE FROM tbldrinkorderline WHERE DrinkOrderID = :drinkorder_id";
		$query_del_odl = $dbh->prepare($sql_del_odl);
		$query_del_odl->bindParam(':drinkorder_id', $IDDrinkOD);
		if ($query_del_odl->execute()) {
			$sql_del_od = "DELETE FROM tbldrinkorder WHERE PaymentID = :payment_id";
			$query_del_od = $dbh->prepare($sql_del_od);
			$query_del_od->bindParam(':payment_id', $IDPayment);
			if ($query_del_od->execute()) {
				$sql_del_payment = 'DELETE FROM tblmatchpayments WHERE MatchID = :delid';
				$query_del_pm = $dbh->prepare($sql_del_payment);
				$query_del_pm->bindParam(':delid', $delid);
				if ($query_del_pm->execute()) {
					$msg = "Huỷ thanh toán thành công!";
				} else {
					$error = "Huỷ thanh toán thất bại!";
				}
			} else {
				$error = "Huỷ thanh toán thất bại!";
			}
		} else {
			$error = "Không tìm thấy thanh toán!";
		}
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

		<title>TVU Sport Center |Admin Manage Match Payment </title>
		<link rel="shortcut icon" href="../assets/images/favicon-icon/logo.jpg">
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
		<!-- Admin Stye -->
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
		<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<!-- DataTables CSS -->
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
		<!-- FixedColumns CSS -->
		<link rel="stylesheet" type="text/css"
			href="https://cdn.datatables.net/fixedcolumns/3.3.2/css/fixedColumns.dataTables.min.css">
		<!-- Responsive DataTables CSS -->
		<link rel="stylesheet" type="text/css"
			href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css">

		<!-- DataTables JS -->
		<script type="text/javascript" charset="utf8"
			src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
		<!-- FixedColumns JS -->
		<script type="text/javascript" charset="utf8"
			src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.min.js"></script>
		<!-- Responsive DataTables JS -->
		<script type="text/javascript" charset="utf8"
			src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>

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

			.disabled-link {
				pointer-events: none;
				/* Ngăn chặn sự kiện chuột */
				cursor: not-allowed;
				/* Thay đổi con trỏ chuột thành biểu tượng không cho phép */
				color: gray;
				/* Thay đổi màu sắc để thể hiện trạng thái vô hiệu hóa */
			}

			.disabled-link i {
				color: gray;
				/* Thay đổi màu biểu tượng */
			}

			.container.mt-5 {
				width: 100%;
				padding: 0;
				margin: 0;
			}

			.table-responsive {
				width: 100%;
			}

			.table {
				width: 100%;
				table-layout: fixed;
				/* Đảm bảo các cột không vượt quá chiều rộng của bảng */
			}

			.detail-link.active {
				background-color: #007bff;
				/* Màu nền khi active */
				color: white;
				/* Màu chữ khi active */
				border: 1px solid #007bff;
				/* Đường viền khi active */
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

							<h2 class="page-title">Thanh Toán</h2>

							<!-- Zero Configuration Table -->
							<div class="panel panel-default">
								<div class="panel-heading">Chi Tiết</div>
								<div class="panel-body">
									<?php if ($error) { ?>
										<div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div>
									<?php } else if ($msg) { ?>
											<div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div>
											<script>
												setTimeout(function () {
													window.location.href = 'manage-payment-match.php';
												}, 1000); // Chuyển hướng sau 1 giây
											</script>
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
									<div class="container mt-5">
										<div class="table-responsive">
											<table id="zctb" class="table table-bordered zctb_dt" cellspacing="0"
												width="100%">
												<thead>
													<tr class="table-info">
														<th width="2%">#</th>
														<th width="5%">Sân </th>
														<th width="16%">Đội Nhà</th>
														<th width="8%">Điểm A</th>
														<th width="16%">Đội Khách</th>
														<th width="8%">Điểm B</th>
														<th width="5%">Giờ Đấu</th>
														<th width="10%">Ngày Đặt Sân</th>
														<th width="10%">Trọng Tài</th>
														<th width="13%">Trạng Thái</th>
														<th width="2%">Thanh Toán</th>
														<th width="5%">Chi Tiết</th>
													</tr>
												</thead>
												<tbody>

												</tbody>
											</table>
										</div>
									</div>

									<div id="pn_detail" class="panel-heading">Chi Tiết Thanh Toán</div>
									<div id="table_detail" class="container mt-5">
										<div class="table-responsive">
											<table id="zctb" class="display table table-striped table-bordered zctb_dt1"
												cellspacing="0" width="100%">
												<thead>
													<tr class="table-info">
														<th width="2%">#</th>
														<th width="5%">Mã thanh toán </th>
														<th width="5%">Mã trận</th>
														<th width="15%">Phí sân</th>
														<th width="15%">Phí dịch vụ</th>
														<th width="20%">Tổng phí</th>
														<th width="15%">Phụ thu</th>
														<th width="23%">Tổng thanh toán</th>
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
			document.getElementById('pn_detail').style.display = 'none';
			document.getElementById('table_detail').style.display = 'none';
			$(document).ready(function () {
				//Fixed column 
				// Hủy bỏ DataTable nếu nó đã được khởi tạo
				if (!$.fn.DataTable.isDataTable('#zctb')) {
					$('#zctb').DataTable({
						responsive: true,
						scrollX: true,
						fixedColumns: {
							leftColumns: 1 // Số cột bạn muốn cố định ở bên trái (nếu cần)
						}
					});
				}
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
				function formatCurrency(value) {
					return value.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
				}
				async function fetchDataDetail(matchID) {
					try {
						const searchMatchResponse = await $.ajax({
							url: 'match/getmatch-payment-detail.php',
							method: 'POST',
							data: {
								matchID: matchID
							}
						});

						// console.log(Bkdate,FieldType,Field)
						const results = JSON.parse(searchMatchResponse);
						const dataShow = $('.zctb_dt1 tbody');
						// console.log(results);
						dataShow.empty();
						if (results && results.length > 0) {
							results.forEach((result, index) => {
								let FieldRent = formatCurrency(parseFloat(result.FieldRent));
								let ServiceCharges = formatCurrency(parseFloat(result.ServiceCharges));
								let Amount = formatCurrency(parseFloat(result.Amount));
								let ExtraCharge = formatCurrency(parseFloat(result.ExtraCharge));
								let TotalAmount = formatCurrency(parseFloat(result.TotalAmount));
								const add = `	<tr>								 
													<td>${index + 1}</td>															
													<td>${result.PaymentID}</td>
													<td>${result.MatchID}</td>
													<td>${FieldRent}</td>
													<td>${ServiceCharges}</td>
													<td>${Amount}</td>
													<td>${ExtraCharge}</td>
													<td>${TotalAmount}</td>										
												</tr>
											`;
								dataShow.append(add);
							});
							$('#pn_detail').show();
							$('#table_detail').show();
						}
					} catch (e) {
						console.error("Error:", e);
					}
				}
				document.getElementById('searchButton').addEventListener('click', function () {
					const Bkdate = document.querySelector('input[name="datematch"]').value;
					const FieldType = $('#fieldType').val();
					const Field = $('#field').val();
					fetchData(Bkdate, FieldType, Field);
				});
				async function fetchData(Bkdate, FieldType, Field) {
					try {
						const searchMatchResponse = await $.ajax({
							url: 'match/getmatch-update-match.php',
							method: 'POST',
							data: {
								BookingDate: Bkdate,
								fieldTypeID: FieldType,
								fieldid: Field
							}
						});

						// console.log(Bkdate,FieldType,Field)
						const results = JSON.parse(searchMatchResponse);
						const dataShow = $('.zctb_dt tbody');
						//  console.log(resultsEP);
						dataShow.empty();
						if (results && results.length > 0) {
							results.forEach((result, index) => {
								// matchIDs.push(result.MatchID);
								let employeeName = result.EmployeeName === null ? '' : result.EmployeeName;
								let ScoreTeamHome = result.ScoreTeamHome === null ? '' : result.ScoreTeamHome;
								let ScoreTeamAway = result.ScoreTeamAway === null ? '' : result.ScoreTeamAway;
								let Status_Payment = (result.Status_Payment === null || result.Status_Payment === 0) ? 'Chưa thanh toán' : 'Đã thanh toán';
								let Color_Status_Payment = (result.Status_Payment === null || result.Status_Payment === 0) ? 'red' : 'blue';
								let isDisabled = (result.Status_Payment === null || result.Status_Payment === 0) ? '' : 'disabled';
								let disabledClass = (result.Status_Payment === null || result.Status_Payment === 0) ? '' : 'disabled-link';
								let additionalLink = '';
								let additionalLinkDetail = '';
								if (String(result.Status_Payment) === '1') {
									additionalLink = `<a href="manage-payment-match.php?del=${result.MatchID}"
																	onclick="return confirm('Bạn muốn huỷ thanh toán?');"><i
																		class="fa fa-close"></i></a>`;
									additionalLinkDetail = `<button class="detail-link" id="searchDetai-${result.MatchID}" data-match-detail-id="${result.MatchID}"><i class="fa fa-info-circle"></i></button>`;
								}
								const add = `	<tr>								 
																<td>${index + 1}</td>															
																<td>${result.FieldName}</td>
																<td id="idhome-${result.MatchID}" data-customer-id-home="${result.CustomerID_Home}">${result.HomeTeamName}</td>
																<td>${ScoreTeamHome}</td>
																<td id="idaway-${result.MatchID}" data-customer-id-away="${result.CustomerID_Away}">${result.AwayTeamName}</td>
																<td>${ScoreTeamAway}</td>
																<td>${result.NameMatch}</td>
																<td>${result.BookingDate}</td>
																<td class="trongtai" data-employee-id="${result.EmployeeID}">${employeeName}</td>
																<td style="color: ${Color_Status_Payment}">${Status_Payment}</td>
																<td>
																	<a href="edit-payment-match.php?id=${result.MatchID}" ${isDisabled} class="edit-link ${disabledClass}" data-match-id="${result.MatchID}" id="edit-link-${result.MatchID}"><i class="fa fa-edit"></i></a>
																	${additionalLink}
																</td>
																<td>${additionalLinkDetail}</td>

															</tr>
																`;
								dataShow.append(add);
							});
							$('#zctb').on('click', '.detail-link', function () {
								// Loại bỏ lớp active từ tất cả các nút
								$('.detail-link').removeClass('active');

								// Thêm lớp active cho nút hiện tại
								$(this).addClass('active');
								const matchID = $(this).data('match-detail-id');
								// console.log('Button clicked for match ID:', matchID);
								fetchDataDetail(matchID);
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