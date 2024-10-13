<?php
session_start();
error_reporting(0);
include ('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {

	if (isset($_POST['submit'])) {
		$facilitytype = $_POST['facilitytype'];
		$warehourse = $_POST['warehourse'];
		$status = $_POST['status'];
		$quantity = $_POST['quantity'];
		$deteriorated_quantity = $_POST['deteriorated_quantity'];
		$good_quantity = $_POST['good_quantity'];
		$normal_quantity = $_POST['normal_quantity'];

		$sql = "INSERT INTO tblfacility_inventory(facility_type_id,warehouse_id,quantity,status_id,last_updated,good_quantity,normal_quantity,deteriorated_quantity) 
				VALUES (:facilitytype,:warehourse,:quantity,:status,CURRENT_TIMESTAMP(),:good_quantity,:normal_quantity,:deteriorated_quantity)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':facilitytype', $facilitytype);
		$query->bindParam(':warehourse', $warehourse);
		$query->bindParam(':quantity', $quantity);
		$query->bindParam(':deteriorated_quantity', $deteriorated_quantity);
		$query->bindParam(':good_quantity', $good_quantity);
		$query->bindParam(':normal_quantity', $normal_quantity);
		$query->bindParam(':status', $status);
		if ($query->execute()) {
			$msg = "Dữ liệu cập nhật thành công";
		} else {
			$error = "Thêm dữ liệu thất bại!";
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

		<title>TVU Sport Center | Admin Edit Facility Info</title>

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
		<link rel="shortcut icon" href="../assets/images/favicon-icon/logo.jpg">
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

							<h2 class="page-title">Thêm Mới Kho Cơ Sở Vật Chất</h2>

							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-heading">Thông Tin Kho Cơ Sở Vật Chất</div>
										<div class="panel-body">
											<?php if ($msg) { ?>
												<div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?>
													<script>
														setTimeout(function () {
															window.location.href = 'manage-facility-inventory.php';
														}, 2000); // Chuyển hướng sau 2 giây
													</script>
												</div><?php } ?>
											<form method="post" class="form-horizontal" enctype="multipart/form-data">
												<div class="form-group">
													<label class="col-sm-2 control-label">Kho<span
															style="color:red">*</span></label>
													<div class="col-sm-4">
														<select class="selectpicker" name="warehourse" required>
															<?php
															$ret = "SELECT * FROM tblwarehouses";
															$query = $dbh->prepare($ret);
															$query->execute();
															$resultss = $query->fetchAll(PDO::FETCH_OBJ);
															if ($query->rowCount() > 0) {
																foreach ($resultss as $results) {
																	?>
																	<option value="<?php echo htmlentities($results->id); ?>">
																		<?php echo htmlentities($results->name); ?>
																	</option>
																	<?php
																}
															} ?>
														</select>
													</div>
													<label class="col-sm-2 control-label">Loại Cơ Sở Vật Chất<span
															style="color:red">*</span></label>
													<div class="col-sm-4">
														<select class="selectpicker" name="facilitytype" required>
															<?php
															$ret = "SELECT * FROM tblfacility_types";
															$query = $dbh->prepare($ret);
															$query->execute();
															$resultss = $query->fetchAll(PDO::FETCH_OBJ);
															if ($query->rowCount() > 0) {
																foreach ($resultss as $results) {
																	?>
																	<option value="<?php echo htmlentities($results->id); ?>">
																		<?php echo htmlentities($results->type_name); ?>
																	</option>
																	<?php
																}
															} ?>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Trạng Thái<span
															style="color:red">*</span></label>
													<div class="col-sm-4">
														<select class="selectpicker" name="status" required>
															<?php
															$ret = "SELECT * FROM tblfacility_status";
															$query = $dbh->prepare($ret);
															$query->execute();
															$resultss = $query->fetchAll(PDO::FETCH_OBJ);
															if ($query->rowCount() > 0) {
																foreach ($resultss as $results) {
																	?>
																	<option value="<?php echo htmlentities($results->id); ?>">
																		<?php echo htmlentities($results->status_fac); ?>
																	</option>
																	<?php
																}
															} ?>
														</select>
													</div>
													<label class="col-sm-2 control-label">Số Lượng<span
															style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="number" name="quantity" class="form-control" required
															step="1" min="0" onkeypress="return isNumberKey(event)">
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Tốt<span
															style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="number" name="good_quantity" class="form-control"
															required step="1" min="0" onkeypress="return isNumberKey(event)">
													</div>
													<label class="col-sm-2 control-label">Bình Thường<span
															style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="number" name="normal_quantity" class="form-control"
															required step="1" min="0" onkeypress="return isNumberKey(event)">
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Xuống Cấp<span
															style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="number" name="deteriorated_quantity"
															class="form-control" required step="1" min="0" onkeypress="return isNumberKey(event)">
													</div>
												</div>
												<div class="hr-dashed"></div>
												<div class="form-group">
													<div class="col-sm-8 col-sm-offset-2">
														<button class="btn btn-primary" name="submit" type="submit"
															style="margin-top:4%">Lưu thay đổi</button>
													</div>
												</div>
											</form>
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
			function isNumberKey(evt) {
				var charCode = (evt.which) ? evt.which : evt.keyCode;
				if (charCode > 31 && (charCode < 48 || charCode > 57)) {
					return false;
				}
				return true;
			}
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