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

		<title>TVU Sport Center |Admin Manage Revenue Statistics </title>
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

							<h2 class="page-title">Thống Kê Doanh Thu</h2>

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
												<label for="category">Loại Thống Kê</label>
												<select class="form-control" name="revenue" id="revenue" required>
													<option value="">--Tất Cả--</option>
													<option value="dtts">Doanh Thu Thuê Sân</option>
													<option value="dtdv">Doanh Thu Dịch Vụ</option>
													<option value="dtbh">Doanh Thu Bán Hàng</option>
												</select>
											</div>
											<div class="form-group">
												<label for="category">Loại Sân</label>
												<select class="form-control" name="fieldType" id="fieldType" required>
													<option value="">--Chọn Sân--</option>
												</select>
											</div>
											<div class="form-group">
												<label for="category">Sân Thi Đấu</label>
												<select class="form-control" name="field" id="field" required>
													<option value="">Chọn Sân</option>
												</select>
											</div>
											<div class="form-group">
												<label>Chọn kiểu thống kê:</label><br>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="dateOption"
														id="forDate" value="forDate">
													<label class="form-check-label" for="fromDate">
														Theo ngày
													</label>
													<input type="date" class="form-control d-inline-block" id="startDate"
														name="startDate" style="width: auto; display: inline-block;">
													~
													<input type="date" class="form-control d-inline-block" id="endDate"
														name="endDate" style="width: auto; display: inline-block;">
												</div>
											</div>
											<div class="form-group">
												<div class="form-check">
													<input class="form-check-input" type="radio" name="dateOption"
														id="forWeek" value="forWeek">
													<label class="form-check-label" for="toDate">
														Theo tuần
													</label>
													<input type="month" class="form-control d-inline-block" id="forMonth"
														name="forMonth" style="width: auto; display: inline-block;">
												</div>
											</div>
											<div class="form-group">
												<div class="form-check">
													<input class="form-check-input" type="radio" name="dateOption"
														id="forMonthFrom" value="forMonthFrom">
													<label class="form-check-label" for="toDate">
														Theo tháng
													</label>
													<input type="month" class="form-control d-inline-block"
														id="forMonthStart" name="forMonthStart"
														style="width: auto; display: inline-block;">
													~
													<input type="month" class="form-control d-inline-block" id="forMonthEnd"
														name="forMonthEnd" style="width: auto; display: inline-block;">
												</div>
											</div>
											<div class="form-group">
												<div class="form-check">
													<input class="form-check-input" type="radio" name="dateOption"
														id="forYear" value="forYear">
													<label class="form-check-label" for="toDate">
														Theo năm
													</label>
													<input type="number" class="form-control d-inline-block"
														id="forYearStart" name="forYearStart" min="1900" max="2100"
														placeholder="Năm bắt đầu"
														style="width: auto; display: inline-block;">
													~
													<input type="number" class="form-control d-inline-block" id="forYearEnd"
														name="forYearEnd" min="1900" max="2100" placeholder="Năm kết thúc"
														style="width: auto; display: inline-block;">
												</div>
											</div>
											<div class="btn-group col-md-8" style="padding-bottom: 1rem">
												<div class="col-md-4">
													<button id="searchButton" class="btn btn-primary">Thống Kê</button>
												</div>
											</div>
										</div>
									</div>
									<div class="container mt-5">
										<div class="table-responsive">
											<table id="zctb" class="table table-bordered zctb_dt" cellspacing="0"
												width="100%">
												<thead>
													<th></th>
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
				// if (!$.fn.DataTable.isDataTable('#zctb')) {
				// 	$('#zctb').DataTable({
				// 		responsive: true,
				// 		scrollX: true,
				// 		fixedColumns: {
				// 			leftColumns: 1 // Số cột bạn muốn cố định ở bên trái (nếu cần)
				// 		}
				// 	});
				// }
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
				document.getElementById('searchButton').addEventListener('click', function () {
					const isForDateChecked = document.getElementById('forDate').checked;
					const isForWeekChecked = document.getElementById('forWeek').checked;
					const isForMonthChecked = document.getElementById('forMonthFrom').checked;
					const isForYearChecked = document.getElementById('forYear').checked;
					let FieldType = $('#fieldType').val();
					let Field = $('#field').val();
					let Revenue = $('#revenue').val();
					if (isForDateChecked) {
						const startDate = document.querySelector('input[name="startDate"]').value;
						const endDate = document.querySelector('input[name="endDate"]').value;

						fetchDataForDate(startDate, endDate, FieldType, Field, Revenue);
					}
					if (isForWeekChecked) {
						const forMonth = document.querySelector('input[name="forMonth"]').value;
						// console.log(forMonth);
						// Tạo một đối tượng Date với ngày đầu tháng
						const startDate = new Date(`${forMonth}-01`);

						// Tạo một đối tượng Date với ngày cuối tháng
						const endDate = new Date(startDate);
						endDate.setMonth(startDate.getMonth() + 1);
						endDate.setDate(0); // Ngày cuối cùng của tháng hiện tại

						// Định dạng ngày theo định dạng yyyy-mm-dd
						const formatDate = (date) => {
							const year = date.getFullYear();
							const month = String(date.getMonth() + 1).padStart(2, '0');
							const day = String(date.getDate()).padStart(2, '0');
							return `${year}-${month}-${day}`;
						};

						const startdate = formatDate(startDate);
						const enddate = formatDate(endDate);

						fetchDataForWeek(startdate, enddate, FieldType, Field, Revenue);
					}
					if (isForMonthChecked) {
						const startDate = document.querySelector('input[name="forMonthStart"]').value;
						const endDate = document.querySelector('input[name="forMonthEnd"]').value;
						
						const [startYear, startMonth] = startDate.split('-');
						const startDateFormatted = `${startYear}-${startMonth}-01`;
						
						const [endYear, endMonth] = endDate.split('-');
						const lastDay = new Date(endYear, endMonth, 0).getDate(); // Ngày cuối cùng của tháng
						const endDateFormatted = `${endYear}-${endMonth}-${lastDay}`;

						 fetchDataForMonth(startDateFormatted, endDateFormatted, FieldType, Field, Revenue);
					}
					if(isForYearChecked){
						const startYear = document.querySelector('input[name="forYearStart"]').value;
						const endYear = document.querySelector('input[name="forYearEnd"]').value;
						fetchDataForYear(startYear, endYear, FieldType, Field, Revenue);
					}

				});
				async function fetchDataForYear(startDate, endDate, FieldType, Field, Revenue) {
					try {
						const searchRevenueWeekResponse = await $.ajax({
							url: 'revenue/getmatch-revenue-year.php',
							method: 'POST',
							data: {
								startDate: startDate,
								endDate: endDate,
								FieldType: FieldType,
								Field: Field,
								Revenue: Revenue
							}
						});

						//   console.log(searchRevenueWeekResponse)
						const results = JSON.parse(searchRevenueWeekResponse);
						const dataShow = $('.zctb_dt tbody');
						const dataheader = $('.zctb_dt thead');
						//  console.log(resultsEP);
						dataShow.empty();
						dataheader.empty();
						if (results && results.length > 0) {
							const addth = `<tr class="table-info">
													<th width="2%">#</th>
													<th width="15%" style="text-align: center;">Năm </th>
													<th width="18%" style="text-align: center;">Tổng Doanh Thu</th>
													<th width="35%" style="text-align: center;">Diễn Giải</th>														
													<th width="15%" style="text-align: center;">Loại Thể Thao</th>														
													<th width="15%" style="text-align: center;">Sân</th>																																					
												</tr>`;
							dataheader.append(addth);
							let totalRevenue = 0;
							results.forEach((result, index) => {
								// matchIDs.push(result.MatchID);
								let Year_Revenue = result.Year_Revenue === null ? '' : result.Year_Revenue;
								let TotalAmount = result.TotalAmount === null ? '' : parseFloat(result.TotalAmount).toLocaleString('vi-VN') + ' đ';
								let Description = result.Description === null ? '' : result.Description;
								let TypeName = result.TypeName === null ? '' : result.TypeName;
								let FieldName = result.FieldName === null ? '' : result.FieldName;
								if (result.TotalAmount !== null) {
									totalRevenue += parseFloat(result.TotalAmount);
								}
								const add = `	<tr>								 
														<td>${index + 1}</td>															
														<td>${Year_Revenue}</td>
														<td>${TotalAmount}</td>
														<td>${Description}</td>																							
														<td>${TypeName}</td>
														<td>${FieldName}</td>																																																																																																																								
													</tr>
														`;
								dataShow.append(add);
							});
							const totalRow = `<tr class="table-danger">
													<td colspan="2" style="text-align: right;"><strong>Tổng:</strong></td>
													<td>${totalRevenue.toLocaleString('vi-VN') + ' đ'}</td>
													<td colspan="4"></td>
												</tr>`;
							dataShow.append(totalRow);
						}
					} catch (e) {
						console.error("Error:", e);
					}
				}
				async function fetchDataForMonth(startDate, endDate, FieldType, Field, Revenue) {
					try {
						const searchRevenueWeekResponse = await $.ajax({
							url: 'revenue/getmatch-revenue-month.php',
							method: 'POST',
							data: {
								startDate: startDate,
								endDate: endDate,
								FieldType: FieldType,
								Field: Field,
								Revenue: Revenue
							}
						});

						//   console.log(searchRevenueWeekResponse)
						const results = JSON.parse(searchRevenueWeekResponse);
						const dataShow = $('.zctb_dt tbody');
						const dataheader = $('.zctb_dt thead');
						//  console.log(resultsEP);
						dataShow.empty();
						dataheader.empty();
						if (results && results.length > 0) {
							const addth = `<tr class="table-info">
													<th width="2%">#</th>
													<th width="15%" style="text-align: center;">Tháng/Năm </th>
													<th width="18%" style="text-align: center;">Tổng Doanh Thu</th>
													<th width="35%" style="text-align: center;">Diễn Giải</th>														
													<th width="15%" style="text-align: center;">Loại Thể Thao</th>														
													<th width="15%" style="text-align: center;">Sân</th>																																					
												</tr>`;
							dataheader.append(addth);
							let totalRevenue = 0;
							results.forEach((result, index) => {
								// matchIDs.push(result.MatchID);
								let MonthYear = result.MonthYear === null ? '' : result.MonthYear;
								let TotalAmount = result.TotalAmount === null ? '' : parseFloat(result.TotalAmount).toLocaleString('vi-VN') + ' đ';
								let Description = result.Description === null ? '' : result.Description;
								let TypeName = result.TypeName === null ? '' : result.TypeName;
								let FieldName = result.FieldName === null ? '' : result.FieldName;
								if (result.TotalAmount !== null) {
									totalRevenue += parseFloat(result.TotalAmount);
								}
								const add = `	<tr>								 
														<td>${index + 1}</td>															
														<td>${MonthYear}</td>
														<td>${TotalAmount}</td>
														<td>${Description}</td>																							
														<td>${TypeName}</td>
														<td>${FieldName}</td>																																																																																																																								
													</tr>
														`;
								dataShow.append(add);
							});
							const totalRow = `<tr class="table-danger">
													<td colspan="2" style="text-align: right;"><strong>Tổng:</strong></td>
													<td>${totalRevenue.toLocaleString('vi-VN') + ' đ'}</td>
													<td colspan="4"></td>
												</tr>`;
							dataShow.append(totalRow);
						}
					} catch (e) {
						console.error("Error:", e);
					}
				}
				async function fetchDataForWeek(startDate, endDate, FieldType, Field, Revenue) {
					try {
						const searchRevenueWeekResponse = await $.ajax({
							url: 'revenue/getmatch-revenue-week.php',
							method: 'POST',
							data: {
								startDate: startDate,
								endDate: endDate,
								FieldType: FieldType,
								Field: Field,
								Revenue: Revenue
							}
						});

						//   console.log(searchRevenueWeekResponse)
						const results = JSON.parse(searchRevenueWeekResponse);
						const dataShow = $('.zctb_dt tbody');
						const dataheader = $('.zctb_dt thead');
						//  console.log(resultsEP);
						dataShow.empty();
						dataheader.empty();
						if (results && results.length > 0) {
							const addth = `<tr class="table-info">
													<th width="2%">#</th>
													<th width="15%" style="text-align: center;">Tuần/Tháng </th>
													<th width="18%" style="text-align: center;">Tổng Doanh Thu</th>
													<th width="35%" style="text-align: center;">Diễn Giải</th>														
													<th width="15%" style="text-align: center;">Loại Thể Thao</th>														
													<th width="15%" style="text-align: center;">Sân</th>																																					
												</tr>`;
							dataheader.append(addth);
							let totalRevenue = 0;
							results.forEach((result, index) => {
								// matchIDs.push(result.MatchID);
								let WeekOfMonth = result.WeekOfMonth === null ? '' : result.WeekOfMonth;
								let TotalAmount = result.TotalAmount === null ? '' : parseFloat(result.TotalAmount).toLocaleString('vi-VN') + ' đ';
								let Description = result.Description === null ? '' : result.Description;
								let TypeName = result.TypeName === null ? '' : result.TypeName;
								let FieldName = result.FieldName === null ? '' : result.FieldName;
								if (result.TotalAmount !== null) {
									totalRevenue += parseFloat(result.TotalAmount);
								}
								const add = `	<tr>								 
														<td>${index + 1}</td>															
														<td>${WeekOfMonth}</td>
														<td>${TotalAmount}</td>
														<td>${Description}</td>																							
														<td>${TypeName}</td>
														<td>${FieldName}</td>																																																																																																																								
													</tr>
														`;
								dataShow.append(add);
							});
							const totalRow = `<tr class="table-danger">
													<td colspan="2" style="text-align: right;"><strong>Tổng:</strong></td>
													<td>${totalRevenue.toLocaleString('vi-VN') + ' đ'}</td>
													<td colspan="4"></td>
												</tr>`;
							dataShow.append(totalRow);
						}
					} catch (e) {
						console.error("Error:", e);
					}
				}
				async function fetchDataForDate(startDate, endDate, FieldType, Field, Revenue) {
					try {
						const searchRevenueResponse = await $.ajax({
							url: 'revenue/getmatch-revenue-datetime.php',
							method: 'POST',
							data: {
								startDate: startDate,
								endDate: endDate,
								FieldType: FieldType,
								Field: Field,
								Revenue: Revenue
							}
						});

						//  console.log(searchRevenueResponse)
						const results = JSON.parse(searchRevenueResponse);
						const dataShow = $('.zctb_dt tbody');
						const dataheader = $('.zctb_dt thead');
						//  console.log(resultsEP);
						dataShow.empty();
						dataheader.empty();
						if (results && results.length > 0) {
							const addth = `<tr class="table-info">
													<th width="2%">#</th>
													<th width="15%" style="text-align: center;">Ngày </th>
													<th width="15%" style="text-align: center;">Tổng Doanh Thu</th>
													<th width="30%" style="text-align: center;">Diễn Giải</th>														
													<th width="15%" style="text-align: center;">Loại Thể Thao</th>														
													<th width="15%" style="text-align: center;">Sân</th>																											
												</tr>`;
							dataheader.append(addth);
							let totalRevenue = 0;
							results.forEach((result, index) => {
								// matchIDs.push(result.MatchID);
								let CreateDate = result.CreateDate === null ? '' : result.CreateDate;
								let TotalAmount = result.TotalAmount === null ? '' : parseFloat(result.TotalAmount).toLocaleString('vi-VN') + ' đ';
								let Description = result.Description === null ? '' : result.Description;
								let id_description = result.id_description === null ? '' : result.id_description;
								let TypeName = result.TypeName === null ? '' : result.TypeName;
								let FieldName = result.FieldName === null ? '' : result.FieldName;
								let additionalLinkDetail = '';
								if (String(result.Status_Payment) === '1') {
									additionalLinkDetail = `<button class="detail-link" id="searchDetai-${result.MatchID}" data-match-detail-id="${result.MatchID}"><i class="fa fa-info-circle"></i></button>`;
								}
								if (result.TotalAmount !== null) {
									totalRevenue += parseFloat(result.TotalAmount);
								}
								const add = `	<tr>								 
																																<td>${index + 1}</td>															
																																<td>${CreateDate}</td>
																																<td>${TotalAmount}</td>
																																<td>${Description}</td>																							
																																<td>${TypeName}</td>
																																<td>${FieldName}</td>																																																																																									
																																<td>${additionalLinkDetail}</td>
																															</tr>
																																`;
								dataShow.append(add);
							});
							const totalRow = `<tr class="table-danger">
																			<td colspan="2" style="text-align: right;"><strong>Tổng:</strong></td>
																			<td>${totalRevenue.toLocaleString('vi-VN') + ' đ'}</td>
																			<td colspan="4"></td>
																		</tr>`;
							dataShow.append(totalRow);
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