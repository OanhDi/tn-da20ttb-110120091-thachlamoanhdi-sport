<?php
session_start();
error_reporting(0);
include ('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {

	if (isset($_POST['submit'])) {
		$vehicletitle = $_POST['vehicletitle'];
		$brand = $_POST['brandname'];
		$vehicleoverview = $_POST['vehicalorcview'];
		$priceperday = $_POST['priceperday'];
		$fueltype = $_POST['fueltype'];
		$modelyear = $_POST['modelyear'];
		$seatingcapacity = $_POST['seatingcapacity'];
		$vimage1 = $_FILES["img1"]["name"];
		$vimage2 = $_FILES["img2"]["name"];
		$vimage3 = $_FILES["img3"]["name"];
		$vimage4 = $_FILES["img4"]["name"];
		$vimage5 = $_FILES["img5"]["name"];
		$airconditioner = $_POST['airconditioner'];
		$powerdoorlocks = $_POST['powerdoorlocks'];
		$antilockbrakingsys = $_POST['antilockbrakingsys'];
		$brakeassist = $_POST['brakeassist'];
		$powersteering = $_POST['powersteering'];
		$driverairbag = $_POST['driverairbag'];
		$passengerairbag = $_POST['passengerairbag'];
		$powerwindow = $_POST['powerwindow'];
		$cdplayer = $_POST['cdplayer'];
		$centrallocking = $_POST['centrallocking'];
		$crashcensor = $_POST['crashcensor'];
		$leatherseats = $_POST['leatherseats'];
		move_uploaded_file($_FILES["img1"]["tmp_name"], "img/vehicleimages/" . $_FILES["img1"]["name"]);
		move_uploaded_file($_FILES["img2"]["tmp_name"], "img/vehicleimages/" . $_FILES["img2"]["name"]);
		move_uploaded_file($_FILES["img3"]["tmp_name"], "img/vehicleimages/" . $_FILES["img3"]["name"]);
		move_uploaded_file($_FILES["img4"]["tmp_name"], "img/vehicleimages/" . $_FILES["img4"]["name"]);
		move_uploaded_file($_FILES["img5"]["tmp_name"], "img/vehicleimages/" . $_FILES["img5"]["name"]);

		$sql = "INSERT INTO tblvehicles(VehiclesTitle,VehiclesBrand,VehiclesOverview,PricePerDay,FuelType,ModelYear,SeatingCapacity,Vimage1,Vimage2,Vimage3,Vimage4,Vimage5,AirConditioner,PowerDoorLocks,AntiLockBrakingSystem,BrakeAssist,PowerSteering,DriverAirbag,PassengerAirbag,PowerWindows,CDPlayer,CentralLocking,CrashSensor,LeatherSeats) VALUES(:vehicletitle,:brand,:vehicleoverview,:priceperday,:fueltype,:modelyear,:seatingcapacity,:vimage1,:vimage2,:vimage3,:vimage4,:vimage5,:airconditioner,:powerdoorlocks,:antilockbrakingsys,:brakeassist,:powersteering,:driverairbag,:passengerairbag,:powerwindow,:cdplayer,:centrallocking,:crashcensor,:leatherseats)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':vehicletitle', $vehicletitle, PDO::PARAM_STR);
		$query->bindParam(':brand', $brand, PDO::PARAM_STR);
		$query->bindParam(':vehicleoverview', $vehicleoverview, PDO::PARAM_STR);
		$query->bindParam(':priceperday', $priceperday, PDO::PARAM_STR);
		$query->bindParam(':fueltype', $fueltype, PDO::PARAM_STR);
		$query->bindParam(':modelyear', $modelyear, PDO::PARAM_STR);
		$query->bindParam(':seatingcapacity', $seatingcapacity, PDO::PARAM_STR);
		$query->bindParam(':vimage1', $vimage1, PDO::PARAM_STR);
		$query->bindParam(':vimage2', $vimage2, PDO::PARAM_STR);
		$query->bindParam(':vimage3', $vimage3, PDO::PARAM_STR);
		$query->bindParam(':vimage4', $vimage4, PDO::PARAM_STR);
		$query->bindParam(':vimage5', $vimage5, PDO::PARAM_STR);
		$query->bindParam(':airconditioner', $airconditioner, PDO::PARAM_STR);
		$query->bindParam(':powerdoorlocks', $powerdoorlocks, PDO::PARAM_STR);
		$query->bindParam(':antilockbrakingsys', $antilockbrakingsys, PDO::PARAM_STR);
		$query->bindParam(':brakeassist', $brakeassist, PDO::PARAM_STR);
		$query->bindParam(':powersteering', $powersteering, PDO::PARAM_STR);
		$query->bindParam(':driverairbag', $driverairbag, PDO::PARAM_STR);
		$query->bindParam(':passengerairbag', $passengerairbag, PDO::PARAM_STR);
		$query->bindParam(':powerwindow', $powerwindow, PDO::PARAM_STR);
		$query->bindParam(':cdplayer', $cdplayer, PDO::PARAM_STR);
		$query->bindParam(':centrallocking', $centrallocking, PDO::PARAM_STR);
		$query->bindParam(':crashcensor', $crashcensor, PDO::PARAM_STR);
		$query->bindParam(':leatherseats', $leatherseats, PDO::PARAM_STR);
		$query->execute();
		$lastInsertId = $dbh->lastInsertId();
		if ($lastInsertId) {
			$msg = "Vehicle posted successfully";
		} else {
			$error = "Something went wrong. Please try again";
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

		<title>TVU Sport Center | Admin Order Products</title>

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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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
					<h2 class="page-title">Bán hàng sản phẩm</h2>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">Thông tin khách hàng</div>
								<?php if ($error) { ?>
									<div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?>
									</div><?php } else if ($msg) { ?>
										<div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?>
										</div><?php } ?>

								<div class="panel-body">
									<form method="post" class="form-horizontal" enctype="multipart/form-data">
										<div class="form-group">
											<label class="col-sm-2 control-label">Tên KH<span
													style="color:red">*</span></label>
											<div class="col-sm-4">
												<input type="text" name="customer_name" class="form-control" required>
											</div>
											<label class="col-sm-2 control-label">Điện Thoại<span
													style="color:red">*</span></label>
											<div class="col-sm-4">
												<input type="text" name="phone_number" class="form-control" required>
											</div>
										</div>

										<div class="hr-dashed"></div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Địa Chỉ<span
													style="color:red">*</span></label>
											<div class="col-sm-10">
												<textarea class="form-control" name="address_customer" rows="3"></textarea>
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-12">
												<h4><b>Thông tin thanh toán</b></h4>
											</div>
										</div>


										<div class="form-group">
											<label class="col-sm-2 control-label">Thanh Toán<span
													style="color:red">*</span></label>
											<div class="col-sm-4">
												<input type="text" name="price" class="form-control" required readonly>
											</div>
											<label class="col-sm-2 control-label">Giảm Giá<span
													style="color:red">*</span></label>
											<div class="col-sm-4">
												<select id="discount" name="discount" class="form-control">
													<option value="">--Chọn chiết khấu--</option>
													<?php
													$ret = "SELECT * FROM tbldiscount";
													$query = $dbh->prepare($ret);
													$query->execute();
													$resultss = $query->fetchAll(PDO::FETCH_OBJ);
													if ($query->rowCount() > 0) {
														foreach ($resultss as $results) {
															?>
															<option value="<?php echo htmlentities($results->value); ?>"
																data-id="<?php echo htmlentities($results->id); ?>">
																<?php echo htmlentities($results->description); ?>
															</option>
															<?php
														}
													} ?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Phụ Thu<span
													style="color:red">*</span></label>
											<div class="col-sm-4">
												<input type="text" id="extracharge" name="extracharge" class="form-control">
											</div>
											<label class="col-sm-2 control-label">Khuyến mãi<span
													style="color:red">*</span></label>
											<div class="col-sm-4">
												<input type="text" id="promotion" name="promotion" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Tổng<span
													style="color:red">*</span></label>
											<div class="col-sm-4">
												<input type="text" name="total" class="form-control" required readonly>
											</div>
											<div class="hr-dashed"></div>
										</div>
									</form>
								</div>

							</div>
						</div>

						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">Áp Dụng Mã</div>
								<div class="panel-body">
									<div class="form-group">
										<div class="col-sm-3">
											<div class="checkbox checkbox-inline">
												<input type="checkbox" id="check_promotion" name="check_promotion"
													value="1">
												<label for="check_promotion"> Khuyến mãi </label>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="checkbox checkbox-inline">
												<input type="checkbox" id="check_discount" name="check_discount" value="1">
												<label for="check_discount"> Giảm giá </label>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">Danh Sách Sản Phẩm</div>
								<div class="panel-body">
									<div class="form-group">
										<div class="col-sm-12">
											<table id="zctb" class="display table table-striped table-bordered table-hover"
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
																<td><a href="#" class="product-link">
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
																	<button class="choose-link"
																		id="choose-<?php echo htmlentities($result->id); ?>"
																		data-id="<?php echo htmlentities($result->id); ?>"
																		data-name="<?php echo htmlentities($result->name); ?>"
																		data-price="<?php echo htmlentities($result->price); ?>">
																		<i class="fa fa-check"></i></button>
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
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">Giỏ Hàng</div>
								<div class="panel-body">
									<div class="form-group">
										<div class="col-sm-12">
											<table id="selectedProducts"
												class="display table table-striped table-bordered table-hover"
												cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>#</th>
														<th>Tên sản phẩm</th>
														<th>Size</th>
														<th>Số lượng</th>
														<th>Đơn Giá</th>
														<th>Thành tiền</th>
														<th>Hành Động</th>
													</tr>
												</thead>
												<tbody>
													<!-- Các sản phẩm được thêm sẽ xuất hiện ở đây -->
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-8 col-sm-offset-2">
								<button class="btn btn-default" type="reset">Huỷ</button>
								<button class="btn btn-primary" id="btnorder" name="submit">Thanh Toán</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<script>
				$(document).ready(function () {
					document.getElementById('btnorder').addEventListener('click', function () {
						const Customername = document.querySelector('input[name="customer_name"]').value;
						const Phone = document.querySelector('input[name="phone_number"]').value;
						const Address = document.querySelector('textarea[name="address_customer"]').value;
						var table = document.getElementById('selectedProducts');
						var rows = table.getElementsByTagName('tr');

						let selectedProducts = [];
						var promotion = 0;
						var discount = 0;
						if ($('#check_promotion').is(':checked')) {
							var promotionText = $('#promotion').val().replace(/[^0-9]/g, "");
							promotion = promotionText !== '' ? parseFloat(promotionText) : 0;
						}
						if ($('#check_discount').is(':checked')) {
							var discountText = $('#discount').val();
							discount = discountText !== '' ? parseFloat(discountText) : 0;
						}
						var extraChargeText = $('#extracharge').val().replace(/[^0-9]/g, "");
						var extraCharge = extraChargeText !== '' ? parseFloat(extraChargeText) : 0;

						for (var i = 0; i < rows.length; i++) {
							var row = rows[i];
							var cells = row.getElementsByTagName('td');
							if (cells.length > 0) {
								var productId = row.dataset.id;
								var productName = cells[1].textContent.trim();
								var sizeInput = cells[2].querySelector('.size-input').value.trim();
								var quantityInput = cells[3].querySelector('.quantity-input').value.trim();
								var price = cells[4].textContent.trim();
								var totalPrice = cells[5].textContent.trim();
								var priceText = price.replace(/[^0-9]/g, "");
								var PriceParse = priceText !== '' ? parseFloat(priceText) : 0;
								var totalpriceText = totalPrice.replace(/[^0-9]/g, "");
								var totalPriceParse = totalpriceText !== '' ? parseFloat(totalpriceText) : 0;
								// console.log(productId, productName, sizeInput, price, totalPrice);
								selectedProducts.push({
									productId: productId,
									productName: productName,
									sizeInput: sizeInput,
									quantityInput: quantityInput,
									PriceParse: PriceParse,
									totalPriceParse: totalPriceParse
								});
							}
						}
						// console.log(selectedProducts);
						let jsonData = JSON.stringify(selectedProducts);
						fetchData(jsonData, Customername, Phone, Address, promotion, discount, extraCharge);
					});
					async function addOrder(Customername, Phone, Address) {
						// console.log(Customername, Phone, Address);
						return new Promise((resolve, reject) => {
							$.ajax({
								url: 'order/add-order.php',
								method: 'POST',
								data: {
									Customername: Customername,
									Phone: Phone,
									Address: Address
								},
								success: function (response) {
									const results = JSON.parse(response);
									if (results.status === 'success') {
										resolve(results.id);
									} else {
										reject('Error adding order: ' + results.message);
									}
								},
								error: function (xhr, status, error) {
									reject('AJAX error: ' + error);
								}
							});
						});
					}
					async function fetchData(jsonData, Customername, Phone, Address, promotion, discount, extraCharge) {
						try {
							OrderID = await addOrder(Customername, Phone, Address);
							// console.log(OrderID);
							const addOrderDetailResponse = await $.ajax({
								url: 'order/add-order-details.php',
								method: 'POST',
								data: {
									OrderID: OrderID,
									jsonData: jsonData,
									promotion: promotion,
									discount: discount,
									extraCharge: extraCharge
								}
							});

							// console.log(Bkdate,FieldType,Field)
							const results = JSON.parse(addOrderDetailResponse);
							if (results) {
								if (results.status === 'success') {
									toastr.success(results.message, 'Thông Báo');
									setTimeout(function () {
										location.href = 'manage-orderproducts.php';
									}, 1000);
								} else {
									toastr.error(results.message, 'Thông Báo!');
								}
							}
						} catch (error) {
							console.error(error);
							// toastr.error(error, 'Thông Báo!');
						}
					}
					$('.choose-link').on('click', function () {
						var productId = $(this).data('id');
						var productName = $(this).data('name');
						var productPrice = $(this).data('price');
						var tryPrice = parseFloat(productPrice);

						// Kiểm tra nếu sản phẩm đã tồn tại trong giỏ hàng
						var exists = false;
						$('#selectedProducts tbody tr').each(function () {
							if ($(this).data('id') == productId) {
								exists = true;
								return false; // thoát khỏi vòng lặp each
							}
						});

						if (!exists) {
							var rowCount = $('#selectedProducts tbody tr').length + 1;

							var newRow = `
																						<tr data-id="${productId}">
																							<td>${rowCount}</td>
																							<td>${productName}</td>
																							<td><input type="text" class="form-control size-input" /></td>
																							<td><input type="number" class="form-control quantity-input" min="1" step="1" value="1" /></td>
																							<td class="price">${(tryPrice).toLocaleString('vi-VN')} đ</td>
																							<td class="total-price">${(productPrice).toLocaleString('vi-VN')} đ</td>
																							<td><button class="remove-link btn btn-danger btn-sm">Xoá</button></td>
																						</tr>
																					`;

							$('#selectedProducts tbody').append(newRow);
							updateTotal();
						} else {
							alert('Sản phẩm này đã có trong giỏ hàng.');
						}
					});

					$(document).on('input', '.quantity-input', function () {
						var $this = $(this);
						var value = $this.val().replace(/[^0-9]/g, ''); // Loại bỏ tất cả các ký tự không phải số

						if (value === '' || parseInt(value, 10) < 1) {
							$this.val('1'); // Đặt giá trị tối thiểu hợp lệ là 1
						} else {
							$this.val(parseInt(value, 10));
						}
						var $this = $(this);
						var value = parseInt($this.val(), 10);

						// Kiểm tra và điều chỉnh giá trị
						if (isNaN(value) || value < 1 || value % 1 !== 0) {
							$this.val(1); // Đặt giá trị tối thiểu hợp lệ là 1
						}
						updateTotal();
					});
					//Phụ Thu
					$(document).on('input', '#extracharge', function () {
						var $this = $(this);
						var value = $this.val().replace(/[^0-9]/g, ''); // Loại bỏ tất cả các ký tự không phải số

						if (value === '' || parseInt(value, 10) < 0) {
							$this.val('0'); // Đặt giá trị tối thiểu hợp lệ là 1
						} else {
							$this.val(parseInt(value, 10));
						}
						var $this = $(this);
						var value = parseInt($this.val(), 10);

						// Kiểm tra và điều chỉnh giá trị
						if (isNaN(value) || value < 0 || value % 1 !== 0) {
							$this.val(0); // Đặt giá trị tối thiểu hợp lệ là 1
						}
					});
					$(document).on('change', '#extracharge', function () {
						var value = $(this).val() || '0'; // Nếu giá trị không tồn tại, sử dụng '0'
						value = value.replace(/[^0-9]/g, ''); // Loại bỏ tất cả các ký tự không phải số
						$(this).val(formatCurrency(value)); // Đặt giá trị đã được định dạng
						updateTotal(); // Cập nhật tổng						
					});
					//Khuyến mãi
					$(document).on('input', '#promotion', function () {
						var $this = $(this);
						var value = $this.val().replace(/[^0-9]/g, ''); // Loại bỏ tất cả các ký tự không phải số

						if (value === '' || parseInt(value, 10) < 0) {
							$this.val('0'); // Đặt giá trị tối thiểu hợp lệ là 1
						} else {
							$this.val(parseInt(value, 10));
						}
						var $this = $(this);
						var value = parseInt($this.val(), 10);

						// Kiểm tra và điều chỉnh giá trị
						if (isNaN(value) || value < 0 || value % 1 !== 0) {
							$this.val(0); // Đặt giá trị tối thiểu hợp lệ là 1
						}
					});
					$(document).on('change', '#promotion', function () {
						var value = $(this).val() || '0'; // Nếu giá trị không tồn tại, sử dụng '0'
						value = value.replace(/[^0-9]/g, ''); // Loại bỏ tất cả các ký tự không phải số
						$(this).val(formatCurrency(value)); // Đặt giá trị đã được định dạng
						updateTotal(); // Cập nhật tổng						
					});
					$(document).on('change', '#discount', function () {
						updateTotal(); // Cập nhật tổng						
					});
					function formatCurrency(value) {
						if (value === '' || isNaN(value)) return '0 đ';
						return parseFloat(value).toLocaleString('vi-VN') + ' đ';
					}

					$(document).on('click', '.remove-link', function () {
						$(this).closest('tr').remove();
						updateRowNumbers();
						updateTotal();
					});
					$(document).on('change', '#check_promotion', function () {
						updateTotal(); // Cập nhật tổng khi checkbox "khuyến mãi" thay đổi
					});
					$(document).on('change', '#check_discount', function () {
						updateTotal(); // Cập nhật tổng khi checkbox "giảm giá" thay đổi
					});
					function updateTotal() {
						var grandTotal = 0;
						$('#selectedProducts tbody tr').each(function () {
							var quantity = $(this).find('.quantity-input').val();
							var tryquantity = parseFloat(quantity);
							var priceText = $(this).find('.price').text().trim();
							var numericValue = priceText.replace(' đ', '').replace(/\./g, '');
							var price = parseFloat(numericValue, 10);
							//  var price = parseFloat(priceText.replace(/[^0-9.-]+/g, ""));							
							var total = parseFloat(tryquantity * price);
							grandTotal += total;
							$(this).find('.total-price').text(parseFloat(total).toLocaleString('vi-VN') + ' đ');
						});
						// Cập nhật phụ thu
						var extraChargeText = $('#extracharge').val().replace(/[^0-9]/g, "");
						var extraCharge = extraChargeText !== '' ? parseFloat(extraChargeText) : 0;
						var promotion = 0;
						var discount = 0;
						if ($('#check_promotion').is(':checked')) {
							var promotionText = $('#promotion').val().replace(/[^0-9]/g, "");
							promotion = promotionText !== '' ? parseFloat(promotionText) : 0;
						}
						if ($('#check_discount').is(':checked')) {
							var discountText = $('#discount').val();
							discount = discountText !== '' ? parseFloat(discountText) : 0;
						}

						var finalTotal = (grandTotal + extraCharge) - promotion;
						// Áp dụng chiết khấu phần trăm
						if (discount > 0) {
							finalTotal = finalTotal - (finalTotal * (discount / 100));
						}
						// Cập nhật ô thanh toán
						$('input[name="price"]').val(grandTotal.toLocaleString('vi-VN') + ' đ');
						$('input[name="total"]').val(finalTotal.toLocaleString('vi-VN') + ' đ');
					}
					function updateRowNumbers() {
						$('#selectedProducts tbody tr').each(function (index) {
							$(this).find('td:first').text(index + 1);
						});
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