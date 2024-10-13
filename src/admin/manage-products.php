<?php
session_start();
error_reporting(0);
include ('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {

	if (isset($_POST['submit_new'])) {
		$product_name = $_POST['product_name'];
		$description = $_POST['description'];
		$price_hidden = $_POST['price_hidden'];
		$product_type = $_POST['product_type'];
		$product_image = $_FILES["product_image"]["name"];

		move_uploaded_file($_FILES["product_image"]["tmp_name"], "img/product/" . $_FILES["product_image"]["name"]);

		$sql = "INSERT INTO tblproducts(name,description,price,category_id,image_url) VALUES(:product_name,:description,:price_hidden,:product_type,:product_image)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':product_name', $product_name, PDO::PARAM_STR);
		$query->bindParam(':description', $description, PDO::PARAM_STR);
		$query->bindParam(':price_hidden', $price_hidden, PDO::PARAM_INT);
		$query->bindParam(':product_type', $product_type, PDO::PARAM_STR);
		$query->bindParam(':product_image', $product_image, PDO::PARAM_STR);

		$query->execute();
		$lastInsertId = $dbh->lastInsertId();
		if ($lastInsertId) {
			$msg = "Thêm dữ liệu thành công!";
		} else {
			$error = "Thêm dữ liệu thất bại. Vui lòng thử lại!";
		}

	}
	if (isset($_POST['submit_up'])) {
		if (isset($_POST['product_id']) && !empty($_POST['product_id'])) {
			$product_id = $_POST['product_id'];
			$product_name = $_POST['product_name'];
			$description = $_POST['description'];
			$price_hidden = $_POST['price_hidden'];
			$product_type = $_POST['product_type'];
			$product_image = $_FILES["product_image"]["name"];
			if (isset($_FILES["product_image"]["name"]) && !empty($_FILES["product_image"]["name"])) {
				move_uploaded_file($_FILES["product_image"]["tmp_name"], "img/product/" . $_FILES["product_image"]["name"]);
				$img_str = ',image_url = :product_image';
			}
			$sql = "UPDATE tblproducts SET name = :product_name, description = :description,price = :price_hidden,category_id = :product_type" . $img_str . "
					WHERE id = :product_id";
			$query = $dbh->prepare($sql);
			$query->bindParam(':product_name', $product_name, PDO::PARAM_STR);
			$query->bindParam(':description', $description, PDO::PARAM_STR);
			$query->bindParam(':price_hidden', $price_hidden, PDO::PARAM_INT);
			$query->bindParam(':product_type', $product_type, PDO::PARAM_STR);
			if (isset($_FILES["product_image"]["name"]) && !empty($_FILES["product_image"]["name"])) {
				$query->bindParam(':product_image', $product_image, PDO::PARAM_STR);
			}
			$query->bindParam(':product_id', $product_id, PDO::PARAM_INT);
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

		$sql = "DELETE FROM tblproducts WHERE id = :product_id";
		$query = $dbh->prepare($sql);
		$query->bindParam(':product_id', $delid, PDO::PARAM_INT);
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

		<title>TVU Sport Center | Admin Manage Product </title>
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

							<h2 class="page-title">Sản Phẩm Thể Thao</h2>

							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-heading">Thông Tin Sản Phẩm</div>
										<?php if ($error) { ?>
											<div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?>
											</div><?php } else if ($msg) { ?>
												<div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?>
													<script>
														setTimeout(function () {
															window.location.href = 'manage-products.php';
														}, 2000); // Chuyển hướng sau 2 giây
													</script>
												</div><?php } ?>

										<div class="panel-body">
											<form method="post" class="form-horizontal" enctype="multipart/form-data">
												<div class="form-group">
													<label class="col-sm-2 control-label">Mã sản phẩm<span
															style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" id="product_id" name="product_id"
															class="form-control" required readonly>
													</div>
													<label class="col-sm-2 control-label">Tên sản phẩm<span
															style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" id="product_name" name="product_name"
															class="form-control" required>
													</div>
												</div>

												<div class="hr-dashed"></div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Mô tả<span
															style="color:red">*</span></label>
													<div class="col-sm-10">
														<textarea class="form-control" id="description" name="description"
															rows="3" required></textarea>
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-2 control-label">Đơn Giá(VNĐ)<span
															style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" id="price" name="price" class="form-control"
															required>
														<input type="hidden" id="price_hidden" name="price_hidden"
															class="form-control">
													</div>
													<label class="col-sm-2 control-label">Loại sản phẩm<span
															style="color:red">*</span></label>
													<div class="col-sm-4">
														<select class="selectpicker" id="product_type" name="product_type"
															required>
															<?php
															$ret = "SELECT * FROM tblproductcategory";
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
												</div>


												<div class="form-group">
													<label class="col-sm-2 control-label">Chọn hình ảnh<span
															style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="file" name="product_image" id="product_image"
															class="form-control" accept="image/*"
															onchange="previewImage(event)">
													</div>
													<label class="col-sm-2 control-label">Hình sản phẩm<span
															style="color:red">*</span></label>
													<div class="col-sm-4">
														<img id="productImage" src="img/product/noimage.png"
															alt="Product Image" class="img-thumbnail"
															style="max-width: 100%;">
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
														<h4><b>Danh sách sản phẩm</b></h4>
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
																	<th>Đơn giá</th>
																	<th>Loại sản phẩm</th>
																	<th>Hành Động</th>
																</tr>
															</thead>
															<tbody>

																<?php $sql = "SELECT p.*,c.name AS name_type FROM tblproducts p 
																				INNER JOIN tblproductcategory c on c.id = p.category_id";
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
																					data-description="<?php echo htmlentities($result->description); ?>"
																					data-price="<?php echo htmlentities($result->price); ?>"
																					data-type="<?php echo htmlentities($result->category_id); ?>"
																					data-image="<?php echo htmlentities($result->image_url); ?>">
																					<?php echo htmlentities($result->name); ?></a>
																			</td>
																			<td><?php echo htmlentities($result->description); ?>
																			</td>
																			<td>
																				<script>document.write((<?php echo htmlentities($result->price); ?>).toLocaleString('vi-VN') + ' đ');</script>
																			</td>
																			<td><?php echo htmlentities($result->name_type); ?></td>
																			</td>
																			<td>&nbsp;&nbsp;
																				<a href="manage-products.php?del=<?php echo $result->id; ?>"
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
			function previewImage(event) {
				var reader = new FileReader();
				reader.onload = function () {
					var output = document.getElementById('productImage');
					if (output) {
						output.src = reader.result;
					} else {
						console.error("Element with ID 'productImage' not found.");
					}
				};
				reader.readAsDataURL(event.target.files[0]);
			}
			document.getElementById('price').addEventListener('input', function (e) {
				let value = e.target.value.replace(/\D/g, ''); // delete all not in number
				if (value) {
					value = parseInt(value).toLocaleString('vi-VN');
				}
				e.target.value = value;
				document.getElementById('price_hidden').value = value.replace(/\./g, '');
			});
			document.addEventListener('DOMContentLoaded', function () {
				document.querySelectorAll('.product-link').forEach(function (element) {
					element.addEventListener('click', function (event) {
						event.preventDefault();

						var productId = this.dataset.id;
						var productName = this.dataset.name;
						var productDescription = this.dataset.description;
						var productPrice = this.dataset.price;
						var productType = this.dataset.type;
						var productImage = this.dataset.image;

						const price = parseFloat(productPrice);

						document.getElementById('product_id').value = productId;
						document.getElementById('product_name').value = productName;
						document.getElementById('description').value = productDescription;
						document.getElementById('price_hidden').value = productPrice;
						document.getElementById('price').value = price.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
						document.getElementById('product_type').value = productType;
						document.getElementById('productImage').src = 'img/product/' + productImage;
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