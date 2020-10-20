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
    $error = array();
    
if (isset($_POST['submit'])) {
    
        $tagName = $_POST['tag'];
        $sql = "INSERT INTO tags(`tagName`)VALUES('$tagName')";
    
    if ($conn->query($sql) == true) {
            $error=array('input'=>'form','msg'=>'Product Added Successfully');
    } else {
            $error=array('input'=>'form','msg'=>$conn->error);
    }
        $conn->close();
    
} 
    require 'header.php';
    require 'sidebar.php'; 
    ?>
<div id="main-content">
    <!-- Main Content Section with everything -->
    <noscript>
        <!-- Show a notification if the user has disabled javascript -->
        <div class="notification error png_bg">
            <div>
                Javascript is disabled or is not supported by your browser. Please 
                <a href="http://browsehappy.com/" 
                title="Upgrade to a better browser">upgrade
                </a> your browser or 
                <a href="http://www.google.com/support/bin/answer.py?answer=
                    23852" title="Enable Javascript in your browser">enable
                </a> Javascript to navigate the interface properly.
            </div>
        </div>
    </noscript>
    <!-- Page Head -->
    <h2>Welcome Sumit</h2>
    <p id="page-intro">What would you like to do?</p>
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>Tags</h3>
            <ul class="content-box-tabs">
                <li><a href="#tab1" class="default-tab">Manage</a></li>
                <!-- href must be unique and match the id of target div -->
            </ul>
            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <div class="tab-content default-tab" id="tab1">
                <!-- This is the target div.
                 id must match the href of this div's tab -->
                <div class="notification attention png_bg">
                    <a href="#" class="close">
                        <img src="resources/images/icons/cross_grey_small.png" 
                        title="Close this notification" alt="close" /></a>
                    <div>
                        This is a Content Box. You can put whatever you want in it. 
                        By the way, you can 
                        close this notification with the top-right cross.
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Order_ID</th>
                            <th>Product_Name</th>
                            <th>Product_Price</th>
                            <th>Product_Quantity</th>
                            <th>Total</th>
                            <th>status</th>
                            <th>date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php
                        $json= array();
                        require 'config.php';
                        $sql = "SELECT * FROM orders";
                        $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                            $json=json_decode($row['cartdata'], true);
                        foreach ($json as $key) {
                            ?>
                    <tbody>
                        <tr>
                            <td><?php echo $row['orderid'] ?></td>
                            <td><?php echo $key['name']?></td>
                            <td><?php echo $key['price']?></td>
                            <td><?php echo $key['quantity']?></td>
                            <td><?php echo $row['total'] ?></td>
                            <td><?php echo $row['status']?></td>
                            <td><?php echo $row['date'] ?></td>
                            <td>
                                <!-- Icons -->
                                <a href="#" 
                                    title="Edit">
                                    <img src="resources/images/icons/pencil.png"
                                    alt="Edit" /></a>
                                <a href="orderupdate.php?orderid=
                                <?php echo $row['orderid']?>"  title="Delete">
                                <img src="resources/images/icons/cross.png" 
                                alt="Delete" /></a> 
                            </td>
                        </tr>
                    </tbody>
                    <?php
                        }
                    }
                        ?>
                    <?php 
                        $conn->close();
                        ?>
                </table>
            </div>
            <!-- End #tab1 -->      
        </div>
        <!-- End .content-box-content -->
    </div>
    <!-- End .content-box -->
    <div class="clear"></div>

    <?php require 'footer.php'; ?>
</div>
<!-- End #main-content -->
</div></body>
</html>