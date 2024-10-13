<?php
session_start();
error_reporting(0);
include ('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
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

		<title>TVU Sport Center | Admin Dashboard</title>

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

	<body>
		<?php include ('includes/header.php'); ?>

		<div class="ts-main-content">
			<?php include ('includes/leftbar.php'); ?>
			<div class="content-wrapper">
				<div class="container-fluid">

					<div class="row">
						<div class="col-md-12">

							<h2 class="page-title">Bảng Điều Khiển</h2>

							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-3">
											<div class="panel panel-default">
												<div class="panel-body bk-primary text-light">
													<div class="stat-panel text-center">
														<?php
														$sql = "SELECT id from tblusers ";
														$query = $dbh->prepare($sql);
														$query->execute();
														$results = $query->fetchAll(PDO::FETCH_OBJ);
														$regusers = $query->rowCount();
														?>
														<div class="stat-panel-number h1 ">
															<?php echo htmlentities($regusers); ?>
														</div>
														<div class="stat-panel-title text-uppercase">Người Dùng Đã Đăng Ký
														</div>
													</div>
												</div>
												<a href="reg-users.php" class="block-anchor panel-footer text-center">Chi 
													Tiết &nbsp; <i class="fa fa-arrow-right"></i></a>			
											</div>
											
										</div>
										<div class="col-md-3">
											<div class="panel panel-default">
												<div class="panel-body bk-success text-light">
													<div class="stat-panel text-center">
														<?php
														$sql1 = "SELECT TeamID from tblteams ";
														$query1 = $dbh->prepare($sql1);
														;
														$query1->execute();
														$results1 = $query1->fetchAll(PDO::FETCH_OBJ);
														$totalvehicle = $query1->rowCount();
														?>
														<div class="stat-panel-number h1 ">
															<?php echo htmlentities($totalvehicle); ?>
														</div>
														<div class="stat-panel-title text-uppercase">Danh Sách Đội Bóng
														</div>
													</div>
												</div>
												<a href="manage-teams.php" class="block-anchor panel-footer text-center">Chi
													Tiết &nbsp; <i class="fa fa-arrow-right"></i></a>
											</div>
										</div>
										<div class="col-md-3">
											<div class="panel panel-default">
												<div class="panel-body bk-info text-light">
													<div class="stat-panel text-center">
														<?php
														$sql2 = "SELECT FieldID FROM tblfields ";
														$query2 = $dbh->prepare($sql2);
														$query2->execute();
														$results2 = $query2->fetchAll(PDO::FETCH_OBJ);
														$Fields = $query2->rowCount();
														?>

														<div class="stat-panel-number h1 ">
															<?php echo htmlentities($Fields); ?>
														</div>
														<div class="stat-panel-title text-uppercase">Danh Sách Sân Đấu</div>
													</div>
												</div>
												<a href="manage-fields.php"
													class="block-anchor panel-footer text-center">Chi Tiết &nbsp; <i
														class="fa fa-arrow-right"></i></a>
											</div>
										</div>
										<div class="col-md-3">
											<div class="panel panel-default">
												<div class="panel-body bk-warning text-light">
													<div class="stat-panel text-center">
														<?php
														$sql3 = "SELECT EmployeeID FROM tblemployees ";
														$query3 = $dbh->prepare($sql3);
														$query3->execute();
														$results3 = $query3->fetchAll(PDO::FETCH_OBJ);
														$employee = $query3->rowCount();
														?>
														<div class="stat-panel-number h1 ">
															<?php echo htmlentities($employee); ?>
														</div>
														<div class="stat-panel-title text-uppercase">Danh Sách Nhân Viên</div>
													</div>
												</div>
												<a href="manage-employees.php"
													class="block-anchor panel-footer text-center">Chi Tiết &nbsp; <i
														class="fa fa-arrow-right"></i></a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>



					<div class="row">
						<div class="col-md-12">


							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-3">
											<div class="panel panel-default">
												<div class="panel-body bk-primary text-light">
													<div class="stat-panel text-center">
														<?php
														$sql4 = "SELECT id from tblsubscribers ";
														$query4 = $dbh->prepare($sql4);
														$query4->execute();
														$results4 = $query4->fetchAll(PDO::FETCH_OBJ);
														$subscribers = $query4->rowCount();
														?>
														<div class="stat-panel-number h1 ">
															<?php echo htmlentities($subscribers); ?>
														</div>
														<div class="stat-panel-title text-uppercase">Người Đăng Ký</div>
													</div>
												</div>
												<a href="manage-subscribers.php" class="block-anchor panel-footer text-center">Chi Tiết <i class="fa fa-arrow-right"></i></a>
											</div>
										</div>
										<div class="col-md-3">
											<div class="panel panel-default">
												<div class="panel-body bk-success text-light">
													<div class="stat-panel text-center">
														<?php
														$sql6 = "SELECT id from tblcontactusquery ";
														$query6 = $dbh->prepare($sql6);
														;
														$query6->execute();
														$results6 = $query6->fetchAll(PDO::FETCH_OBJ);
														$query = $query6->rowCount();
														?>
														<div class="stat-panel-number h1 ">
															<?php echo htmlentities($query); ?>
														</div>
														<div class="stat-panel-title text-uppercase">Các Yêu Cầu</div>
													</div>
												</div>
												<a href="manage-conactusquery.php"
													class="block-anchor panel-footer text-center">Chi Tiết &nbsp; <i
														class="fa fa-arrow-right"></i></a>
											</div>
										</div>
										<div class="col-md-3">
											<div class="panel panel-default">
												<div class="panel-body bk-info text-light">
													<div class="stat-panel text-center">
														<?php
														$sql5 = "SELECT id from tbltestimonial ";
														$query5 = $dbh->prepare($sql5);
														$query5->execute();
														$results5 = $query5->fetchAll(PDO::FETCH_OBJ);
														$testimonials = $query5->rowCount();
														?>

														<div class="stat-panel-number h1 ">
															<?php echo htmlentities($testimonials); ?>
														</div>
														<div class="stat-panel-title text-uppercase">Lời Chứng Thực</div>
													</div>
												</div>
												<a href="testimonials.php"
													class="block-anchor panel-footer text-center">Chi Tiết &nbsp; <i
														class="fa fa-arrow-right"></i></a>
											</div>
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

		<script>

			window.onload = function () {

				// Line chart from swirlData for dashReport
				var ctx = document.getElementById("dashReport").getContext("2d");
				window.myLine = new Chart(ctx).Line(swirlData, {
					responsive: true,
					scaleShowVerticalLines: false,
					scaleBeginAtZero: true,
					multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
				});

				// Pie Chart from doughutData
				var doctx = document.getElementById("chart-area3").getContext("2d");
				window.myDoughnut = new Chart(doctx).Pie(doughnutData, { responsive: true });

				// Dougnut Chart from doughnutData
				var doctx = document.getElementById("chart-area4").getContext("2d");
				window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, { responsive: true });

			}
		</script>
	</body>

	</html>
<?php } ?>