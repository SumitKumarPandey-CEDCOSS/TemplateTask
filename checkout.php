<?php
/**
 * Php version 7.2.10
 * 
 * @category Components
 * @package  Packagename
 * @author   Sumit kumar Pandey <pandeysumit399@gmail.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link     http://localhost/training/php%20mysql%20task1/register/signup.php
 */
session_start();
$total=0;
require 'config.php';
$error  = array();
$status="SOLD";
$id=$_REQUEST['id'];
$data = json_encode($_SESSION['cart']);
foreach ($_SESSION['cart'] as $key => $value) {
    $total = $value['price'] + $total;
}

if (sizeof($error)==0) {

    $sql="INSERT INTO orders(`orderid`, `cartdata`, `status`,`date`,`total`)
      VALUES('$id', '$data', '$status', NOW(), '$total')";

    if ($conn->query($sql) === true) {
        $error = array('input'=>'form','msg'=>"Record Added");
    } else {
        $error = array('input'=>'form','msg'=>$conn->error);
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>  
<!DOCTYPE html>  
 <html>  
      <head>
      <title>Orders</title> 
    </head>  
<body style="background-image: linear-gradient(to right, rgba(165, 105, 189,0 ),
 rgba(165, 105, 189 ,1));">  
    <center><h1 class="log">Thank You</h1></center>
 </body>  
 </html>