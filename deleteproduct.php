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
    require "config.php";
if (isset($_REQUEST['delid'])) {
        $id = $_REQUEST['delid'];
        unset($_SESSION['cart'][$id]);
        header("Refresh:0; url=cart.php");
}
?>
