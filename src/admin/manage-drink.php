<?php
session_start();
error_reporting(0);
include ('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {

	if (isset($_REQUEST['del'])) {
		$delid = intval($_GET['del']);
		$sql = "DELETE FROM tbldrink WHERE DrinkID = :delid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':delid', $delid, PDO::PARAM_STR);
		$query->execute();
		$msg = "Xoá dữ liệu sân bóng thành công!";
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

		<title>TVU Sport Center |Admin Manage Drink </title>

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
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<!-- Toastr CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
		<link rel="shortcut icon" href="../assets/images/favicon-icon/logo.jpg">
		<!-- Toastr JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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

							<h2 class="page-title">Danh Mục Nước Uống</h2>

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
													window.location.href = 'manage-drink.php';
												}, 2000); // Chuyển hướng sau 2 giây
											</script>
									<?php } ?>
									<div class="row mb-4">
										<div class="col-md-12">
											<div class="form-group">
												<label for="drinkname">Tên Nước Giải Khát</label>
												<input type="text" id="drinkname" class="form-control"
													placeholder="Nhập tên nước giải khát">
											</div>
											<div class="form-group">
												<label for="priceperunit">Đơn Giá</label>
												<input type="number" id="priceperunit" class="form-control"
													placeholder="Nhập đơn giá" min="0" step="0.01">
											</div>
											<div class="btn-group col-md-8" style="padding-bottom: 1rem">
												<div class="col-md-4">
													<button id="addButton" class="btn btn-primary">Thêm Vào</button>
												</div>
											</div>
										</div>
									</div>
									<table id="zctb" class="display table table-striped table-bordered table-hover"
										cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Tên Nước Giải Khát</th>
												<th>Đơn Giá </th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>

											<?php $sql = "SELECT * FROM tbldrink";
											$query = $dbh->prepare($sql);
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;
											if ($query->rowCount() > 0) {
												foreach ($results as $result) {
													?>
													<tr>
														<td><?php echo htmlentities($cnt); ?></td>
														<td><?php echo htmlentities($result->DrinkName); ?></td>
														<td><?php echo htmlentities($result->PricePerUnit); ?></td>
														<td><a href="edit-drink.php?id=<?php echo $result->DrinkID; ?>"><i
																	class="fa fa-edit"></i></a>&nbsp;&nbsp;
															<a href="manage-drink.php?del=<?php echo $result->DrinkID; ?>"
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
				document.getElementById('addButton').addEventListener('click', function () {
					const drinkname = document.getElementById('drinkname').value;
					const priceperunit = document.getElementById('priceperunit').value;
					fetchData(drinkname, priceperunit);
				});
				async function fetchData(drinkname, priceperunit) {
					try {
						const addDrinkResponse = await $.ajax({
							url: 'add-drink.php',
							method: 'POST',
							data: {
								drinkname: drinkname,
								priceperunit: priceperunit
							}
						});
						const results = JSON.parse(addDrinkResponse);
						if (results) {
							results.forEach(result => {
								if (result.status === 'success') {
									toastr.success(result.message);
									setTimeout(function () {
										window.location.href = 'manage-drink.php';
									}, 1000);
								} else if (result.status === 'error') {
									toastr.error(result.message);
								}
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