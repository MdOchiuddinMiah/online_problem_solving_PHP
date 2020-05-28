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
                        <input  id="logout" type="submit" title="click to log out." value="Log out" name="logout">

                        )</h3>
                </form>
            </div>

            <div class="menulist">
                <?php
                include_once 'design/nav.php';
                ?>

            </div>

            <div class="content">


