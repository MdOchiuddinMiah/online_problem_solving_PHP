<?php
error_reporting(E_PARSE | E_ERROR);


mysql_connect("localhost", "root", "") or die("can not connect..");
mysql_select_db("online_problem_solving") or die("can not find db");
$login_email = trim($_POST['lemail']);
$login_password = trim($_POST['lpasword']);


if (isset($_POST['login'])) {
  $second=0;
    date_default_timezone_set('Asia/Dhaka');

    $login_date1 = date("Y-m-d H:i:s");
    $login_date_sql = mysql_query("select timestampdiff(second,logindate,'$login_date1') as diff  from users where uemail='$login_email';");
    $login_date_sql_count = mysql_num_rows($login_date_sql);
    if ($login_date_sql_count == 1) {
        while ($login_date_row = mysql_fetch_array($login_date_sql)) {
            $second = $login_date_row['diff'];
        }
    

    if ($second >= 1200) {
        $login_sql = mysql_query("SELECT *FROM users WHERE uemail ='$login_email' AND upassword ='$login_password';");
        $login_sql_count = mysql_num_rows($login_sql);



        if ($login_sql_count == 1) {


            session_start();
            $_SESSION['login'] = 'on';


            while ($login_row = mysql_fetch_array($login_sql)) {
                $_SESSION['loginid'] = $login_row['uid'];
                $_SESSION['loginname'] = $login_row['uname'];
            }
            mysql_query("update users set logincount=0 where uemail='$login_email';");
            header("Location:home.php");
            exit();
        } else {
            $login_count_sql = mysql_query("select * from users where uemail='$login_email';");

            $login_count_sql_count = mysql_num_rows($login_count_sql);
            if ($login_count_sql_count != 0) {
                while ($login_count_row = mysql_fetch_array($login_count_sql)) {
                    $login_error_count = $login_count_row['logincount'];
                }
                if ($login_error_count < 2) {
                    $login_error_count = $login_error_count + 1;
                    mysql_query("update users set logincount='$login_error_count' where uemail='$login_email';");
                } else {
                    $error_login_date = date("Y-m-d H:i:s");
                    mysql_query("update users set logindate='$error_login_date' where uemail='$login_email';");

                    mysql_query("update users set logincount=0 where uemail='$login_email';");
                }
            }
            echo '<script>
             alert("Password not match!!!!!!");
                    </script>';
            $_SESSION['login'] = 'off';
        }
    }
    
    else {
        echo '<script>
             alert("Your Account Block For Twenty Minutes!!!!");
                    </script>';
    }
    }
    else
    {
        echo '<script>
             alert("Email not match!!!!");
                    </script>';
    }
 
     
 }

?>



<?php include_once 'design/logintop.php'; ?>



<h2>Login Here</h2>

<form id="loginform" action="index.php" method="post">

    <label class="loginlevel" for="lemail"><strong>Email</strong></label>
    <input class="logintext" type="email" id="lemail" name="lemail" required="" placeholder="Enter your mail address..">



    <label class="loginlevel" for="lpasword"><strong>Password</strong></label>
    <input class="logintext" type="password" id="lpasword" name="lpasword" placeholder="Enter your password.." required="">


    <input class="loginsubmit" type="submit" value="Login" name="login">

</form>

<?php include_once 'design/buttom.php'; ?>