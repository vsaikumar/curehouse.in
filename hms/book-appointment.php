<?php
session_start();
//error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

if(isset($_POST['submit']))
{
 
$specilization=$_POST['Doctorspecialization'];
$doctorid=$_POST['doctor'];
$userid=$_SESSION['id'];
$fees=$_POST['fees'];
$appdate=$_POST['appdate'];
$time=$_POST['apptime'];
$userstatus=1;
$docstatus=1;
if(!empty($_POST["apptime"])&&$_POST["appdate"]) {
	$apptime= $_POST["apptime"];
	$appdate= $_POST["appdate"];
	
		$result =mysql_query("SELECT appointmentTime,appointmentDate FROM appointment WHERE appointmentTime='$apptime' AND appointmentDate='$appdate'");
		$count=mysql_num_rows($result);
if($count>0)
{
echo "<script>alert(' Slot already exists .')</script>";
 

}else{


	$query=mysql_query("insert into appointment(doctorSpecialization,doctorId,userId,consultancyFees,appointmentDate,appointmentTime,userStatus,doctorStatus) values('$specilization','$doctorid','$userid','$fees','$appdate','$time','$userstatus','$docstatus')");
	if($query)
	{
		echo "<script>alert('Your appointment successfully booked');</script>";
	}
}
}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>User  | Book Appointment</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
		<script>
function getdoctor(val) {
	$.ajax({
	type: "POST",
	url: "get_doctor.php",
	data:'specilizationid='+val,
	success: function(data){
		$("#doctor").html(data);
	}
	});
}
</script>	


<script>
function getfee(val) {
	$.ajax({
	type: "POST",
	url: "get_doctor.php",
	data:'doctor='+val,
	success: function(data){
		$("#fees").html(data);
	}
	});
}
</script>	
 



	</head>
	<body>
		<div id="app">		
<?php include('include/sidebar.php');?>
			<div class="app-content">
			
						<?php include('include/header.php');?>
					
				<!-- end: TOP NAVBAR -->
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">User | Book Appointment</h1>
																	</div>
								<ol class="breadcrumb">
									<li>
										<span>User</span>
									</li>
									<li class="active">
										<span>Book Appointment</span>
									</li>
								</ol>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									
									<div class="row margin-top-30">
										<div class="col-lg-8 col-md-12">
											<div class="panel panel-white">
												<div class="panel-heading">
													<h5 class="panel-title">Book Appointment</h5>
												</div>
												<div class="panel-body">
								<p style="color:red;"><?php echo htmlentities($_SESSION['msg1']);?>
								<?php echo htmlentities($_SESSION['msg1']="");?></p>	
													<form role="form" name="book" method="post" >
														


<div class="form-group">
															<label for="DoctorSpecialization">
																Specilization
															</label>
							<select name="Doctorspecialization" class="form-control" onChange="getdoctor(this.value);" required="required">
																
<?php 

if(isset($_GET['book_a_slot'])){
	$pro_id=$_GET['book_a_slot'];
$ret=mysql_query("select * from doctors where id='$pro_id' ");
while($row=mysql_fetch_array($ret))
{
?>
																<option name="<?php echo $specilization
																?>">
																	<?php echo htmlentities($row['specilization']);?>
																</option>
																
																
															</select>
														</div>




														<div class="form-group">
															<label for="doctor">
																Doctors
															</label>
						<select name="doctor" class="form-control" id="doctor" >
						<option name="<?php echo $doctorName ; ?>">
							<?php echo htmlentities($row['doctorName']);?>
						</option>
						</select>
														</div>





														<div class="form-group">
															<label for="consultancyfees">
																Consultancy Fees
															</label>
					<select name="fees" class="form-control" id="fees"  readonly>
						<option name="<?php echo $docFees ; ?>">
							<?php echo htmlentities($row['docFees']);?>
						</select><?php }} ?>
														</div>
														
<div class="form-group">
															<label for="AppointmentDate">
																Date
															</label>
									<input class="form-control datepicker" name="appdate"  type="date" required="required">
														</div>
														
<div class="form-group">
															<label for="Appointmenttime">
														
														Time
													
															</label>
									<select class="form-control datepicker" name="apptime" type="time" required="required">
									<option value="" style="background-color: #0d9fe6;">Morning Session</option>
									<option value="9:00-9:15" name="apptime">9:00-9:15</option>
<option value="9:15-9:30" name="apptime">9:15-9:30</option>
<option value="10:00-10:15" name="apptime">10:00-10:15</option>
<option value="10:15-10:30" name="apptime">10:15-10:30</option>
<option value="11:00-11:15" name="apptime">11:00-11:15</option>
<option value="11:15-11:30" name="apptime">11:15-11:30</option><hr>
<option value=" 12:00-12:15" name="apptime">12:00-12:15</option><hr>
<option value="12:15-12:30" name="apptime">12:15-12:30</option><hr>
<option value="1:00-1:15" name="apptime">1:00-1:15</option>
<option value="1:15-1:30" name="apptime">1:15-1:30</option>
<option value="2:00-2:15" name="apptime">2:00-2:15</option>
<option value="2:15-2:30" name="apptime">2:15-2:30</option>
<option value=""  style="background-color: #0d9fe6;">Evening Session</option>
<option value="6:00-6:15" name="apptime">6:00-6:15</option>
<option value="6:15-6:30" name="apptime">6:15-6:30</option>
<option value="7:00-7:15" name="apptime">7:00-7:15</option>
<option value="7:15-7:30" name="apptime">7:15-7:30</option>
<option value="8:00-8:15" name="apptime">8:00-8:15</option>
<option value="8:15-8:30" name="apptime">8:15-8:30</option>
<option value="9:00-9:15" name="apptime">9:00-9:15</option>
<option value="9:15-9:30" name="apptime">9:15-9:30</option>

</select>

									</select>
														</div>														
														
														<button type="submit" name="submit" class="btn btn-o btn-primary">
															Submit
														</button>
													</form>
												</div>
											</div>
										</div>
											
											</div>
										</div>
									
									</div>
								</div>
							
						<!-- end: BASIC EXAMPLE -->
			
					
					
						
						
					
						<!-- end: SELECT BOXES -->
						
					</div>
				</div>
			</div>
			<!-- start: FOOTER -->
	<?php include('include/footer.php');?>
			<!-- end: FOOTER -->
		
			<!-- start: SETTINGS -->
	<?php include('include/setting.php');?>
			
			<!-- end: SETTINGS -->
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="vendor/autosize/autosize.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/form-elements.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>

	</body>
</html>
