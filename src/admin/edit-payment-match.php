<?php
session_start();
error_reporting(0);
include ('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
	function formatCurrencyVND($number)
	{
		return number_format($number, 0, ',', '.') . ' VNĐ';
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

		<title>TVU Sport Center | Admin Edit Payment Match</title>

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
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap" rel="stylesheet">
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

					<div class="row">
						<div class="col-md-12">

							<h2 class="page-title">Thanh Toán Sân Đấu</h2>

							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-heading">Thông Tin Thanh Toán</div>
										<div class="panel-body">
											<?php if ($msg) { ?>
												<div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?>
													<script>
														// setTimeout(function () {
														// 	window.location.href = 'manage-employees.php';
														// }, 2000); // Chuyển hướng sau 2 giây
													</script>
												</div><?php } ?>
											<?php
											$id = intval($_GET['id']);
											$sql = "SELECT m.MatchID,bk.BookingID,f.FieldName,tm.NameMatch, fm.Price, 'Kết thúc trận đấu' AS Status FROM tblmatches m 
													INNER JOIN tblbookings bk ON bk.BookingID = m.BookingID
													INNER JOIN tblfieldmatch fm ON fm.idfm = bk.idfm
													INNER JOIN tbltimematch tm on tm.idtm = fm.idtm
													INNER JOIN tblfields f ON f.FieldID = fm.FieldID
													WHERE m.Status = '4' AND m.MatchID = :id";
											$query = $dbh->prepare($sql);
											$query->bindParam(':id', $id, PDO::PARAM_STR);
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;
											if ($query->rowCount() > 0) {
												foreach ($results as $result) { ?>

													<form method="post" class="form-horizontal" enctype="multipart/form-data">
														<div class="form-group">
															<label class="col-sm-2 control-label">Mã trận<span
																	style="color:blue">*</span></label>
															<div class="col-sm-4">
																<input type="text" name="matchid" class="form-control"
																	value="<?php echo htmlentities($result->MatchID) ?>" readonly>
															</div>
															<label class="col-sm-2 control-label">Trạng thái<span
																	style="color:blue">*</span></label>
															<div class="col-sm-4">
																<?php

																?>
																<input type="text" name="status" class="form-control" value="<?php
																$id_st = intval($_GET['id']);
																$sql_st = "SELECT * FROM tblmatchpayments WHERE MatchID = :id";
																$query_st = $dbh->prepare($sql_st);
																$query_st->bindParam(':id', $id_st, PDO::PARAM_STR);
																$query_st->execute();
																$results_st = $query_st->fetchAll(PDO::FETCH_OBJ);
																if ($query_st->rowCount() > 0) {
																	foreach ($results_st as $rs_st) {
																		if ($rs_st->Status === 1) {
																			$message = "Đã thanh toán";
																			$color = 'blue';
																		} else {
																			$message = "Chưa thanh toán";
																			$color = 'red';
																		}
																		echo htmlentities($message);
																	}
																} else {
																	echo htmlentities('Chưa thanh toán');
																	$color = 'red';
																}
																?>" style="color: <?php echo htmlentities($color) ?>" readonly>
															</div>

														</div>
														<div class="form-group">
															<label class="col-sm-2 control-label">Sân đấu<span
																	style="color:blue">*</span></label>
															<div class="col-sm-4">
																<input type="text" name="fieldname" class="form-control"
																	value="<?php echo htmlentities($result->FieldName) ?>" readonly>
															</div>
															<label class="col-sm-2 control-label">Giờ đấu<span
																	style="color:blue">*</span></label>
															<div class="col-sm-4">
																<input type="text" name="namematch" class="form-control"
																	value="<?php echo htmlentities($result->NameMatch) ?>" readonly>
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-2 control-label">Giá sân<span
																	style="color:blue">*</span></label>
															<div class="col-sm-4">
																<input type="hidden" name="price-hidden" class="form-control"
																	value="<?php echo htmlentities($result->Price) ?>">
																<input type="text" name="price" class="form-control"
																	value="<?php echo htmlentities(formatCurrencyVND($result->Price)) ?>"
																	readonly>
															</div>
															<label class="col-sm-2 control-label">Phụ Thu<span
																	style="color:blue">*</span></label>
															<div class="col-sm-4">
																<input type="text" name="extracharge_display"
																	id="extracharge_display" class="form-control"
																	onchange="calculateTotalExtra()">
																<input type="hidden" name="extracharge" id="extracharge" value="">
																<input type="hidden" name="extracharge_v" id="extracharge_v"
																	value="">
															</div>
														</div>
														<div class="panel-body">
															<div class="panel-heading">Chọn nước uống</div>
															<div class="row">
																<!-- Danh sách nước uống -->
																<div class="col-md-12">
																	<div class="card">
																		<div class="card-header">
																			Danh sách nước uống
																		</div>
																		<ul class="list-group list-group-flush" id="drinkList">
																			<table id="zctb"
																				class="display table table-striped table-bordered table-hover"
																				cellspacing="0" width="100%">
																				<thead>
																					<tr>
																						<th width="5%">Chọn </th>
																						<th width="40%">Tên Nước</th>
																						<th width="15%">Đơn Giá</th>
																						<th width="15%">Số Lượng</th>
																						<th width="25%">Thành Tiền</th>
																					</tr>
																				</thead>
																				<tbody>
																					<?php $sql = "SELECT * FROM tbldrink";
																					$query = $dbh->prepare($sql);
																					$query->execute();
																					$results = $query->fetchAll(PDO::FETCH_OBJ);
																					if ($query->rowCount() > 0) {
																						foreach ($results as $result) {
																							?>
																							<tr>
																								<td><input type="checkbox"
																										name="selectDrink-<?php echo htmlentities($result->DrinkID); ?>"
																										id="selectDrink-<?php echo htmlentities($result->DrinkID); ?>"
																										value="<?php echo htmlentities($result->DrinkID); ?>">
																								</td>
																								<td><?php echo htmlentities($result->DrinkName); ?>
																								</td>
																								<td class="price">
																									<?php echo htmlentities($result->PricePerUnit); ?>
																								</td>
																								<td>
																									<input type="number" name="quantity"
																										id="quantity-<?php echo htmlentities($result->DrinkID); ?>"
																										class="form-control quantity"
																										size="3" onkeypress="return isNumberKey(event)"
																										oninput="calculateTotal(<?php echo htmlentities($result->DrinkID); ?>)"
																										min="1" step="1">
																								</td>
																								<td>
																									<input type="hidden" name="total-hidden"
																										id="total-hidden-<?php echo htmlentities($result->DrinkID); ?>"
																										class="form-control total-hidden">
																									<input type="number" name="total"
																										id="total-<?php echo htmlentities($result->DrinkID); ?>"
																										class="form-control total" size="5"
																										readonly>
																								</td>
																							</tr>
																							<?php
																						}
																					} ?>
																				</tbody>
																			</table>
																		</ul>
																		<div class="form-group">
																			<div class="col-sm-4 col-sm-offset-2">
																				<button class="btn btn-primary" name="submit"
																					style="margin-top:1%"
																					onclick="processPayment(event)">Thanh Toán
																					Trận Đấu</button>
																			</div>
																			<div class="col-sm-6">
																				<label class="col-sm-6 control-label">Số tiền cần
																					phải thanh toán là: </label>
																				<div class="col-sm-4">
																					<input type="text" name="pricepayment"
																						class="form-control"
																						value="<?php echo htmlentities($result->NameMatch) ?>"
																						readonly>
																					<input type="hidden" name="pricepayment-hidden"
																						class="form-control"
																						value="<?php echo htmlentities($result->NameMatch) ?>"
																						readonly>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
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
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
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
		<script>
			function isNumberKey(evt) {
				var charCode = (evt.which) ? evt.which : evt.keyCode;
				if (charCode > 31 && (charCode < 48 || charCode > 57)) {
					return false;
				}
				return true;
			}
		</script>
		<script>
			$(document).ready(function () {
				const priceInput = document.querySelector('input[name="price-hidden"]').value;
				const pricePayment = document.querySelector('input[name="pricepayment"]');
				const extraCharge_v = document.querySelector('input[name="extracharge_v"]');
				let total_priceField = 0;
				total_priceField = parseFloat(priceInput);
				const formattedAmount = total_priceField.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
				pricePayment.value = formattedAmount;
				extraCharge_v.value = total_priceField;
			});
			document.getElementById('extracharge_display').addEventListener('input', function (e) {
				let value = e.target.value.replace(/\D/g, ''); // delete all not in number
				if (value) {
					value = parseInt(value).toLocaleString('vi-VN');
				}
				e.target.value = value;
				document.getElementById('extracharge').value = value.replace(/\./g, '');
			});
			function calculateTotalExtra() {
				const pricePayment = document.querySelector('input[name="pricepayment"]');
				const extraCharge = document.querySelector('input[name="extracharge"]').value;
				const extraCharge_v = document.querySelector('input[name="extracharge_v"]').value;
				const totalExtra_v = parseFloat(extraCharge_v) || 0;
				const totalextra_c = parseFloat(extraCharge) || 0;
				let formattedExtra = formatCurrency(totalExtra_v + totalextra_c);
				pricePayment.value = formattedExtra;
			}
			function calculateTotal(drinkID) {
				var table = document.getElementById('zctb');
				var rows = table.getElementsByTagName('tr');
				const quantityInput = document.getElementById('quantity-' + drinkID);
				const totalInput = document.getElementById('total-' + drinkID);
				const totalInput_hidden = document.getElementById('total-hidden-' + drinkID);
				const priceElement = quantityInput.closest('tr').querySelector('.price');
				const pricePayment = document.querySelector('input[name="pricepayment"]');
				const pricePayment_hidden = document.querySelector('input[name="pricepayment-hidden"]');
				const priceInput = document.querySelector('input[name="price-hidden"]').value;
				const extraCharge = document.querySelector('input[name="extracharge"]').value;
				const extraCharge_v = document.querySelector('input[name="extracharge_v"]');
				const totalPayment = 0;
				if (isDrinkSelected(drinkID)) {
					const quantity = parseFloat(quantityInput.value) || 0;
					const price = parseFloat(priceElement.textContent) || 0;

					const total = quantity * price;
					const formattedtotal = formatNumber(total);

					totalInput.value = formattedtotal;
					totalInput_hidden.value = total;
					let total_service = 0;
					for (var i = 0; i < rows.length; i++) {
						var checkbox = rows[i].querySelector('input[type="checkbox"]');
						if (checkbox && checkbox.checked) {
							const totalValue = parseFloat(rows[i].querySelector('.total-hidden').value);
							if (!isNaN(totalValue)) {
								total_service += totalValue;
							}
						}
					}
					let priceField = parseFloat(priceInput) || 0;
					let inputExtraCharge = parseFloat(extraCharge) || 0;
					if (!isNaN(priceField)) {
						total_service += priceField;
						extraCharge_v.value = total_service;
					}
					if (!isNaN(inputExtraCharge)) {
						total_service += inputExtraCharge;
					}
					let formattedAmount = formatCurrency(total_service);
					pricePayment.value = formattedAmount;
					pricePayment_hidden.value = total_service;
				}
			}
			function formatNumber(value) {
				return value.toLocaleString('vi-VN');
			}
			function formatCurrency(value) {
				return value.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
			}
			function isDrinkSelected(drinkID) {
				const selectDrink = document.getElementById('selectDrink-' + drinkID);

				if (selectDrink) {
					return selectDrink.checked;
				}
				return false;
			}
			function processPayment(event) {
				var table = document.getElementById('zctb');
				var rows = table.getElementsByTagName('tr');
				var MatchID = <?php echo intval($_GET['id']); ?>;
				const priceInput = document.querySelector('input[name="price-hidden"]').value;
				const extraCharge = document.querySelector('input[name="extracharge"]').value;
				let selectedDrinks = [];

				async function addPayment(MatchID) {
					return new Promise((resolve, reject) => {
						$.ajax({
							url: 'match/add-payment.php',
							method: 'POST',
							data: { MatchID: MatchID },
							success: function (response) {
								const results = JSON.parse(response);
								if (results.status === 'success') {
									resolve(results.PaymentID);
								} else {
									reject('Error adding payment: ' + results.message);
								}
							},
							error: function (xhr, status, error) {
								reject('AJAX error: ' + error);
							}
						});
					});
				}

				async function addDrinkOrder() {
					return new Promise((resolve, reject) => {
						$.ajax({
							url: 'match/add-drinkorder.php',
							method: 'POST',
							success: function (response) {
								const results = JSON.parse(response);
								if (results.status === 'success') {
									resolve(results.DrinkOrderID);
								} else {
									reject('Error adding drink order: ' + results.message);
								}
							},
							error: function (xhr, status, error) {
								reject('AJAX error: ' + error);
							}
						});
					});
				}

				event.preventDefault();		
				for (var i = 0; i < rows.length; i++) {
					var checkbox = rows[i].querySelector('input[type="checkbox"]');
					if (checkbox && checkbox.checked) { // Kiểm tra checkbox tồn tại trước khi sử dụng checked
						var drinkID = checkbox.value;
						var drinkName = rows[i].querySelector('td:nth-child(2)').innerText;
						var price = rows[i].querySelector('.price').innerText;
						var quantity = rows[i].querySelector('.quantity').value;
						var total = rows[i].querySelector('.total').value;
						//  console.log(drinkID,price,quantity,total);						
						selectedDrinks.push({
							drinkID: drinkID,
							drinkName: drinkName,
							price: price,
							quantity: quantity,
							total: total
						});
					}
				}
				let jsonData = JSON.stringify(selectedDrinks);
				// console.log(priceInput,extraCharge);
				async function submitDrinkPayment(jsonData, priceInput, extraCharge, MatchID) {
					try {
						// Chờ cho đến khi có giá trị paymentID và drinkOrderID
						paymentID = await addPayment(MatchID);
						drinkOrderID = await addDrinkOrder();
						// console.log('PaymentID:', paymentID);
						// console.log('drinkOrderID:', drinkOrderID);
						// Thực hiện lệnh gọi AJAX chính
						$.ajax({
							url: 'match/addDrinkPayment.php',
							method: 'POST',
							data: {
								selectedDrinks: jsonData,
								priceInput: priceInput,
								extraCharge: extraCharge,
								paymentID: paymentID,
								drinkOrderID: drinkOrderID
							},
							success: function (response) {
								const results = JSON.parse(response);
								if (results) {
									if (results.status === 'success') {
										toastr.success(results.message, 'Thông Báo');
										setTimeout(function () {
											location.href = 'manage-payment-match.php';
										}, 1000);
									} else {
										toastr.error(results.message, 'Thông Báo!');
									}
								}
							},
							error: function (xhr, status, error) {
								toastr.error('AJAX error: ' + error, 'Thông Báo!');
							}
						});
					} catch (error) {
						console.error(error);
						toastr.error(error, 'Thông Báo!');
					}
				}
				event.preventDefault();
				submitDrinkPayment(jsonData, priceInput, extraCharge, MatchID);
			}
		</script>
	</body>

	</html>
<?php } ?>