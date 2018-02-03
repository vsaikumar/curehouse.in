<?php
if (isset($_POST['submit'])) {
	
        $to="vandrangisai@gmail.com";
        $headers="From:Curehouse";
        $message="Appointment confirmed Visit www.curehouse.in";


	if(mail($to,$message,$headers))
	{
                echo '<script>alert("email sent")</script>';


}

else{

echo "error";
}
}
?>




