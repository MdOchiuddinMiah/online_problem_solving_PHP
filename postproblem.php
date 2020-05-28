<?php
error_reporting(E_PARSE | E_ERROR);
session_start();

$home_login = $_SESSION['login'];
$home_name = $_SESSION['loginname'];
$home_id = $_SESSION['loginid'];

if ($home_login != "on") {
    header("Location:index.php");
}

if (isset($_POST['logout'])) {
    $_SESSION['login'] = "off";
    header("Location:index.php");
    session_destroy();
}

mysql_connect("localhost", "root", "") or die("can not connect..");
mysql_select_db("online_problem_solving") or die("can not find db");



if (isset($_POST['postproblem'])) {
    $postproblem_name = trim($_POST['problemname']);
    $postproblem_type = $_POST['problemtype'];
    $postproblem_date = date("Y-m-d");
    $postproblem_userid = $home_id;


    if ($postproblem_userid != "" && $postproblem_date != "" && $postproblem_type != "choose") {

        $postproblem_sql = "insert into problems(uid,ptype,pname,postdate) values"
                . "('$postproblem_userid','$postproblem_type','$postproblem_name','$postproblem_date');";


        if (!mysql_query($postproblem_sql)) {
            $postproblem_sql_forpid = mysql_query("select * from problems where pname='$postproblem_name';");
            $postproblem_sql_forpid_count = mysql_num_rows($postproblem_sql_forpid);
            if ($postproblem_sql_forpid_count == 1) {

                while ($postproblem_forpid_row = mysql_fetch_array($postproblem_sql_forpid)) {
                    $postproblem_pid = $postproblem_forpid_row['pid'];
                }

                header("Location:problemanswer.php?ppid=$postproblem_pid&postp=1");
            }
        } else {

            echo '<script>
 
             alert("Successfully posted!!!!!");
                    </script>';
        }
    } else {

        echo '<script>
 
             alert("All fields must be required !!!!!!");
                    </script>';
    }
}
?>
<html>
    <title><?php echo "$home_name"; ?></title>
    <head>
        <link type="text/css" rel="stylesheet" href="./design/top.css">

    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>ONLINE PROBLEM SOLVING</h1>
                <form action="" method="post">
                    <h3><?php echo "$home_name" ?>(
                        <input id="logout" type="submit" title="click to log out." value="Log out" name="logout">

                        )</h3>
                </form>
            </div>

            <div class="menulist">
<?php
include_once 'design/nav.php';
?>

            </div>

            <div class="content">



                <h2>Post Problem Here</h2>

                <form id="postproblemfrom" action="postproblem.php" method="post">

                    <label class="postproblemlevel" for="ppname"><strong>Problem Name</strong></label>
                    <input class="postproblemtext" type="text" id="pptext" name="problemname" required="" placeholder="Enter problem name..">
                    <label class="postproblemlevel" for="pptype"><strong>Problem Type</strong></label>
                    <select class="postproblemtext" id="pptype" name="problemtype">
                        <option  value="choose">Choose problem type..</option>
                        <option value="Easy">Easy</option>
                        <option value="Medium">Medium</option>
                        <option value="Hard">Hard</option>
                    </select>



                    <input class="postproblemsubmit" type="submit" value="Post" name="postproblem">

                </form>


<?php
include_once 'design/buttom.php';
?>