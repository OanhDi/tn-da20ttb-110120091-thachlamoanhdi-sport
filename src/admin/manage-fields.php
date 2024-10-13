<?php
session_start();
error_reporting(0);
include ('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {

	if (isset($_REQUEST['del'])) {
		$delid = intval($_GET['del']);
		$sql = "DELETE FROM tblfields WHERE FieldID = :delid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':delid', $delid, PDO::PARAM_STR);
		$query->execute();
		$msg = "Xoá dữ liệu sân bóng thành công!";
	}
	if (isset($_POST['submit'])) {
		$fieldname = $_POST['fieldname'];
		$fieldType = $_POST['fieldType'];
		$address = $_POST['address'];
		$size = $_POST['size'];
		$maxplayer = $_POST['maxplayer'];

		$sql = "INSERT INTO tblfields(FieldName,Address,FieldTypeID,Size,MaxPlayers, Notes,FieldGroup) VALUES(:fieldname, :address, :fieldType, :size, :maxplayer, :note, NULL)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':fieldname', $fieldname);
		$query->bindParam(':fieldType', $fieldType);
		$query->bindParam(':address', $address);
		$query->bindParam(':size', $size);
		$query->bindParam(':maxplayer', $maxplayer);
		$query->bindParam(':note', $fieldname);
		if ($query->execute()) {
			$msg = "Dữ liệu thêm thành công";
		} else {
			$error = "Thêm dữ liệu thất bại!";
		}
		// echo $fieldname;
		//  $msg = $fieldType;
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

		<title>TVU Sport Center |Admin Manage Fields </title>

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

							<h2 class="page-title">Quản Lý Sân</h2>

							<!-- Zero Configuration Table -->
							<div class="panel panel-default">
								<div class="panel-heading">Chi Tiết Sân</div>
								<class="panel-body">
									<?php if ($error) { ?>
										<div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div>
									<?php } else if ($msg) { ?>
											<div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div>
											<script>
														setTimeout(function () {
															window.location.href = 'manage-fields.php';
														}, 2000); // Chuyển hướng sau 2 giây
													</script>
									<?php } ?>
								<form method="post" class="form-control" enctype="multipart/form-data">
									<div class="row mb-4">
										<div class="col-md-12">
											<div class="form-group">
												<label for="fieldname">Tên Sân</label>
												<input type="text" id="fieldname" name="fieldname" class="form-control"
													placeholder="Nhập tên sân">
											</div>
											<div class="form-group">
												<label for="fieldType">Loại Sân</label>
												<select class="form-control" name="fieldType" id="fieldType" required>
													<option value="">Chọn Loại Sân</option>
												</select>
											</div>
											<div class="form-group">
												<label for="address">Địa Chỉ</label>
												<input type="text" id="address" name="address" class="form-control"
													placeholder="Nhập địa Chỉ">
											</div>
											<div class="form-group">
												<label for="size">Kích Thước</label>
												<input type="text" id="size" name="size" class="form-control"
													placeholder="Nhập kích thước">
											</div>
											<div class="form-group">
												<label for="maxplayer">Số Người Tối Đa</label>
												<input type="text" id="maxplayer" name="maxplayer" class="form-control"
													placeholder="Nhập số người tối đa">
											</div>
											<div class="btn-group col-md-8" style="padding-bottom: 1rem">
												<div class="col-md-4">
													<button class="btn btn-primary" name="submit" type="submit">Thêm Vào</button>
												</div>
											</div>
										</div>
									</div>
								</form>
									<table id="zctb" class="display table table-striped table-bordered table-hover"
										cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Tên Sân</th>
												<th>Địa Chỉ </th>
												<th>Kích Thước</th>
												<th>Số Người Tối Đa</th>
												<th>Thể Loại Sân</th>												
												<th>Action</th>
											</tr>
										</thead>
										<tbody>

											<?php $sql = "SELECT f.FieldID,f.FieldName,f.Address,f.Size,f.MaxPlayers,ft.TypeName FROM tblfields f 
															INNER JOIN tblfieldtypes ft ON f.FieldTypeID = ft.FieldTypeID
															ORDER BY f.FieldName,ft.TypeName ASC";
											$query = $dbh->prepare($sql);
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;
											if ($query->rowCount() > 0) {
												foreach ($results as $result) {
													?>
													<tr>
														<td><?php echo htmlentities($cnt); ?></td>
														<td><?php echo htmlentities($result->FieldName); ?></td>
														<td><?php echo htmlentities($result->Address); ?></td>
														<td><?php echo htmlentities($result->Size); ?></td>
														<td><?php echo htmlentities($result->MaxPlayers); ?></td>
														<td><?php echo htmlentities($result->TypeName); ?></td>														
														<td><a href="edit-field.php?id=<?php echo $result->FieldID; ?>"><i
																	class="fa fa-edit"></i></a>&nbsp;&nbsp;
															<a href="manage-fields.php?del=<?php echo $result->FieldID; ?>"
																onclick="return confirm('Bạn muốn xoá dữ liệu?');"><i
																	class="fa fa-close"></i></a>
														</td>
													</tr>
													<?php $cnt = $cnt + 1;
												}
											} ?>

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
				$.ajax({
					url: 'field/getfieldType.php',
					method: 'GET',
					success: function (response) {
						try {
							const resultsEP = JSON.parse(response);
							// console.log(resultsEP);
							const selectField = $('#fieldType');
							if (resultsEP && resultsEP.length > 0) {
								resultsEP.forEach(result => {
									const option = `<option value="${result.FieldTypeID}">${result.TypeName}</option>`;
									selectField.append(option);
								});
							}
						} catch (e) {
							console.error("Error parsing JSON:", e);
						}
					}
				});
			})
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