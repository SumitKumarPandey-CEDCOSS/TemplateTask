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
            <h3>Updating Record</h3>
            <ul class="content-box-tabs">
                <li><a href="#tab1" class="default-tab">update</a></li>
                <!-- href must be unique and match the id of target div -->
            </ul>
            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <div class="tab-content default-tab" id="tab1">
                <!-- This is the target div. 
                id must match the href of this div's tab -->
                <form action="" method="post">
                    <?php 
                        require "config.php";
                        $error=array();
                        $id=$_REQUEST["id"];
                        
                        $result =  "SELECT * FROM products WHERE id=$id";
                        $res = $conn->query($result);
                    while ($ab = mysqli_fetch_array($res)) {
                              $name = $ab['name'];
                              $price = $ab['price'];
                              $id = $ab['id'];
                              $image = $ab['image'];
                              $desc=$ab['description'];
                    }
                    if (isset($_POST['submit'])) {
                        
                           $checkbox = $_POST['check'];
 
                           $id= isset($_POST['id'])?$_POST['id']:"";
                           $name= isset($_POST['name'])?$_POST['name']:"";
                           $price= isset($_POST['price'])?$_POST['price']:"";
                           $image= isset($_POST['image'])?$_POST['image']:"";
                           $desc = isset($_POST['desc'])?$_POST['desc']:'';
                        
                        $sql="UPDATE products SET `name`='$name', `price`='$price', 
                        `image`='$image',`tagId`='$checkbox',`description`='$desc' 
                           WHERE `id`=$id";
                        
                        if (mysqli_query($conn, $sql)) {
                            $error=array('input'=>'form','msg'=>
                            'Record Updated Successfully');
                            echo '<script>alert("Updated Successfully")</script>';
                            echo '<script>window.location="manageProduct.php"
                            </script>';
                        } else {
                            $error=array('input'=>'form','msg'=>mysqli_error($conn));
                        }
                          
                    }
                        $conn->close();
                        ?>
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
                            <label for="id">Product Id:</label> 
                            <input type="text" name="id" 
                                value="<?php echo $id; ?>" required>
                        </p>
                        <p>
                            <label for="Product Name">Product Name:</label> 
                            <input type="text" name="name" 
                                value="<?php echo $name; ?>" required>
                        </p>
                        <p>
                            <label for="price">Product Price:</label> 
                            <input type="text" name="price" 
                                value="<?php echo $price; ?>" required>
                        </p>
                        <p>
                            <label for="pic">Image:</label> 
                            <input type="text" name="image" 
                                value="<?php echo $image; ?>" required>
                        </p>
                        <p>
                            <label for="Image">Image:</label> 
                            <input type="file" name="image" 
                                value="" required>
                        </p>
                        <p>
                            <label>Tags</label>
                            <?php  
                                require 'config.php';
                                    $sql = "SELECT * FROM tags";
                                    $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                        ?>
                            <input type="checkbox" value="
                                <?php echo $row["tagId"];?>" name="check" />
                            <?php echo $row["tagName"] ;?>
                            <?php
                            }
                                ?>
                        </p>
                        <p>
                            <label>Description</label>
                            <textarea class="text-input textarea wysiwyg" 
                                id="textarea"
                                name="desc" cols="79" rows="15"><?php echo $desc;?>
                            </textarea>
                        </p>
                        <p>
                            <input name ="submit" class="button" type="submit" 
                            value="Update" />
                        </p>
                    </fieldset>
                    <div class="clear"></div>
                    <!-- End .clear -->
                </form>
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