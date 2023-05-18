<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();
    if(!isset($_SESSION['username'])){
        header("location:shop_login.php");
    }
    if(empty($_POST["submit"])) {
?>

<form method="post" action="order_update.php">
	Order Status Update<p>
	Lot Number <input type="text" name="order_lot" ><p>
    Status <input type="text" name="status"><p>
    Tracking Number <input type="text" name="order_tracking"><p>
 		<input type="submit" name="submit" value="Submit">
</form>
    
<?php
} else {
	$order_lot = $_POST["order_lot"];
    	$order_latest_status = $_POST["status"];
    	$order_tracking = $_POST["order_tracking"];
	$link = mysqli_connect("localhost", "root", "", "goodstracking");
	$sql = "UPDATE orders SET order_latest_status = '$order_latest_status', latest_status_date = DATE(NOW()), order_tracking= '$order_tracking'
			WHERE order_lot = '$order_lot' ";
   
	$result = mysqli_query($link, $sql);
	if ($result)
	{
		echo "การแก้ไขข้อมูลในฐานข้อมูลประสบความสำเร็จ<br>";
		mysqli_close($link);
	}
	else
	{
		echo "ไม่สามารถแก้ไขข้อมูลในฐานข้อมูลได้<br>";
	}
}
?>
