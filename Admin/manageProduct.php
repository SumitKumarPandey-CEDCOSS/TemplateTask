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
    require "config.php";
    $error = array();
    
if (isset($_POST['submit'])) {
    
        $checkbox = $_POST['check'];
        $new = "";
    
    foreach ($checkbox as $values) {
    
        $new .= $values . ",";
    }
        $category = isset($_POST['dropdown']) ? $_POST['dropdown'] : '';
        $pname = isset($_POST['ProductName']) ? $_POST['ProductName'] : '';
        $pprice = isset($_POST['Price']) ? $_POST['Price'] : '';
        $desc = isset($_POST['desc']) ? $_POST['desc'] : '';
    
        $filename = $_FILES["Image"]["name"];
        $tempname = $_FILES["Image"]["tmp_name"];
        $folder = "images/" . $filename;
    if (move_uploaded_file($tempname, $folder)) {
            $error = array(
                'input' => 'form',
                'msg' => 'Image Added Successfully'
            );
    } else {
            $error = array(
                'input' => 'form',
                'msg' => 'Image Added FAiled'
            );
    }
    
        $sql = "INSERT INTO products(`image`,`name`,`price`,
        `description`,`tags`,`catid`)
         VALUES('$filename','$pname','$pprice','$desc','$new','$category')";
    
    if ($conn->query($sql) == true) {
            $error = array(
                'input' => 'form',
                'msg' => 'Product Added Successfully'
            );
    } else {
            $error = array(
                'input' => 'form',
                'msg' => $conn->error
            );
    }
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
                title="Upgrade to a better browser">
                upgrade
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
            <h3>Products</h3>
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
                            <th>Id</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Tags</th>
                            <th>Category ID</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php
                        require 'config.php';
                        $sql = "SELECT * FROM products";
                        $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        ?>
                    <tbody>
                        <tr>
                            <!-- <th><input class="check-all" 
                            type="checkbox" name="check[]" /></th> -->
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo '<img src="images/' . $row['image'] . '">' ?></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['price'] ?></td>
                            <td><?php echo $row['description'] ?></td>
                            <td><?php echo $row['tags'] ?></td>
                            <td><?php echo $row['catid'] ?></td>
                            <td>
                                <!-- Icons -->
                                <a href="Edit_Product.php?id=
                                <?php echo $row['id'] ?>" 
                                    title="Edit">
                                    <img src="resources/images/icons/pencil.png" 
                                    alt="Edit" /></a>
                                <a href="Productdelete.php?id=
                                <?php echo $row['id'] ?>"  title="Delete">
                                <img src="resources/images/icons/cross.png" 
                                alt="Delete" /></a> 
                            </td>
                        </tr>
                    </tbody>
                    <?php
                    }
                        ?>
                </table>
            </div>
            <!-- End #tab1 -->
            <div class="tab-content" id="tab2">
                <form action="" method="POST" enctype="multipart/form-data">
                    <p>
                        <label for="ProductName">ProductName: </label>
                        <input type="text" name="ProductName" 
                            value="" required>
                    </p>
                    <p>
                        <label for="Price">Price: </label>
                        <input type="text" name="Price" 
                            value="" required>
                    </p>
                    <p>
                        <label for="Image">Image:  </label>
                        <input type="file" name="Image" 
                            value="" required>
                    </p>
                    <p>
                        <label for="cat">Category</label>   
                        <select name="dropdown" class="small-input">
                            <?php
                                $sql = "SELECT * FROM category";
                                $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                    ?>
                            <option value="<?php echo $row["catid"]; ?>">
                                <?php echo $row["catname"]; ?>   
                            </option>
                            <?php
                            }
                                ?>  
                        </select>
                    </p>
                    <p>
                        <label>Tags</label>
                        <?php
                            $sql = "SELECT * FROM tags";
                            $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                                ?>
                        <input type="checkbox" value="
                            <?php echo $row["tagName"]; ?>" name="check[]" />
                        <?php echo $row["tagName"]; ?>
                        <?php
                        }
                            ?>
                    </p>
                    <p>
                        <label>Description</label>
                        <textarea class="text-input textarea wysiwyg" 
                            id="textarea" name="desc" cols="79" rows="15">
                        </textarea>
                    </p>
                    <p>
                        <input type="submit" name="submit" 
                        class="button" value="Submit">
                    </p>
                    <div class="clear"></div>
                    <!-- End .clear -->
                </form>
            </div>
            <!-- End #tab2 -->  
        </div>
        <!-- End .content-box-content -->
    </div>
    <!-- End .content-box -->
    <?php require 'footer.php'; ?>
</div>
<!-- End #main-content -->
</div></body>
</html>