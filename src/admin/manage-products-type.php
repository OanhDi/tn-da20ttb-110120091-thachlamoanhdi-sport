<?php
session_start();
error_reporting(0);
include ('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {

	if (isset($_POST['submit_new'])) {
		$product_type_name = $_POST['product_type_name'];
		$description = $_POST['description'];		
		$sql = "INSERT INTO tblproductcategory(name,description) VALUES(:product_type_name,:description)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':product_type_name', $product_type_name, PDO::PARAM_STR);
		$query->bindParam(':description', $description, PDO::PARAM_STR);		

		$query->execute();
		$lastInsertId = $dbh->lastInsertId();
		if ($lastInsertId) {
			$msg = "Thêm dữ liệu thành công!";
		} else {
			$error = "Thêm dữ liệu thất bại. Vui lòng thử lại!";
		}

	}
	if (isset($_POST['submit_up'])) {
		if (isset($_POST['product_type_id']) && !empty($_POST['product_type_id'])) {
			$product_type_id = $_POST['product_type_id'];
			$product_type_name = $_POST['product_type_name'];
			$description = $_POST['description'];
			
			$sql = "UPDATE tblproductcategory SET name = :product_type_name, description = :description
					WHERE id = :product_type_id";
			$query = $dbh->prepare($sql);
			$query->bindParam(':product_type_name', $product_type_name, PDO::PARAM_STR);
			$query->bindParam(':description', $description, PDO::PARAM_STR);
			$query->bindParam(':product_type_id', $product_type_id, PDO::PARAM_INT);
			if ($query->execute()) {
				$msg = "Cập nhật dữ liệu thành công!";
			} else {
				$error = "Cập nhật dữ liệu thất bại. Vui lòng thử lại!";
			}

		} else {
			$error = "Vui lòng chọn sản phẩm!";
		}
	}
	if (isset($_REQUEST['del'])) {
		$delid = intval($_GET['del']);

		$sql = "DELETE FROM tblproductcategory WHERE id = :product_type_id";
		$query = $dbh->prepare($sql);
		$query->bindParam(':product_type_id', $delid, PDO::PARAM_INT);
		if ($query->execute()) {
			$msg = "Xoá dữ liệu thành công!";
		} else {
			$error = "Xoá dữ liệu thất bại. Vui lòng thử lại!";
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

		<title>TVU Sport Center| Admin Manage Product Type </title>
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

			#productImage {
				max-width: 350px;
				max-height: 150px;
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

							<h2 class="page-title">Loại Sản Phẩm</h2>

							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-heading">Thông Tin Loại Sản Phẩm</div>
										<?php if ($error) { ?>
											<div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?>
											</div><?php } else if ($msg) { ?>
												<div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?>
													<script>
														setTimeout(function () {
															window.location.href = 'manage-products-type.php';
														}, 2000); // Chuyển hướng sau 2 giây
													</script>
												</div><?php } ?>

										<div class="panel-body">
											<form method="post" class="form-horizontal" enctype="multipart/form-data">
												<div class="form-group">
													<label class="col-sm-2 control-label">Mã loại sản phẩm<span
															style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" id="product_type_id" name="product_type_id"
															class="form-control" readonly>
													</div>
													<label class="col-sm-2 control-label">Tên loại sản phẩm<span
															style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" id="product_type_name" name="product_type_name"
															class="form-control" required>
													</div>
												</div>

												<div class="hr-dashed"></div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Mô tả<span
															style="color:red">*</span></label>
													<div class="col-sm-10">
														<textarea class="form-control" id="description" name="description"
															rows="3" ></textarea>
													</div>
												</div>
												<div class="form-group">
													<div class="col-sm-2 ">
														<button class="btn btn-success" name="submit_new" type="submit">Thêm
															mới
															dữ
															liệu</button>
													</div>
													<div class="col-sm-2 ">
														<button class="btn btn-primary" name="submit_up" type="submit">Lưu
															dữ
															liệu</button>
													</div>
												</div>
												<div class="hr-dashed"></div>


												<div class="form-group">
													<div class="col-sm-12">
														<h4><b>Danh sách loại sản phẩm</b></h4>
													</div>
												</div>


												<div class="form-group">
													<div class="col-sm-12">
														<table id="zctb"
															class="display table table-striped table-bordered table-hover"
															cellspacing="0" width="100%">
															<thead>
																<tr>
																	<th>#</th>
																	<th>Tên sản phẩm</th>
																	<th>Mô tả </th>
																	<th>Hành Động</th>
																</tr>
															</thead>
															<tbody>

																<?php $sql = "SELECT * FROM tblproductcategory";
																$query = $dbh->prepare($sql);
																$query->execute();
																$results = $query->fetchAll(PDO::FETCH_OBJ);
																$cnt = 1;
																if ($query->rowCount() > 0) {
																	foreach ($results as $result) {
																		?>
																		<tr>
																			<td><?php echo htmlentities($cnt); ?></td>
																			<td><a href="#" class="product-link"
																					data-id="<?php echo htmlentities($result->id); ?>"
																					data-name="<?php echo htmlentities($result->name); ?>"
																					data-description="<?php echo htmlentities($result->description); ?>">
																					<?php echo htmlentities($result->name); ?></a>
																			</td>
																			<td><?php echo htmlentities($result->description); ?>
																			</td>																			
																			<td>&nbsp;&nbsp;
																				<a href="manage-products-type.php?del=<?php echo $result->id; ?>"
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
												<div class="hr-dashed"></div>
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
			document.addEventListener('DOMContentLoaded', function () {
				document.querySelectorAll('.product-link').forEach(function (element) {
					element.addEventListener('click', function (event) {
						event.preventDefault();

						var productTypeId = this.dataset.id;
						var productTypeName = this.dataset.name;
						var productDescription = this.dataset.description;												

						document.getElementById('product_type_id').value = productTypeId;
						document.getElementById('product_type_name').value = productTypeName;
						document.getElementById('description').value = productDescription;						
					});
				});
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