<?php
session_start();
error_reporting(0);
include ('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
	if (isset($_REQUEST['del'])) {
		$delid = intval($_GET['del']);		
	
		$sql_del_odl = "DELETE FROM tblorderdetails WHERE order_id = :order_id";
		$query_del_odl = $dbh->prepare($sql_del_odl);
		$query_del_odl->bindParam(':order_id', $delid);
		if ($query_del_odl->execute()) {
			$sql_del_od = "DELETE FROM tblorder WHERE id = :order_id";
			$query_del_od = $dbh->prepare($sql_del_od);
			$query_del_od->bindParam(':order_id', $delid);
			if ($query_del_od->execute()) {
				$msg = "Huỷ thanh toán thành công!";
			} else {
				$error = "Huỷ thanh toán thất bại!";
			}
		} else {
			$error = "Huỷ thanh toán thất bại!";
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

		<title>TVU Sport Center |Admin Manage Payment History </title>
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

							<h2 class="page-title">Lịch Sử Thanh Toán</h2>

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
													window.location.href = 'manage-payment-historys.php';
												}, 1000); // Chuyển hướng sau 1 giây
											</script>
									<?php } ?>
									<div class="row mb-4">
										<div class="col-md-12">
											<div class="form-group">
												<label for="customer_name">Tên Khách Hàng</label>
												<input type="text" name="customer_name" id="customer_name"
													class="form-control" placeholder="Nhập Tên Khách Hàng">
											</div>
											<div class="form-group">
												<label for="phone">Điện Thoại</label>
												<input type="text" id="phone" name="phone" class="form-control"
													placeholder="Nhập SĐT">
											</div>
											<div class="form-group">
												<label for="address">Địa Chỉ</label>
												<input type="text" id="address" name="address" class="form-control"
													placeholder="Nhập Địa Chỉ">
											</div>
											<div class="form-group">
												<label for="orderdate">Chọn Ngày :</label>
												<input type="text" class="form-control" name="orderdate" id="orderdate"
													placeholder="Chọn ngày" required>
											</div>
											<div class="btn-group col-md-8" style="padding-bottom: 1rem">
												<div class="col-md-4">
													<button id="searchButton" class="btn btn-primary">Tìm Kiếm</button>
												</div>
											</div>
										</div>
									</div>
									<div class="container mt-5">
										<div class="table-responsive">
											<table id="zctb" class="table table-bordered zctb_dt" cellspacing="0"
												width="100%">
												<thead>
													<tr class="table-info">
														<th>#</th>
														<th>Tên Khách Hàng </th>
														<th>Địa Chỉ</th>
														<th>Điện Thoại</th>
														<th>Ngày Thanh Toán</th>
														<th>Tổng Tiền SP</th>
														<th>Phụ Thu</th>
														<th>Giảm Giá</th>
														<th>Khuyến mãi</th>
														<th>Tổng Thanh Toán</th>
														<th>Chi Tiết</th>
													</tr>
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
														<th>#</th>
														<th>Tên Sản Phẩm </th>
														<th>Size</th>
														<th>Đơn Giá</th>
														<th>Số Lượng</th>														
														<th>Thành Tiền</th>
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
			flatpickr('#orderdate', {
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
				if (!$.fn.DataTable.isDataTable('#zctb')) {
					$('#zctb').DataTable({
						responsive: true,
						scrollX: true,
						fixedColumns: {
							leftColumns: 1 // Số cột bạn muốn cố định ở bên trái (nếu cần)
						}
					});
				}
				function formatCurrency(value) {
					return value.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
				}
				async function fetchDataDetail(PaymentID) {
					try {
						const searchMatchResponse = await $.ajax({
							url: 'order/getpayment-order-detail-historys.php',
							method: 'POST',
							data: {
								PaymentID: PaymentID
							}
						});

						// console.log(Bkdate,FieldType,Field)
						const results = JSON.parse(searchMatchResponse);
						const dataShow = $('.zctb_dt1 tbody');
						// console.log(results);
						dataShow.empty();
						if (results && results.length > 0) {
							results.forEach((result, index) => {
								let Price = formatCurrency(parseFloat(result.price));
								let Total_price = formatCurrency(parseFloat(result.total_price));								
								const add = `	<tr>								 
																<td>${index + 1}</td>															
																<td>${result.name}</td>
																<td>${result.size}</td>
																<td>${Price}</td>
																<td>${result.quantity}</td>
																<td>${Total_price}</td>										
															</tr>
														`;
								dataShow.append(add);
							});
							$('#pn_detail').show();
							$('#table_detail').show();
						}
					} catch (e) {
						console.error("Error:", e);
					}
				}
				document.getElementById('searchButton').addEventListener('click', function () {
					const OrderDate = document.querySelector('input[name="orderdate"]').value;
					const Customer_name = document.querySelector('input[name="customer_name"]').value;
					const Phone = document.querySelector('input[name="phone"]').value;
					const Address = document.querySelector('input[name="address"]').value;
					// console.log(OrderDate, Customer_name, Phone, Address);
					fetchData(OrderDate, Customer_name, Phone, Address);
				});
				async function fetchData(OrderDate, Customer_name, Phone, Address) {
					try {
						const searchPaymentResponse = await $.ajax({
							url: 'order/getpayment-order-historys.php',
							method: 'POST',
							data: {
								OrderDate: OrderDate,
								Customer_name: Customer_name,
								Phone: Phone,
								Address: Address
							}
						});

						// console.log(Bkdate,FieldType,Field)
						  const results = JSON.parse(searchPaymentResponse);
						// console.log(OrderDate, Customer_name, Phone, Address);
						const dataShow = $('.zctb_dt tbody');
					    // console.log(searchPaymentResponse);
						dataShow.empty();
						if (results && results.length > 0) {
							results.forEach((result, index) => {
								// matchIDs.push(result.MatchID);
								let PaymentID = result.id === null ? '' : result.id;
								let Customer_name = result.customer_name === null ? '' : result.customer_name;
								let Address = result.address === null ? '' : result.address;
								let Status_Payment = (result.status === null || result.status === 0) ? 'Chưa thanh toán' : 'Đã thanh toán';
								let Color_Status_Payment = (result.status === null || result.status === 0) ? 'red' : 'blue';
								let Order_date = result.order_date === null ? '' : result.order_date;
								let Total_price_product = result.total_price_product === null ? '' : parseFloat(result.total_price_product).toLocaleString('vi-VN') + ' đ';
								let Extra_charge = result.extra_charge === null ? '' : parseFloat(result.extra_charge).toLocaleString('vi-VN') + ' đ';
								let Discount = result.discount === null ? '' : parseFloat(result.discount).toLocaleString('vi-VN') + ' đ';
								let Promotion = result.promotion === null ? '' : parseFloat(result.promotion).toLocaleString('vi-VN') + ' đ';
								let Total_amount = result.total_amount === null ? '' : parseFloat(result.total_amount).toLocaleString('vi-VN') + ' đ';



								let additionalLink = '';
								let additionalLinkDetail = '';
								if (String(result.status) === '1') {
									additionalLink = `<a href="manage-payment-historys.php?del=${result.id}"
																				onclick="return confirm('Bạn muốn huỷ thanh toán?');"><i
																					class="fa fa-close"></i></a>`;
									additionalLinkDetail = `<button class="detail-link" id="searchDetai-${result.id}" data-payment-detail-id="${result.id}"><i class="fa fa-info-circle"></i></button>`;
								}
								const add = `	<tr>								 
																			<td>${index + 1}</td>															
																			<td>${Customer_name}</td>
																			<td>${Address}</td>
																			<td>${Phone}</td>
																			<td>${Order_date}</td>
																			<td>${Total_price_product}</td>
																			<td>${Extra_charge}</td>
																			<td>${Discount}</td>
																			<td>${Promotion}</td>
																			<td style="color: ${Color_Status_Payment}">${Status_Payment}</td>
																			<td>${additionalLinkDetail} ${additionalLink}</td>																			
																		</tr>
																			`;
								dataShow.append(add);
							});
							$('#zctb').on('click', '.detail-link', function () {
								// Loại bỏ lớp active từ tất cả các nút
								$('.detail-link').removeClass('active');

								// Thêm lớp active cho nút hiện tại
								$(this).addClass('active');
								const PaymentID = $(this).data('payment-detail-id');
								// console.log('Button clicked for match ID:', matchID);
								fetchDataDetail(PaymentID);
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