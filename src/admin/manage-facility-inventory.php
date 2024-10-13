<?php
session_start();
error_reporting(0);
include ('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {

	if (isset($_REQUEST['del'])) {
		$id = intval($_GET['del']);
		$sql = "DELETE FROM tblfacility_inventory 
				WHERE id = :id";
		$query = $dbh->prepare($sql);
		$query->bindParam(':id', $id, PDO::PARAM_STR);
		$query->execute();
		$msg = "Xoá dữ liệu thành công!";
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

		<title>TVU Sport Center |Admin Manage Facility Inventor </title>

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

							<h2 class="page-title">Kho Cơ Sở Vật Chất</h2>

							<!-- Zero Configuration Table -->
							<div class="panel panel-default">
								<div class="panel-heading">Chi Tiết Kho</div>
								<div class="panel-body">
									<?php if ($error) { ?>
										<div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div>
									<?php } else if ($msg) { ?>
											<div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div>
											<script>
												setTimeout(function () {
													window.location.href = 'manage-facility-inventory.php';
												}, 1000); // Chuyển hướng sau 2 giây
											</script>
									<?php } ?>
									<div class="row mb-4">
										<div class="col-md-12">
											<div class="form-group">
												<label for="category">Loại Cơ Sở Vật Chất</label>
												<select class="form-control" name="facilityType" id="facilityType" required>
													<option value="">Chọn Thể Loại</option>
												</select>
											</div>
											<div class="form-group">
												<label for="category">Kho Cơ Sở Vật Chất</label>
												<select class="form-control" name="warehouse" id="warehouse" required>
													<option value="">Chọn Kho</option>
												</select>
											</div>
											<div class="form-group">
												<label for="category">Trạng Thái</label>
												<select class="form-control" name="status" id="status" required>
													<option value="">Chọn Trạng Thái</option>
												</select>
											</div>
											<div class="btn-group col-md-8" style="padding-bottom: 1rem">
												<div class="col-md-4">
													<button id="searchButton" class="btn btn-primary">Tìm Kiếm</button>
												</div>

												<div class="col-md-4">
													<a href="add-facility.php" class="btn btn-primary">Thêm Mới</a>
												</div>
											</div>
										</div>
									</div>
									<table id="zctb" class="display table table-striped table-bordered table-hover"
										cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Tên Cơ Sở Vật Chất</th>
												<th>Tổng Số Lượng</th>
												<th>Tốt</th>
												<th>Bình Thường</th>
												<th>Xuống Cấp</th>
												<th>Trạng Thái</th>
												<th>Vị Trí Kho</th>
												<th>Khu Vực</th>
												<th>Hành Động</th>
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
			$(document).ready(function () {
				//Load data FieldType
				$.ajax({
					url: 'facility/getfacility-type.php',
					method: 'GET',
					success: function (response) {

						try {
							const results1 = JSON.parse(response);
							const selectField = $('#facilityType');
							if (results1 && results1.length > 0) {
								results1.forEach(result => {
									const option = `<option value="${result.id}">${result.type_name}</option>`;
									selectField.append(option);
								});
							}
						} catch (e) {
							console.error("Error parsing JSON:", e);
						}
					}
				});
				$.ajax({
					url: 'facility/getwarehouse.php',
					method: 'GET',
					success: function (response) {
						try {
							const resultsEP = JSON.parse(response);
							// console.log(resultsEP);
							const selectField = $('#warehouse');
							if (resultsEP && resultsEP.length > 0) {
								resultsEP.forEach(result => {
									const option = `<option value="${result.id}">${result.name}</option>`;
									selectField.append(option);
								});
							}
						} catch (e) {
							console.error("Error parsing JSON:", e);
						}
					}
				});
				$.ajax({
					url: 'facility/getstatus.php',
					method: 'GET',
					success: function (response) {
						try {
							const results = JSON.parse(response);
							const selectField = $('#status');
							if (results && results.length > 0) {
								results.forEach(result => {
									const option = `<option value="${result.id}">${result.status_fac}</option>`;
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
				$('#anotherButton').on('click', function () {
					const selectedReferee = $('#option').val();
					const selectedRefereeName = $('#option option:selected').text();
					// console.log(selectedReferee);
					// console.log(selectedRefereeName);
					if (selectedReferee === "") {
						alert("Vui lòng chọn trọng tài.");
						return;
					}

					$('#zctb tbody tr').each(function () {
						const row = $(this);

						const checkbox = row.find('input[name="selectMatch"]');
						// console.log(checkbox.prop('checked'));
						if (checkbox.prop('checked')) {
							row.find('.trongtai').text(selectedRefereeName);
							const trongtaiText = row.find('.trongtai').text();
							let employeeID = row.find('.trongtai').data('employee-id');
							//  alert(trongtaiVal);

							const matchID = checkbox.val();
							const manageRefereeLink = row.find('.manage-referee');
							const newHref = `manage-referees.php?up=${matchID}&refereeID=${selectedReferee}`;
							manageRefereeLink.attr('href', newHref);
						}
					});
				});
				document.getElementById('searchButton').addEventListener('click', function () {

					const facilityType = $('#facilityType').val() || null;
					const warehouse = $('#warehouse').val() || null;
					const status = $('#status').val() || null;
					// console.log(facilityType,warehouse,status);

					fetchData(facilityType, warehouse, status);
				});
				async function fetchData(facilityType, warehouse, status) {
					try {
						const searchFacilityResponse = await $.ajax({
							url: 'facility/getFacility.php',
							method: 'POST',
							data: {
								facilityType: facilityType,
								warehouse: warehouse,
								status: status
							}
						});

						//  console.log(facilityType,warehouse,status);

						const results = JSON.parse(searchFacilityResponse);
						const dataShow = $('#zctb tbody');
						console.log(results);
						dataShow.empty();
						if (results && results.length > 0) {
							results.forEach((result, index) => {
								let type_name = result.type_name === null ? '' : result.type_name;
								let quantity = result.quantity === null ? '' : result.quantity;
								let good_quantity = result.good_quantity === null ? '' : result.good_quantity;
								let normal_quantity = result.normal_quantity === null ? '' : result.normal_quantity;
								let deteriorated_quantity = result.deteriorated_quantity === null ? '' : result.deteriorated_quantity;
								let status_fac = result.status_fac === null ? '' : result.status_fac;
								let name = result.name === null ? '' : result.name;
								let location = result.location === null ? '' : result.location;
								const add = `	<tr>								 
																<td>${index + 1}</td>
																<td>${type_name}</td>
																<td>${quantity}</td>
																<td>${good_quantity}</td>
																<td>${normal_quantity}</td>
																<td>${deteriorated_quantity}</td>
																<td>${status_fac}</td>
																<td>${name}</td>
																<td>${location}</td>																				
																<td><a href="edit-facility.php?id=${result.id}" class="manage-facility"><i
																				class="fa fa-edit"></i></a>&nbsp;&nbsp;
																	<a href="manage-facility-inventory.php?del=${result.id}"
																	onclick="return confirm('Bạn muốn xoá dữ liệu?');"><i
																		class="fa fa-close"></i></a>
																</td>
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