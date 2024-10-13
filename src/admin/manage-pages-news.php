<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {

	if (isset($_REQUEST['del'])) {
		$id = intval($_GET['del']);
		$sql = "DELETE FROM tblposts 
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

		<title>TVU Sport Center |Admin Manage Posts </title>

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
		<link rel="shortcut icon" href="../assets/images/favicon-icon/logo.jpg">
		<!-- Awesome Bootstrap checkbox -->
		<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
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
		<?php include('includes/header.php'); ?>

		<div class="ts-main-content">
			<?php include('includes/leftbar.php'); ?>
			<div class="content-wrapper">
				<div class="container-fluid">

					<div class="row">
						<div class="col-md-12">

							<h2 class="page-title">Quản Lý Bài Viết</h2>

							<!-- Zero Configuration Table -->
							<div class="panel panel-default">
								<div class="panel-heading">Chi Tiết Bài Viết</div>
								<div class="panel-body">
									<?php if ($error) { ?>
										<div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div>
									<?php } else if ($msg) { ?>
											<div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div>
											<script>
												setTimeout(function () {
													window.location.href = 'manage-pages-news.php';
												}, 1000); // Chuyển hướng sau 2 giây
											</script>
									<?php } ?>
									<div class="row mb-4">
										<div class="col-md-12">
											<div class="form-group">
												<label for="category">Thể Loại Bài Viết</label>
												<select class="form-control" name="Category" id="Category" required>

												</select>
											</div>
											<div class="form-group">
												<label for="category">Chi Tiết Thể Loại</label>
												<select class="form-control" name="subcategory" id="subcategory" required>
													<option value="">Chọn Chi Tiết</option>
												</select>
											</div>
											<div class="btn-group col-md-8" style="padding-bottom: 1rem">
												<div class="col-md-4">
													<button id="searchButton" class="btn btn-primary">Tìm Kiếm</button>
												</div>

												<div class="col-md-4">
													<a href="add-pages-post.php" class="btn btn-primary">Thêm Mới</a>
												</div>
											</div>
										</div>
									</div>
									<table id="zctb" class="display table table-striped table-bordered table-hover"
										cellspacing="0" width="100%">
										<thead>
											<tr>
												<th width="1%">#</th>
												<th width="15%">Tiêu Đề</th>
												<th width="5%">Tên Loại</th>
												<th width="74%">Nội Dung</th>												
												<th width="5%">Hành Động</th>
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
				fetchData(null, null);
				//Load data FieldType
				$.ajax({
					url: 'posts/getcategory-type.php',
					method: 'GET',
					success: function (response) {

						try {
							const results1 = JSON.parse(response);
							const selectField = $('#Category');
							selectField.empty();
							if (results1 && results1.length > 0) {
								const option_default = `<option value="">Chọn Thể Loại</option>`;
								selectField.append(option_default);
								results1.forEach(result => {
									const option = `<option value="${result.id}">${result.CategoryName}</option>`;
									selectField.append(option);
								});
							}
						} catch (e) {
							console.error("Error parsing JSON:", e);
						}
					}
				});
				$('#Category').on('change', function () {
					var categoryid = $('#Category').val();
					// console.log(categoryid);
					$.ajax({
						url: 'posts/getsubcategory-type.php',
						method: 'GET',
						data: {
							categoryid: categoryid
						},
						success: function (response) {
							try {
								// console.log(response);
								const resultsEP = JSON.parse(response);

								const selectField = $('#subcategory');
								selectField.empty();
								if (resultsEP && resultsEP.length > 0) {
									resultsEP.forEach(result => {
										const option = `<option value="${result.SubCategoryId}">${result.Subcategory}</option>`;
										selectField.append(option);
									});
								}
							} catch (e) {
								console.error("Error parsing JSON:", e);
							}
						}
					});
				});

				$('#anotherButton').on('click', function () {

				});
				document.getElementById('searchButton').addEventListener('click', function () {

					const Category = $('#Category').val() || null;
					const subcategory = $('#subcategory').val() || null;

					fetchData(Category, subcategory);
				});
				function htmlspecialchars(text) {
					return text
						.replace(/&/g, '&amp;')
						.replace(/</g, '&lt;')
						.replace(/>/g, '&gt;')
						.replace(/"/g, '&quot;')
						.replace(/'/g, '&#039;');
				}
				async function fetchData(Category, subcategory) {
					try {
						const searchPostResponse = await $.ajax({
							url: 'posts/getpost.php',
							method: 'GET',
							data: {
								Category: Category,
								subcategory: subcategory
							}
						});
						//  console.log(searchPostResponse);
						const results = JSON.parse(searchPostResponse);
						const dataShow = $('#zctb tbody');
						//  console.log(results);
						dataShow.empty();
						if (results && results.length > 0) {
							results.forEach((result, index) => {
								let posttitle = result.posttitle === null ? '' : result.posttitle;
								let category = result.category === null ? '' : result.category;
								let postdetails = result.postdetails === null ? '' : result.postdetails;								
								let viewCounter = result.viewCounter === null ? '' : result.viewCounter;
								const truncateText = (text, length) => {
									return text.length > length ? text.substring(0, length) + '...' : text;
								};
								// console.log(htmlspecialchars(postdetails));
								const truncatedPostdetails = truncateText(postdetails, 400);
								const add = `	<tr>								 
																				<td>${index + 1}</td>
																				<td>${posttitle}</td>
																				<td>${category}</td>
																				<td>${truncatedPostdetails}</td>																																																									
																				<td><a href="edit-pages-post.php?id=${result.id}" class="manage-posts"><i
																								class="fa fa-edit"></i></a>&nbsp;&nbsp;
																					<a href="manage-pages-news.php?del=${result.id}"
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