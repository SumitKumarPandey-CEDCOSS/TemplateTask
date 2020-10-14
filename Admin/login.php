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
    $username = isset($_POST['username'])?$_POST['username']:'';
    $password = isset($_POST['password'])?$_POST['password']:'';
    
    if (sizeof($error)==0) {
        $sql= 'SELECT * FROM users WHERE 
        `username`="'.$username.'" AND `password`="'.$password.'"' ;
         $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $_SESSION["userdata"]=array('username' =>
                $row['username'],'user_id'=>$row['id']);
                    header('Location: index.php');         
            }
        } else {
            $error = array('input'=>'form','msg'=>'Invalid User Detail!');
            header('Location:login.php');    
        }
        $conn->close();
    }
}
    ?>
<!DOCTYPE html PUBLIC "
    -//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Simpla Admin | Sign In</title>
        <link rel="stylesheet"
            href="resources/css/reset.css" type="text/css" media="screen" />
        <link rel="stylesheet" 
            href="resources/css/style.css" type="text/css" media="screen" />
        <link rel="stylesheet"
            href="resources/css/invalid.css"
            type="text/css" media="screen" />
        <script type="text/javascript"
            src="resources/scripts/jquery-1.3.2.min.js"></script>
        <script type="text/javascript"
            src="resources/scripts/simpla.jquery.configuration.js"></script>
        <script type="text/javascript" src="resources/scripts/facebox.js"></script>
        <script type="text/javascript" 
        src="resources/scripts/jquery.wysiwyg.js"></script>
    </head>
    <body id="login">
        <div id="login-wrapper" class="png_bg">
            <div id="login-top">
                <h1>Simpla Admin</h1>
                <!-- Logo (221px width) -->
            <img id="logo" src="resources/images/logo.png" alt="Simpla Admin logo" />
            </div>
            <!-- End #logn-top -->
            <div id="login-content">
                <form action="" method="POST">
                    <div class="notification information png_bg">
                        <div>
                            Just click "Sign In". No password needed.
                        </div>
                    </div>
                    <p>
                        <label>Username</label>
                        <input class="text-input" type="text" name="username"/>
                    </p>
                    <div class="clear"></div>
                    <p>
                        <label>Password</label>
                        <input class="text-input" type="password" name="password"/>
                    </p>
                    <div class="clear"></div>
                    <p id="remember-password">
                        <input type="checkbox" />Remember me
                    </p>
                    <div class="clear"></div>
                    <p>
                <input name="submit" class="button" type="submit" value="Sign In" />
                    </p>
                </form>
            </div>
            <!-- End #login-content -->
        </div>
        <!-- End #login-wrapper -->
    </body>
</html>