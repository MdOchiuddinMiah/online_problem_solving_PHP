<?php
error_reporting(E_PARSE | E_ERROR);

include_once 'design/logintop.php';
include_once 'connection.php';
?>

<?php
$sign_up_name = trim($_POST['sname']);
$sign_up_email = trim($_POST['semail']);
$sign_up_password = trim($_POST['spasword']);
$sign_up_gender = $_POST['sgender'];


if (isset($_POST['signup'])) {
    $emailcheck = "";
    $namecheck="";
    if ( !preg_match('/^[A-Za-z][A-Za-z0-9\s]{2,31}$/', $sign_up_name) ){
        $namecheck="(* name must be valid name)";
    }

    if (!filter_var($sign_up_email, FILTER_VALIDATE_EMAIL)) {
        $emailcheck = "(* email must be valid email)";
    }


    if ($sign_up_name != "" && $sign_up_password != "" && $emailcheck == "" && $namecheck=="" && $sign_up_gender != "choose") {
        $sign_up_sql = "insert into users(uname,uemail,upassword,ugender) values"
                . "('$sign_up_name','$sign_up_email','$sign_up_password','$sign_up_gender');";


        if (!mysql_query($sign_up_sql)) {
            echo '<script>
 
             alert("Please try another email!!!!!!");
                    </script>';
        } else {

            echo '<script>
 
             alert("Successfully sign up!!!!!");
                    </script>';
        }
    } else {

        echo '<script>
 
             alert("All fields must be required !!!!!!");
                    </script>';
    }
}
?>


<h2>SignUp Here</h2>

<form id="loginform" action="signup.php" method="post">
    <label class="loginlevel" for="sname"><strong>Name</strong></label>
    <span style="color: red;"><?php echo $namecheck; ?></span>
    <input class="logintext" type="text" id="sname" name="sname" required="" placeholder="Enter your name please..">


    <label class="loginlevel" for="semail"><strong>Email</strong></label>
    <span style="color: red;"><?php echo $emailcheck; ?></span>
    <input class="logintext" type="email" id="semail" name="semail" required="" placeholder="Enter your mail address..">



    <label class="loginlevel" for="spasword"><strong>Password</strong></label>
    <input class="logintext" type="password" id="spasword" name="spasword" placeholder="Enter your password.." required="">

    <label class="loginlevel" for="country"><strong>Gender</strong></label>
    <select class="logintext" id="sgender" name="sgender">
        <option value="choose">Choose your gender..</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Others</option>
    </select>

    <input class="loginsubmit" type="submit" value="Sign Up" name="signup">

</form>

<?php
include_once 'design/buttom.php';
?>
                

