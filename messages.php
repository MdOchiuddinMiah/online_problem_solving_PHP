<?php
error_reporting(E_PARSE | E_ERROR);
?>
<?php include_once 'design/top.php'; ?>

<?php
$message_show_sql = mysql_query("select distinct(problems.pid) as mpid,problems.pname as mpname,problems.postdate as mdate from users,problems,answears where users.uid=problems.uid and problems.pid=answears.pid and users.uid='$message_uid' order by seen;");
$message_show_sql_count = mysql_num_rows($message_show_sql);

if ($message_show_sql_count == 0) {
    ?>  
    <h3 class="problemcounte">No Problem Posted</h3>   
    <?php
} else {
    ?>
    <h3 class="problemcounte">Total Problem: <?php echo "$message_show_sql_count"; ?></h3>

    <div id="easyproblem_list">


        <?php
        while ($message_show_sql_rows = mysql_fetch_array($message_show_sql)) {
            $message_uname = $_SESSION['loginname'];
            $message_pname = $message_show_sql_rows['mpname'];
            $message_pid = $message_show_sql_rows['mpid'];
            $message_postdate = $message_show_sql_rows['mdate'];
            ?>  
            <h2><a id="problemnamehover" href="problemanswer.php?ppid=<?php echo "$message_pid"; ?>&message=1" title="click to get answear"><?php echo "$message_pname"; ?></a></h2>
            <h4>Posted By: <?php echo "$message_uname"; ?></h4>
            <h4>Post Date: <?php echo "$message_postdate"; ?></h4>
            <?php
        }
    }
    ?>

    <?php include_once 'design/buttom.php'; ?>