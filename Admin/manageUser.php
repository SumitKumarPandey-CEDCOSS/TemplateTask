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
    require 'config.php' ;
    $error=array();
    
if (isset($_POST['submit'])) {
    
        $username=isset($_POST['username'])?$_POST['username']:'';
        $email=isset($_POST['email'])?$_POST['email']:'';
        $sql_username = "SELECT * FROM users WHERE username='$username'";
        $sql_email = "SELECT * FROM users WHERE email='$email'";
        $res_username = mysqli_query($conn, $sql_username);
        $res_email = mysqli_query($conn, $sql_email);
    
    if (mysqli_num_rows($res_username) > 0) {
            $error = array('input'=>'form','msg'=>'UserName Already Exist!');
    } else if (mysqli_num_rows($res_email) > 0) {
            $error = array('input'=>'form','msg'=>'Email Is Already Taken!');
    }
    
        $username=isset($_POST['username'])?$_POST['username']:'';
        $password=isset($_POST['password'])?$_POST['password']:'';
        $repassword=isset($_POST['password'])?$_POST['repassword']:'';
        $email=isset($_POST['email'])?$_POST['email']:'';
    if ($password != $repassword) {
            $error=array('input'=>'password','msg'=>'password doesnt match');
    }
    if (sizeof($error) == 0) {
            $sql = 'INSERT INTO users(`username`,`password`,`email`) 
        VALUES ("'.$username.'", "'.$password.'", "'.$email.'")';
    
        if ($conn->query($sql) === true) {
                $error=array('input'=>'form','msg'=>"1 Row Upload");
        } else {
                $error=array('input'=>'form','msg'=>$conn->error);
        }
            $conn->close();
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
            <h3>Content box</h3>
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
                        By the way, 
                        you can close this notification with the top-right cross.
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <!-- <th><input 
                            class="check-all" type="checkbox" /></th> -->
                            <th>User ID</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td colspan="6">
                                <div class="pagination">
                                    <a href="#" title="First Page">
                                        &laquo; First</a><a href="#" 
                                        title="Previous Page">&laquo; Previous</a>
                                    <a href="#" class="number" title="1">1</a>
                                    <a href="#" class="number" title="2">2</a>
                                    <a href="#" class="number current" 
                                    title="3">3</a>
                                    <a href="#" class="number" title="4">4</a>
                                    <a href="#" title="Next Page">
                                        Next &raquo;</a><a href="#" 
                                        title="Last Page">Last &raquo;</a>
                                </div>
                                <!-- End .pagination -->
                                <div class="clear"></div>
                            </td>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                            require 'config.php';
                            $sql = "SELECT * FROM users";
                            $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                                ?>
                    <tbody>
                        <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['username']?></td>
                            <td><?php echo $row['password'] ?></td>
                            <td><?php echo $row['email']?></td>
                            <td><?php echo $row['role'] ?></td>
                            <td>
                                <!-- Icons -->
                                <a href="Edit_User.php?id=<?php echo $row['id']?>" 
                                    title="Edit">
                                    <img src="resources/images/icons/pencil.png"
                                    alt="Edit" /></a>
                                <a href="userdelete.php?id=
                                <?php echo $row['id']?>"  title="Delete">
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
                    </tbody>
                </table>
            </div>
            <!-- End #tab1 -->
            <div class="tab-content" id="tab2">
                <form action="" method="post">
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
                            <label for="username">Username:</label> 
                            <input type="text" name="username" required>
                        </p>
                        <p>
                            <label for="password">Password:</label> 
                            <input type="password" name="password" required>
                        </p>
                        <p>
                            <label for="repassword">Re-Password:</label> 
                            <input type="password" name="repassword" required>
                        </p>
                        <p>
                            <label for="email">Email:</label> 
                            <input type="email" name="email" required>
                        </p>
                        <p>
                            <input name ="submit" class="button" 
                            type="submit" value="Submit" />
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
    <?php require 'footer.php'; ?>
</div>
<!-- End #main-content -->
</div></body>
</html>