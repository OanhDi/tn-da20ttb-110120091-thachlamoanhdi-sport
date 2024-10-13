<?php
session_start();
error_reporting(0);
include ('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {

	if (isset($_POST['submit'])) {
		$employeename = $_POST['employeename'];
		$phone = $_POST['phone'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$position = $_POST['position'];
		$id = intval($_GET['id']);

		$sql = "UPDATE tblemployees SET EmployeeName = :employeename,PositionTypeID = :position,
				Address = :address,Phone = :phone,Email = :email
				WHERE EmployeeID = :id ";
		$query = $dbh->prepare($sql);
		$query->bindParam(':employeename', $employeename, PDO::PARAM_STR);
		$query->bindParam(':phone', $phone, PDO::PARAM_STR);
		$query->bindParam(':address', $address, PDO::PARAM_STR);
		$query->bindParam(':email', $email, PDO::PARAM_STR);
		$query->bindParam(':position', $position, PDO::PARAM_STR);		
		$query->bindParam(':id', $id, PDO::PARAM_STR);
		$query->execute();

		$msg = "Dữ liệu cập nhật thành công";
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

		<title>TVU Sport Center| Admin Edit Employee Info</title>

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

							<h2 class="page-title">Chỉnh Sửa Nhân Viên</h2>

							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-heading">Thông Tin Nhân Viên</div>
										<div class="panel-body">
											<?php if ($msg) { ?>
												<div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?>
													<script>
														setTimeout(function () {
															window.location.href = 'manage-employees.php';
														}, 2000); // Chuyển hướng sau 2 giây
													</script>
												</div><?php } ?>
											<?php
											$id = intval($_GET['id']);
											$sql = "SELECT ep.*,p.PositionName FROM `tblemployees` ep INNER JOIN tblpositiontypes p ON ep.PositionTypeID = p.PositionTypeID
													WHERE ep.EmployeeID = :id";
											$query = $dbh->prepare($sql);
											$query->bindParam(':id', $id, PDO::PARAM_STR);
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;
											if ($query->rowCount() > 0) {
												foreach ($results as $result) { ?>

													<form method="post" class="form-horizontal" enctype="multipart/form-data">
														<div class="form-group">
															<label class="col-sm-2 control-label">Tên Nhân Viên<span
																	style="color:red">*</span></label>
															<div class="col-sm-4">
																<input type="text" name="employeename" class="form-control"
																	value="<?php echo htmlentities($result->EmployeeName) ?>"
																	required>
															</div>
															<label class="col-sm-2 control-label">Địa Chỉ<span
																	style="color:red">*</span></label>
															<div class="col-sm-4">
																<input type="text" name="address" class="form-control"
																	value="<?php echo htmlentities($result->Address) ?>" required>
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-2 control-label">Điện Thoại<span
																	style="color:red">*</span></label>
															<div class="col-sm-4">
																<input type="text" name="phone" class="form-control"
																	value="<?php echo htmlentities($result->Phone) ?>" required>
															</div>
															<label class="col-sm-2 control-label">Email<span
																	style="color:red">*</span></label>
															<div class="col-sm-4">
																<input type="text" name="email" class="form-control"
																	value="<?php echo htmlentities($result->Email) ?>">
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-2 control-label">Chức Vụ<span
																	style="color:red">*</span>
															</label>
															<div class="col-sm-4">
																<select class="selectpicker" name="position" required>
																	<option value="<?php echo htmlentities($result->PositionTypeID); ?>">
																		<?php echo htmlentities($bdname = $result->PositionName); ?>
																	</option>
																	<?php $ret = "SELECT * FROM tblpositiontypes";
																	$query = $dbh->prepare($ret);
																	//$query->bindParam(':id',$id, PDO::PARAM_STR);
																	$query->execute();
																	$resultss = $query->fetchAll(PDO::FETCH_OBJ);
																	if ($query->rowCount() > 0) {
																		foreach ($resultss as $results) {
																			if ($results->PositionName == $bdname) {
																				continue;
																			} else {
																				?>
																				<option
																					value="<?php echo htmlentities($results->PositionTypeID); ?>">
																					<?php echo htmlentities($results->PositionName); ?>
																				</option>
																			<?php }
																		}
																	} ?>

																</select>
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
												<?php }
											} ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

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