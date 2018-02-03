<?php
include 'db.php';
  ?>

<html>
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php
$db = mysqli_connect("localhost","root","","hi");

if (mysqli_connect_errno())
  {
  echo "The Connection was not established: " . mysqli_connect_error();
  }
// getting the user IP address
function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}

function cart(){
	if(isset($_GET['add_cart'])){
		global $db;
		$ip=getIp();
		$pro_id=$_GET['add_cart'];
		$da=$_GET['date'];
	 $check_pro="select * from cart where ip_add='$ip' AND p_id='$pro_id'";
	 $run_check=mysqli_query($db,$check_pro);
	 if(mysqli_num_rows($run_check)>0){
	 	echo "";
	 }
	 else{

	 $insert_pro="insert into cart(p_id,ip_add,date) values ('$pro_id','$ip','$da')";
	 $run_pro=mysqli_query($db,$insert_pro);
	 echo "<script>window.open('index.php','_self')</script>"; 	
	 }
	}
}

function total_items()
{
	if(isset($_GET['add_cart'])){
		global $db;
		$ip=getIp();
		$get_items="select * from cart where ip_add='$ip'";
		$run_items=mysqli_query($db,$get_items);
		$count_items=mysqli_num_rows($run_items);

	}
	else
	{
		global $db;
		$ip=getIp();
		$get_items="select * from cart where ip_add='$ip'";
		$run_items=mysqli_query($db,$get_items);
		$count_items=mysqli_num_rows($run_items);

	}
    echo $count_items;
}

function total_price()
{
	$total=0;
	global $db;
     
	$ip=getIp();
	$sel_price="select * from cart where ip_add='$ip'";
	$run_price=mysqli_query($db,$sel_price);
	while($p_price=mysqli_fetch_array($run_price)){
		$pro_id=$p_price['p_id'];
		$pro_price="select * from products where product_id='$pro_id'";
		$run_pro_price=mysqli_query($db,$pro_price);
		while ($pp_price=mysqli_fetch_array($run_pro_price)) {
		 $product_price=array($pp_price['product_price']);
		 $values=array_sum($product_price);
		 $total +=$values;
		 } 
	}
	echo "RS:" .$total;
}


function getapp(){
	global $db;
	$get_pro="select * from doctors ";
	$run_pro=mysqli_query($db,$get_pro);
	while($row_pro=mysqli_fetch_array($run_pro))
	{
		$pro_id=$row_pro['id'];
		$pro_name=$row_pro['doctorName'];
		
		$pro_img=$row_pro['address'];
		$pro_price=$row_pro['docFees'];
		$pro_desc=$row_pro['specilization'];
	/*	$age=$row_pro['age'];
		$slot=$row_pro['slot'];
		$exp=$row_pro['exp'];
		$hname=$row_pro['hname'];*/

         echo "  <div id='single_product'>
                   
                   
                  <span style='color:#4C6A92;font-size:1.5em;position:relative;left:0px;'>$pro_name,$pro_desc,</span>
                  <hr style='border: 0.5px solid black;position:relative;top:30px;'><br>
                  
                   <b position:absolute;left:300px;'>Fee<span class='glyphicon glyphicon-eur' style='color:#4C6A92;'>:$pro_price</b></span>&nbsp &nbsp
                  Hospital <span class='glyphicon glyphicon-plus' style='color:#4C6A92;'>$pro_img</span>&nbsp &nbsp
               
                   <br><br>
                   <a href='doctor.php?add_cart=$pro_id'><button type='button' class='btn btn-default' style='float:center;' id='but'>Book a slot</button></a>
                   
                   
                   </div>" ;
                   
	}
}
?>
</body>
</html>