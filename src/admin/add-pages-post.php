<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {

	if (isset($_POST['addpost'])) {
		$posttitle = $_POST['posttitle'];
		$category = $_POST['category'];
		$subcategory = $_POST['subcategory'];
		$content = $_POST['content'];
		$content_short = $_POST['content_short'];
		$post_image = $_FILES["post_image"]["name"];
		// $msg = $content_short;
		if (isset($_FILES["post_image"]["name"]) && !empty($_FILES["post_image"]["name"])) {
			move_uploaded_file($_FILES["post_image"]["tmp_name"], "img/postimages/" . $_FILES["post_image"]["name"]);
			$img_str = ',PostImage';
			$img_val = ',:post_image';
		}

		$sql = "INSERT INTO tblposts(PostTitle,CategoryId,SubCategoryId,PostDetails,PostingDate, Content, Is_Active " . $img_str . ") 
				VALUES(:posttitle, :category, :subcategory, :content, CURRENT_DATE(), :content_short, 1 ". $img_val .")";
		$query = $dbh->prepare($sql);
		$query->bindParam(':posttitle', $posttitle, PDO::PARAM_STR);
		$query->bindParam(':category', $category, PDO::PARAM_STR);
		$query->bindParam(':subcategory', $subcategory, PDO::PARAM_STR);
		$query->bindParam(':content', $content, PDO::PARAM_STR);
		$query->bindParam(':content_short', $content_short, PDO::PARAM_STR);
		if (isset($_FILES["post_image"]["name"]) && !empty($_FILES["post_image"]["name"])) {
			$query->bindParam(':post_image', $post_image, PDO::PARAM_STR);
		}
		if ($query->execute()) {
			$msg = "Thêm bài viết mới thành công";
		} else {
			$msg = "Thêm bài viết mới thất bại";
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

		<title>TVU Sport Center | Admin Add Post</title>

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

			#posttile {
				text-align: left;
				/* Đảm bảo nội dung căn trái */
				padding: 0;
				/* Loại bỏ padding nếu cần */
				margin: 0;
				/* Loại bỏ margin nếu cần */
			}

			/* textarea#short_ct {
				display: block !important; 				
			} */
		</style>
		<script src="https://cdn.tiny.cloud/1/i7w1hwir3zkfzh7y1zzhzva9vd9p0aqcxlew80d5zsw46711/tinymce/6/tinymce.min.js"
			referrerpolicy="origin"></script>
		<script>
			tinymce.init({
				selector: '#content,#content_short',
				plugins: 'advlist autolink lists link image charmap preview anchor textcolor',
				toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
				content_css: 'https://www.tiny.cloud/css/codepen.min.css',
			});
		</script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	</head>

	<body>
		<?php include('includes/header.php'); ?>
		<div class="ts-main-content">
			<?php include('includes/leftbar.php'); ?>
			<div class="content-wrapper">
				<div class="container-fluid">

					<div class="row">
						<div class="col-md-12">

							<h2 class="page-title">Thêm Bài Viết</h2>
							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-heading">Nhập Thông Tin Bài Viết</div>
										<div class="panel-body">
											<?php if ($msg) { ?>
												<div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?>
													<script>
														setTimeout(function () {
															window.location.href = 'manage-pages-news.php';
														}, 2000); 
													</script>
												</div><?php } ?>
											<form method="post" class="form-horizontal" enctype="multipart/form-data" novalidate>
												<div class="form-group">
													<label class="col-sm-2 control-label">Tiêu đề<span
															style="color:red">*</span></label>
													<div class="col-sm-10">
														<input type="text" name="posttitle" style="height: 50px;"
															class="form-control" required>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Thể Loại Bài Viết<span
															style="color:red">*</span>
													</label>
													<div class="col-sm-4">
														<select class="form-control" name="category" id="category" required>
															<?php $ret = "SELECT * FROM tblcategory";
															$query = $dbh->prepare($ret);
															//$query->bindParam(':id',$id, PDO::PARAM_STR);
															$query->execute();
															$resultss = $query->fetchAll(PDO::FETCH_OBJ);
															if ($query->rowCount() > 0) {
																foreach ($resultss as $results) {
																	?>
																	<option value="<?php echo htmlentities($results->id); ?>">
																		<?php echo htmlentities($results->CategoryName); ?>
																	</option>
																	<?php
																}
															} ?>

														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Chi Tiết Loại Bài Viết<span
															style="color:red">*</span>
													</label>
													<div class="col-sm-4">
														<select class="form-control" name="subcategory" id="subcategory"
															required>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Chọn hình ảnh<span
															style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="file" name="post_image" id="post_image"
															class="form-control" accept="image/*"
															onchange="previewImage(event)">
													</div>
													<label class="col-sm-2 control-label">Hình đại diện<span
															style="color:red">*</span></label>
													<div class="col-sm-4">
														<img id="postImage" src="img/postimages/noimage.png"
															alt="Post Image" class="img-thumbnail" style="max-width: 100%;">
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Nội dung tóm tắt<span
															style="color:red">*</span></label>
													<div class="col-sm-10">
														<textarea id="content_short" name="content_short" rows="5" cols="100"
															required></textarea><br><br>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Nội dung bài viết<span
															style="color:red">*</span></label>
													<div class="col-sm-10">
														<textarea id="content" name="content" rows="10" cols="30" required>
																	</textarea><br><br>
													</div>
												</div>
												<div class="hr-dashed"></div>
												<div class="form-group">
													<div class="col-sm-8 col-sm-offset-2">

														<button class="btn btn-primary" name="addpost" type="submit"
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
			function previewImage(event) {
				var reader = new FileReader();
				reader.onload = function () {
					var output = document.getElementById('postImage');
					if (output) {
						output.src = reader.result;
					} else {
						console.error("Element with ID 'PostImages' not found.");
					}
				};
				reader.readAsDataURL(event.target.files[0]);
			}
			$(document).ready(function () {
				$('#category').change(function () {
					var CategoryID = $(this).val();
					// console.log(CategoryID);
					$.ajax({
						url: 'posts/get-subcategory.php',
						method: 'POST',
						data: {
							CategoryID: CategoryID
						},
						success: function (response) {
							try {
								// console.log(response);
								const results = JSON.parse(response);
								const selectField = $('#subcategory');
								selectField.empty();
								// console.log(selectField.val());
								if (results && results.length > 0) {
									results.forEach(result => {
										// console.log(result.Subcategory);
										const option = `<option value="${result.SubCategoryId}">${result.Subcategory}</option>`;
										selectField.append(option);
										// $('.selectpicker').selectpicker('refresh');
									});
								}
							} catch (e) {
								console.error("Error parsing JSON:", e);
							}
						},
						error: function (xhr, status, error) {
							console.error("AJAX Error:", status, error);
						}
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