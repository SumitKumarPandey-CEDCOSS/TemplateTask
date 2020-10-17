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
    
        $colorcode = $_POST['color'];
        $sql = "INSERT INTO color(`colorcode`)VALUES('$colorcode')";
    
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
            <h3>Color</h3>
            <ul class="content-box-tabs">
                <li><a href="#tab1" class="default-tab">Manage</a></li>
                <!-- href must be unique and match the id of target div -->
                <li><a href="#tab2">Add</a></li>
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
                            <th>ID</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php
                        require 'config.php';
                        $sql = "SELECT * FROM color";
                        $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                            ?>
                    <tbody>
                        <tr>
                            <td><?php echo $row['colorid'] ?></td>
                            <td><?php echo $row['colorcode']?></td>
                            <td>
                                <!-- Icons -->
                                <a href="tagedit.php?id=<?php echo $row['tagId']?>" 
                                    title="Edit">
                                    <img src="resources/images/icons/pencil.png"
                                    alt="Edit" /></a>
                                <a href="tagdelete.php?id=
                                <?php echo $row['tagId']?>"  title="Delete">
                                <img src="resources/images/icons/cross.png" 
                                alt="Delete" /></a> 
                            </td>
                        </tr>
                    </tbody>
                    <?php
                    }
                        ?>
                    <?php 
                        $conn->close();
                        ?>
                </table>
            </div>
            <!-- End #tab1 -->
            <div class="tab-content" id="tab2">
                <form action="#" method="post">
                    <fieldset>
                        <!-- Set class to "column-left" or "column-right" on
                            fieldsets to divide the form into columns -->
                        <div id="errordiv">
                            <?php if (sizeof($error)>0) : ?>
                            <ul>
                                <?php foreach ($error as $value) : ?>
                                <li><?php echo $error['msg'] ;break ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <?php endif ; ?> 
                        </div>
                        <p>
                            <label for="color">Add Color</label>
                            <input type = "text" name="color" />
                        </p>
                        <p>
                            <input class="button" type="submit" 
                            name="submit" value="Submit" />
                        </p>
                    </fieldset>
                    <div class="clear"></div>
                    <!-- End .clear -->
                </form>
            </div>
            <!-- End #tab2 -->        
        </div>
        <!-- End .content-box-content -->
    </div>
    <!-- End .content-box -->
    <div class="clear"></div>
    <!-- Start Notifications -->
    <!-- <div class="notification attention png_bg">
        <a href="#" class="close">
            <img src="resources/images/icons/cross_grey_small.png" 
        title="Close this notification" alt="close" /></a>
        <div>
        Attention notification. Lorem ipsum dolor sit amet, 
        consectetur adipiscing elit.
         Proin vulputate, sapien quis fermentum luctus, libero. 
        </div>
        </div>
        
        <div class="notification information png_bg">
        <a href="#" class="close">
            <img src="resources/images/icons/cross_grey_small.png" 
        title="Close this notification" alt="close" /></a>
        <div>
        Information notification. Lorem ipsum dolor sit amet, 
        consectetur adipiscing elit. 
        Proin vulputate, sapien quis fermentum luctus, libero.
        </div>
        </div>
        
        <div class="notification success png_bg">
        <a href="#" class="close">
            <img src="resources/images/icons/cross_grey_small.png" 
        title="Close this notification" alt="close" /></a>
        <div>
        Success notification. Lorem ipsum dolor sit amet,
         consectetur adipiscing elit. 
         Proin vulputate, sapien quis fermentum luctus, libero.
        </div>
        </div>
        
        <div class="notification error png_bg">
        <a href="#" class="close">
            <img src="resources/images/icons/cross_grey_small.png" 
        title="Close this notification" alt="close" /></a>
        <div>
        Error notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
        Proin vulputate, sapien quis fermentum luctus, libero.
        </div>
        </div> -->
    <!-- End Notifications -->
    <?php require 'footer.php'; ?>
</div>
<!-- End #main-content -->
</div></body>
</html>