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
require 'config.php';
$id = $_REQUEST['orderid'];
echo $id;

$sql = "DELETE FROM orders WHERE `orderid`=$id ";

if ($conn->query($sql) === true) {
    $error=array('input'=>'form','msg'=>"Record Deleted SuccessFully");
    header('Location: order.php');
} else {
    $error=array('input'=>'form','msg'=>$conn->error);
    header('Location: order.php');
}
?>