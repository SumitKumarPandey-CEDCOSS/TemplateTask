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
if (empty($_SESSION['cart'])) {
     echo "<div id='msg' style='color:red;'>
     <center>
     <h1>You Need To add products in Your cart First
     </h1>".'<h2><h2></center></div>';
     return false;
}
require 'header.php';
// session_destroy();
?>
  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
   <img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img">
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Cart Page</h2>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>                   
          <li class="active">Cart</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

 <!-- Cart view section -->
 <section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">
             <form action="">
               <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th></th>
                        <th></th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                        <?php 
                        // print_r($_SESSION);
                        foreach ($_SESSION['cart'] as $key => $value) {
                          // session_destroy();
                    ?>
                    <tbody>
                      <tr>
                        <td><a class="remove" href="deleteproduct.php?delid=<?php echo $value['id']?>
                        "><fa class="fa fa-close"></fa></a></td>
                        <td><?php echo '<img src="Admin/images/' . $value['image'] . '">' ?></td>
                        <td><a class="aa-cart-title" href="#"><?php echo 
                        $value['name']?></a></td>
                        <td><?php echo $value['pricee']?></td>
                        <td>
                        <form method='POST'>
                        <input type = Number name ='quantity' class="aa-cart-quantity"
                        value="<?php echo $value['quantity']?>">
                        </form>
                        </td>
                        <td><?php 
                        echo $value['price'];
                        ?></td>
                      </tr>
                    <?php
                    }
                    ?>
                      <tr>
                        <td colspan="6" class="aa-cart-view-bottom">
                          <div class="aa-cart-coupon">
                            <input class="aa-coupon-code" 
                            type="text" placeholder="Coupon">
                            <input class="aa-cart-view-btn" 
                            type="submit" value="Apply Coupon">
                          </div>
                          <input class="aa-cart-view-btn" type="submit" value="Update Cart">
                        </td>
                      </tr>
                      </tbody>
                  </table>
                </div>
             </form>
             <!-- Cart Total view -->
             <div class="cart-view-total">
               <h4>Cart Totals</h4>
               <table class="aa-totals-table">
                 <tbody>
                    <?php
                    $total = 0;
                    foreach ($_SESSION['cart'] as $key => $value) {
                        $total = $value['price'] + $total;
                    }
                    ?>
                   <tr>
                     <th>Subtotal</th>
                     <td><?php echo $total ?></td>
                   </tr>
                   <tr>
                     <th>Total</th>
                     <td><?php echo $total ?></td>
                   </tr> 
                 </tbody>
               </table>
               <a href="#" class="aa-cart-view-btn">Proced to Checkout</a>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->
<?php require 'footer.php';