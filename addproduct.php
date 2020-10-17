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
session_start();
// session_destroy();
if (isset($_REQUEST['pid'])) {
    $id=$_REQUEST['pid'];
    $sql="SELECT * FROM products WHERE `id`=$id";
    $res = $conn->query($sql);
    while ($ab=mysqli_fetch_array($res)) {
        $pri = $ab['price'];
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($ab['id'] == $value['id']) {
                $id= $value['id'];
                $name     = $value['name'];
                $price    = $value['price'];
                $image    = $value['image'];
                $quantity =$value['quantity']+1;
                $item = array(
                "id" => $id,
                "name" => $name,
                "pricee"=>$pri,
                "price" => $pri*$quantity,
                "quantity" => $quantity,
                "image" => $image
                    );
                echo '<script>alert("Product Quantity Increased in Cart 
                Succefully")
                </script>';
                header("Refresh:0; url=product.php");
                $_SESSION['cart'][$id] = $item;

                // show();
                return;
            }
        }
        $name = $ab['name'];
        $price = $ab['price'];
        $id = $ab['id'];
        $image = $ab['image'];
        $quantity =1;
        $item = array(
            "name" => $name,
            "price" => $price,
            "pricee" => $pri,
            "id" => $id,
            "quantity"=> $quantity,
            "image" => $image
        );
        echo '<script>alert("Product Added In Cart")</script>';
        header("Refresh:0; url=product.php");
        $_SESSION['cart'][$id]= $item;  
    }
}

?>