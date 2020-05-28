<?php
error_reporting(E_PARSE | E_ERROR);
session_start();

$home_login = $_SESSION['login'];
$home_name = $_SESSION['loginname'];
$home_id = $_SESSION['loginid'];

if ($home_login != "on") {
    header("Location:index.php");
    exit();
}

if (isset($_POST['logout'])) {
    $_SESSION['login'] = "off";
    header("Location:index.php");
    session_destroy();
    exit();
}
if (isset($_POST['search'])) {

    $searchfield = trim($_POST['search']);
    if ($searchfield != "") {
        header("Location:searchresult.php?svalue=$searchfield");
    } else {

        echo '<script>
 
             alert("Your Search Field is Empty!!!!!");
                    </script>';
    }
}
?>

<?php include_once 'connection.php'; ?>
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



                <form id="searchbar" action="home.php" method="post">
                    <input type="text" name="search" placeholder="Search here any problem by problem name....">

                </form>

                <div id="homeunder_search">
                    <p>Welcome <?php echo "$home_name"; ?></p>

                </div>

                <div id="home_answer_show">
<?php
$home_show_sql = mysql_query("select * from answears,users where answears.uid=users.uid and likecount=(select max(likecount) from answears,users where answears.uid=users.uid) limit 0,1;");
$home_show_sql_count = mysql_num_rows($home_show_sql);
if ($home_show_sql_count == 1) {
    while ($home_show_sql_row = mysql_fetch_array($home_show_sql)) {
        $answer_post_uname = $home_show_sql_row['uname'];
        $answer_problem_name = $home_show_sql_row['pname'];
        $answer_best = $home_show_sql_row['qsnans'];
        $answer_best_time = $home_show_sql_row['atime'];
    }
    ?>

                        <h3 class="problemcounte">Problem Name: <?php echo "$answer_problem_name"; ?></h3>
                        <h2>Answer:</h2>
                        <p><pre id="answershow"><?php echo "$answer_best"; ?></pre></p>
                        <br>

                        <h4 class="answernamedate">Answered By: <?php echo "$answer_post_uname"; ?></h4>
                        <h4 class="answernamedate">Answer Date: <?php echo "$answer_best_time"; ?></h4>

                        <h4 class="answernamedate">This answer gets maximum votes.</h4>

    <?php
}
?>
                </div>

                    <?php include_once 'design/buttom.php'; ?>